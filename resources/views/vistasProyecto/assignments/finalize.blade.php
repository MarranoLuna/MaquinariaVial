<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Finalizar Asignación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    {{-- Mostrar información de la asignación que se está finalizando --}}
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                        <h4 class="font-medium text-lg">Detalles de la Asignación a Finalizar:</h4>
                        <p><strong>Máquina:</strong> {{ $assignment->machine ? $assignment->machine->serial_number : 'N/A' }} ({{ $assignment->machine && $assignment->machine->type ? $assignment->machine->type->name : 'Sin tipo' }})</p>
                        <p><strong>Obra:</strong> {{ $assignment->construction ? $assignment->construction->name : 'N/A' }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') }}</p>
                    </div>

                    <form method="POST" action="{{ route('asignaciones.processFinalization', $assignment->id_assignment) }}">
                        @csrf
                        @method('PATCH') {{-- Usamos PATCH para actualizar la asignación existente --}}

                        {{-- Fecha de Fin --}}
                        <div class="mb-4">
                            <x-input-label for="end_date" :value="__('Fecha de Finalización')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                          :value="old('end_date', \Carbon\Carbon::now()->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        {{-- Kilómetros Recorridos --}}
                        <div class="mb-4">
                            <x-input-label for="kilometers" :value="__('Kilómetros Recorridos en esta Asignación')" />
                            <x-text-input id="kilometers" class="block mt-1 w-full" type="number" name="kilometers"
                                          :value="old('kilometers')" required min="0" placeholder="0" />
                            <x-input-error :messages="$errors->get('kilometers')" class="mt-2" />
                        </div>

                        {{-- Motivo de Fin (Desplegable) --}}
                        <div class="mb-4">
                            <x-input-label for="id_reason" :value="__('Motivo de Finalización')" />
                            <select name="id_reason" id="id_reason" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">{{ __('-- Seleccione un Motivo --') }}</option>
                                @if(isset($endReasons)) {{-- Asegurarse que $endReasons exista --}}
                                    @foreach($endReasons as $reason)
                                        <option value="{{ $reason->id_reason }}"
                                                {{ old('id_reason') == $reason->id_reason ? 'selected' : '' }}>
                                            {{ $reason->reason }} {{-- Asumiendo que la columna en EndReason se llama 'reason' --}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('id_reason')" class="mt-2" />
                        </div>

                        {{-- Botones --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('asignaciones.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button>
                                {{ __('Confirmar Finalización') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
