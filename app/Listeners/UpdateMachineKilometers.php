<?php

namespace App\Listeners;

use App\Events\AssignmentFinalized;
use App\Models\Machine;
use App\Models\Service;
use App\Models\ServiceMachine;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Necesario para addDays() y toDateString()

class UpdateMachineKilometers
{


    public function handle(AssignmentFinalized $event): void
    {
        $assignment = $event->assignment;

        $machine = Machine::find($assignment->id_machine);

        $km_recorridos_en_asignacion = 0;
        if (isset($assignment->kilometers) && is_numeric($assignment->kilometers) && $assignment->kilometers >= 0) {
            $km_recorridos_en_asignacion = $assignment->kilometers;
        } else {
            Log::warning("Listener: Kilómetros no válidos en Asignación ID {$assignment->id_assignment}. Se asumirá 0 para actualización de máquina.");
        }
        
        $machine->kilometers += $km_recorridos_en_asignacion;
        $machine->save();
        
        $this->mantenimiento($machine);
    }




    protected function mantenimiento(Machine $machine): void
    {
        $definedServices = Service::orderBy('kilometers', 'asc')->get();

        foreach ($definedServices as $service) {
            $existingMaintenance = ServiceMachine::where('id_machine', $machine->id_machine)
                                               ->where('id_service', $service->id_service)
                                               ->where(function ($query) {
                                                   $query->whereNull('end_date') 
                                                         ->orWhere('end_date', '>=', Carbon::now()->toDateString());
                                               })
                                               ->exists();

            if ($machine->kilometers >= $service->kilometers && !$existingMaintenance) {

                $startDate = Carbon::now();
                $endDate = $startDate->copy()->addDays(5);

                ServiceMachine::create([
                    'id_service' => $service->id_service,
                    'id_machine' => $machine->id_machine,
                    'description' => "Mantenimiento de 5 días programado para '{$service->service}' (automático por kilometraje).",
                    'kilometers_at_service' => $machine->kilometers,
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(), 
                ]);
        

            
            }
        }
    }
}
          //       $userToNotify = User::find(1);
          //       if ($userToNotify) {
          //          try {
          //              Mail::to($userToNotify->email)->send(new MaintenanceRequiredMail($machine, $service));
          //              Log::info("Email de notificación de mantenimiento enviado a {$userToNotify->email} para Máquina ID {$machine->id_machine}, Servicio: {$service->service}.");
          //          } catch (\Exception $e) {
          //              Log::error("Error al enviar email de mantenimiento para Máquina ID {$machine->id_machine} al usuario {$userToNotify->email}: " . $e->getMessage());
          //          }
          //      } else {
          //          Log::warning("No se encontró un usuario destinatario para la notificación de mantenimiento de la Máquina ID {$machine->id_machine} para el servicio '{$service->service}'. No se envió el email.");
          //      }
        
    
    
