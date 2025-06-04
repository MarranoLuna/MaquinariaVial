<?php

namespace App\Http\Controllers;

use App\Models\MachineType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MachineTypeController extends Controller
{
    public function index()
    {
        $machineTypes = MachineType::orderBy('name', 'asc');
        return view('vistasProyecto.machine_types.index', compact('machineTypes'));
    }



    public function create()
    {
        return view('vistasProyecto.machine_types.create');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:machine_types,name',
        ]);

        MachineType::create($validatedData);

        return redirect()->route('machine_types.index')->with('success', 'Tipo de máquina creado exitosamente.');
    }



    public function show(MachineType $machineType)
    {
        $machineType->load('machines'); 
        return view('vistasProyecto.machine_types.show', compact('machineType'));
    }



    public function edit(MachineType $machineType)
    {
        return view('vistasProyecto.machine_types.edit', compact('machineType'));
    }



    public function update(Request $request, MachineType $machineType)
    {
        $validatedData = $request->validate([
            'name' => ['required','string','max:255', Rule::unique('machine_types')->ignore($machineType->id_type, 'id_type')],
        ]);

        $machineType->update($validatedData);

        return redirect()->route('machine_types.index');
    }


    
    public function destroy(MachineType $machineType)
    {
        if ($machineType->machines()->exists()) {
            return redirect()->route('machine_types.index')
                             ->with('error', 'No se puede eliminar el tipo "' . $machineType->name . '" porque hay máquinas asociadas a él.');
        } else{
            $typeName = $machineType->name;
            $machineType->delete();
            return redirect()->route('machine_types.index')->with('success', 'Tipo de máquina "' . $typeName . '" eliminado exitosamente.');
        }
    }
}