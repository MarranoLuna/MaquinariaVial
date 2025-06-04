<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Asignación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> {{-- Ancho ajustado para detalle --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <div class="mb-6 pb-4 border-b dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                            Asignación ID: {{ $assignment->id_assignment }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Estado:
                            @if (is_null($assignment->end_date))
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                    Activa
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700 dark:bg-gray-600 dark:text-gray-300">
                                    Finalizada
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Máquina (Nº Serie)</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->machine ? $assignment->machine->serial_number : 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Máquina</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->machine && $assignment->machine->type ? $assignment->machine->type->name : 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Marca de Máquina</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->machine && $assignment->machine->brand ? $assignment->machine->brand->brand : 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Obra Asignada</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->construction ? $assignment->construction->name : 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Provincia de la Obra</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->construction && $assignment->construction->province ? $assignment->construction->province->name : 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Inicio</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ $assignment->start_date ? $assignment->start_date->format('d/m/Y') : 'N/A' }}
                            </dd>
                        </div>

                        @if ($assignment->end_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Fin</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $assignment->end_date->format('d/m/Y') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motivo de Fin</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $assignment->endReason ? $assignment->endReason->reason : 'No especificado' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kilómetros Registrados</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $assignment->kilometers !== null ? number_format($assignment->kilometers, 0, ',', '.') . ' km' : '-' }}
                                </dd>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 border-t pt-4 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                        <p>Registrada el: {{ $assignment->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-6 flex items-center space-x-4">
                        @if (is_null($assignment->end_date))
                            {{-- Si está activa, permitir finalizar o editar --}}
                            <a href="{{ route('asignaciones.showFinalizeForm', ['asignacione' => $assignment->id_assignment]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Finalizar
                            </a>
                            <a href="{{ route('asignaciones.edit', ['asignacione' => $assignment->id_assignment]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Editar
                            </a>
                        @endif
                        <a href="{{ route('asignaciones.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                            &laquo; Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
