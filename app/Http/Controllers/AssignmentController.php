<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Machine;
use Illuminate\Http\Request;
use App\Models\Construction;
use Illuminate\Validation\Rule;
use App\Models\EndReason;
use Carbon\Carbon;
use App\Events\AssignmentFinalized;
use Illuminate\Support\Facades\Log;


class AssignmentController extends Controller
{
    
    public function index()
    {
       $asignaciones = Assignment::with(['machine', 'construction', 'endReason'])
                                 ->orderBy('start_date', 'desc')
                                 ->paginate(15);

       return view('vistasProyecto\assignments\index', ['asignaciones' => $asignaciones]);
    }


    public function create()
    {
        $availableMachines = Machine::whereDoesntHave('assignments', function ($query) {
                                    $query->whereNull('end_date');
                                })
                                ->get();

        $constructions = Construction::where(function ($query) {
                                    $query->whereNull('end_date'); 
                                })
                                ->get();

        return view('vistasProyecto.assignments.create', compact('availableMachines', 'constructions'));
    }

    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_machine' => [
                'required',
                'exists:machines,id_machine',

                Rule::unique('assignments', 'id_machine')->where(function ($query) {
                    return $query->whereNull('end_date');
                }),
            ],
            'id_construction' => 'required|exists:constructions,id_construction',
            'start_date' => 'required|date',
        ]);

        $validatedData['end_date'] = null;
        $validatedData['id_reason'] = null;
        $validatedData['kilometers'] = null;

        Assignment::create($validatedData);
        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada exitosamente.');
    }



    public function showFinalizeForm(Assignment $assignment) 
    {
        $endReasons = EndReason::orderBy('reason', 'asc')->get();

        return view('vistasProyecto.assignments.finalize', [
            'assignment' => $assignment,
            'endReasons' => $endReasons,
        ]);
    }


    public function processFinalization(Request $request, Assignment $assignment)
    {

        $validatedData = $request->validate([
            'end_date' => 'required|date|after_or_equal:' . $assignment->start_date->format('Y-m-d'),
            'kilometers' => 'required|integer|min:0', 
            'id_reason' => 'required|exists:end_reasons,id_reason', 
        ]);

        $assignment->end_date = Carbon::parse($validatedData['end_date'])->toDateString(); 
        $assignment->kilometers = $validatedData['kilometers'];
        $assignment->id_reason = $validatedData['id_reason'];
        $assignment->save(); 

        event(new AssignmentFinalized($assignment));

        return redirect()->route('asignaciones.index');
    }


    public function edit(Assignment $asignacione) 
    {

        $constructions = Construction::orderBy('name')->get();

        return view('vistasProyecto.assignments.edit', [
            'assignment' => $asignacione,
            'constructions' => $constructions
        ]);
    }

    

    public function update(Request $request, Assignment $asignacione)
    {
        if ($asignacione->end_date) {
            return redirect()->route('asignaciones.index')
                             ->with('error', 'No se pueden actualizar los detalles principales de una asignación ya finalizada.');
        }

        $validatedData = $request->validate([
            'id_construction' => 'required|exists:constructions,id_construction',
            'start_date' => 'required|date',

        ]);



        $asignacione->update($validatedData);

        return redirect()->route('asignaciones.index')
                         ->with('success', 'Asignación para la máquina ' . ($asignacione->machine->serial_number ?? 'N/A') . ' actualizada exitosamente.');
    }

    

    public function destroy(Assignment $asignacione)
    {
            $machineSerial = $asignacione->machine ? $asignacione->machine->serial_number : 'N/A';
            $constructionName = $asignacione->construction ? $asignacione->construction->name : 'N/A';
            $assignmentId = $asignacione->id_assignment;

            $asignacione->delete(); 


            return redirect()->route('asignaciones.index')
                             ->with('success', 'Asignación eliminada exitosamente.');
    }


    public function show(Assignment $asignacione)
    {
        $asignacione->load([
            'machine.type',      
            'machine.brand',      
            'construction.province',
            'endReason'  
        ]);
        return view('vistasProyecto.assignments.show', ['assignment' => $asignacione]);
    }
}
