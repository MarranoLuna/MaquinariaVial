<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class ServiceController extends Controller
{
  
    public function index()
    {
        $services = Service::orderBy('service', 'asc')->paginate(10);
        return view('vistasProyecto.services.index', compact('services'));
    }


  
    public function create()
    {
        return view('vistasProyecto.services.create');
    }

 
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service' => 'required|string|max:255|unique:services,service',
            'kilometers' => 'required|integer|min:0',
        ]);

        Service::create($validatedData);

        return redirect()->route('services.index');
    }

 
    public function show(Service $service)
    {
        return view('vistasProyecto.services.show', compact('service'));
    }

  
    public function edit(Service $service)
    {
        return view('vistasProyecto.services.edit', compact('service'));
    }

 
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'service' => ['required','string','max:255',Rule::unique('services')->ignore($service->id_service, 'id_service')],
            'kilometers' => 'required|integer|min:0',
        ]);

        $service->update($validatedData);

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->serviceMachines()->exists()) {
            return redirect()->route('services.index')
                             ->with('error', 'No se puede eliminar el servicio "' . $service->service . '" porque tiene registros de mantenimientos realizados. Considere desactivarlo o eliminar primero los registros asociados.');
        } else {
            $service->delete();
            return redirect()->route('services.index');
        }
    }
}
