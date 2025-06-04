<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\MachineType;  
use App\Models\MachineBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    

    public function index()
    {
        $maquinas = Machine::with([
                            'type',
                            'brand',
                            'activeAssignment.construction.province',
                            'activeMaintenance.service'
        ])->paginate(15);

        return view('vistasProyecto\machines\index', ['maquinas' => $maquinas]);
    }


    public function create()
    {
        $machineTypes = MachineType::orderBy('name')->get();
        $machineBrands = MachineBrand::orderBy('brand')->get();

        return view('vistasProyecto\machines\create', compact('machineTypes', 'machineBrands'));
    }

  

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'serial_number' => 'required|string|max:100|unique:machines,serial_number', 
            'id_type' => 'required|exists:machine_types,id_type', 
            'id_brand' => 'required|exists:machine_brands,id_brand', 
            'kilometers' => 'required|integer|min:0',
        ]);

        Machine::create($validatedData);

        return redirect()->route('maquinas.index')->with('success', 'Máquina creada exitosamente.');
    }

   

     public function show(Machine $maquina)
    {
        $maquina->load([
            'type',
            'brand',
            'assignments' => function ($query) {
                $query->with(['construction', 'endReason'])->orderBy('start_date', 'desc');
            }
        ]);

        $activeAssignmentsCount = $maquina->assignments()->whereNull('end_date')->count();

        return view('vistasProyecto.machines.show', compact('maquina', 'activeAssignmentsCount'));
    }


    
    public function edit(Machine $maquina)
    {
        $machineTypes = MachineType::orderBy('name')->get();
        $machineBrands = MachineBrand::orderBy('brand')->get();
        return view('vistasProyecto.machines.edit', compact('maquina', 'machineTypes', 'machineBrands'));
    }



    public function update(Request $request, Machine $maquina)
    {
        $validatedData = $request->validate([
            'serial_number' => 'required|string|max:100|unique:machines,serial_number,' . $maquina->id_machine . ',id_machine',
            'id_type' => 'required|exists:machine_types,id_type',
            'id_brand' => 'required|exists:machine_brands,id_brand',
            'kilometers' => 'required|integer|min:0',
        ]);

        $maquina->update($validatedData);

        return redirect()->route('maquinas.index')->with('success', 'Máquina actualizada exitosamente.');
    }



   public function destroy(Machine $maquina)
    {
        if ($maquina->assignments()->exists()) { 
             return redirect()->route('maquinas.index')
                              ->with('error', 'No se puede eliminar la máquina "' . $maquina->serial_number . '" porque tiene asignaciones registradas (activas o finalizadas). Primero debe eliminar o reasignar esas tareas.');
        } else{
            $serialNumber = $maquina->serial_number;
            $maquina->delete(); 
            return redirect()->route('maquinas.index')->with('success', 'Máquina "' . $serialNumber . '" eliminada exitosamente.');
        }
    }
}




       
