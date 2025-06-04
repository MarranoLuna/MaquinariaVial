<?php

namespace App\Http\Controllers;

use App\Models\Construction;
use App\Http\Requests\StoreConstructionRequest;
use App\Http\Requests\UpdateConstructionRequest;
use App\Models\Province;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(){
        $obras = Construction::with('province') 
                             ->orderBy('name', 'asc')
                             ->paginate(15);

        return view('vistasProyecto\constructions\index', ['obras' => $obras]);
    }



    public function create()
    {
        $provinces = Province::orderBy('name')->get();

        return view('vistasProyecto.constructions.create', compact('provinces'));
    }

   

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'id_province' => 'required|exists:provinces,id_province',
            'start_date' => 'required|date',
        ]);

        Construction::create($validatedData);

        return redirect()->route('obras.index');
    }

  
    public function show(Construction $obra)
    {
        $obra->load([
            'province', 
            'assignments' => function ($query) {
                $query->with(['machine.type', 'machine.brand', 'endReason'])->orderBy('start_date', 'desc');
            }
        ]);

        return view('vistasProyecto.constructions.show', compact('obra'));
    }



    public function edit(Construction $obra)
    {

        $provinces = Province::orderBy('name')->get();

        return view('vistasProyecto.constructions.edit', compact('obra', 'provinces'));
    }



     public function update(Request $request, Construction $obra)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'id_province' => 'required|exists:provinces,id_province',
            'start_date' => 'required|date',
        ]);

        $obra->update($validatedData);

        return redirect()->route('obras.index');
    }

  

    public function destroy(Construction $obra)
    {
        if ($obra->assignments()->exists()) {
            return redirect()->route('obras.index')
                             ->with('error', 'No se puede eliminar la obra "' . $obra->name . '" porque tiene máquinas asignadas o un historial de asignaciones. Por favor, elimine o reasigne esas tareas primero.');
        } else {
            $obraName = $obra->name; 
            $obra->delete(); 

            return redirect()->route('obras.index')
                             ->with('success', 'Obra "' . $obraName . '" eliminada exitosamente.');
        }
    }


    
    public function finalize(Construction $obra)
    {

        if ($obra->end_date && Carbon::parse($obra->end_date)->isPast()) {
            return redirect()->route('obras.index')->with('info', 'La obra "' . $obra->name . '" ya estaba marcada como finalizada.');
        }
        $activeAssignmentsCount = $obra->assignments()->whereNull('end_date')->count();

        if ($activeAssignmentsCount > 0) {
            return redirect()->route('obras.index')
                             ->with('error', 'No se puede finalizar la obra "' . $obra->name . '" porque todavía tiene ' . $activeAssignmentsCount . ' máquina(s) con asignaciones activas. Por favor, finalice esas asignaciones primero.');
        }

        $obra->end_date = Carbon::now()->toDateString(); 
        $obra->save();

        return redirect()->route('obras.index');
    }
}
