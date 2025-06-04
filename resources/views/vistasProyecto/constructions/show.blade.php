<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de Obra: {{ $obra->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <div>
                        <h3 class="text-lg font-medium">Información de la Obra</h3>
                        <p><strong>Nombre:</strong> {{ $obra->name }}</p>
                        <p><strong>Provincia:</strong> {{ $obra->province ? $obra->province->name : 'N/A' }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $obra->start_date->format('d/m/Y') }}</p>
                        <p><strong>Fecha de Fin (Prevista):</strong> {{ $obra->end_date ? $obra->end_date->format('d/m/Y') : 'Indefinida' }}</p>
                        <p><strong>Registrada el:</strong> {{ $obra->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mt-6 border-t dark:border-gray-700 pt-4">Máquinas Asignadas a esta Obra</h3>
                        @if($obra->assignments->isEmpty())
                            <p>No hay máquinas asignadas a esta obra actualmente o en el historial.</p>
                        @else
                            <ul class="list-disc list-inside space-y-3 mt-2">
                                @foreach($obra->assignments as $assignment)
                                    <li class="p-2 bg-gray-50 dark:bg-gray-700 rounded-md">
                                        <strong>Máquina:</strong> {{ $assignment->machine ? $assignment->machine->serial_number : 'N/A' }}
                                        ({{ $assignment->machine && $assignment->machine->type ? $assignment->machine->type->name : 'Sin tipo' }}) <br>
                                        <strong>Desde:</strong> {{ $assignment->start_date->format('d/m/Y') }}
                                        <strong>Hasta:</strong> {{ $assignment->end_date ? $assignment->end_date->format('d/m/Y') : 'Activa' }} <br>
                                        @if($assignment->end_date)
                                            <strong>Motivo Fin:</strong> {{ $assignment->endReason ? $assignment->endReason->reason : '-' }} |
                                            <strong>Km:</strong> {{ $assignment->kilometers !== null ? number_format($assignment->kilometers) . ' km' : '-' }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center space-x-4">
                        <a href="{{ route('obras.edit', ['obra' => $obra->id_construction]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Editar Obra
                        </a>
                        <a href="{{ route('obras.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>