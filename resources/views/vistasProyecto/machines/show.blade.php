<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de Máquina: {{ $maquina->serial_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <div>
                        <h3 class="text-lg font-medium">Información General</h3>
                        <p><strong>Número de Serie:</strong> {{ $maquina->serial_number }}</p>
                        <p><strong>Tipo:</strong> {{ $maquina->type ? $maquina->type->name : 'N/A' }}</p>
                        <p><strong>Marca:</strong> {{ $maquina->brand ? $maquina->brand->brand : 'N/A' }}</p>
                        <p><strong>Kilometraje Total:</strong> {{ number_format($maquina->kilometers, 0, ',', '.') }} km</p>
                        <p><strong>Estado Actual:</strong>
                            @if($activeAssignmentsCount > 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                    Asignada
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    Disponible
                                </span>
                            @endif
                        </p>
                        <p><strong>Registrada el:</strong> {{ $maquina->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última Actualización:</strong> {{ $maquina->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mt-6 border-t dark:border-gray-700 pt-4">Historial de Asignaciones</h3>
                        @if($maquina->assignments->isEmpty())
                            <p>Esta máquina no tiene asignaciones registradas.</p>
                        @else
                            <ul class="list-disc list-inside space-y-2">
                                @foreach($maquina->assignments as $assignment)
                                    <li>
                                        <strong>Obra:</strong> {{ $assignment->construction ? $assignment->construction->name : 'N/A' }} <br>
                                        <strong>Desde:</strong> {{ \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') }}
                                        <strong>Hasta:</strong> {{ $assignment->end_date ? \Carbon\Carbon::parse($assignment->end_date)->format('d/m/Y') : 'Activa' }} <br>
                                        @if($assignment->end_date)
                                            <strong>Motivo Fin:</strong> {{ $assignment->endReason ? $assignment->endReason->reason : '-' }} <br>
                                            <strong>Km Recorridos:</strong> {{ $assignment->kilometers !== null ? number_format($assignment->kilometers, 0, ',', '.') . ' km' : '-' }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center space-x-4">
                        <a href="{{ route('maquinas.edit', ['maquina' => $maquina->id_machine]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Editar Máquina
                        </a>
                        <a href="{{ route('maquinas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>