<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Asignación') }}
            @if($assignment->machine && $assignment->construction)
                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                    (Máquina: {{ $assignment->machine->serial_number }} / Obra Actual: {{ $assignment->construction->name }})
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('asignaciones.update', ['asignacione' => $assignment->id_assignment]) }}">
                        @csrf
                        @method('PUT') {{-- O 'PATCH' --}}

                        {{-- Máquina (Mostrar como información, no editable aquí) --}}
                        <div class="mb-6">
                            <x-input-label :value="__('Máquina Asignada')" />
                            <p class="mt-1 block w-full p-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                {{ $assignment->machine ? $assignment->machine->serial_number : 'N/A' }}
                                ({{ $assignment->machine && $assignment->machine->type ? $assignment->machine->type->name : 'Sin tipo' }} - {{ $assignment->machine && $assignment->machine->brand ? $assignment->machine->brand->brand : 'Sin marca' }})
                            </p>
                            <span class="text-xs text-gray-500 dark:text-gray-400">La máquina no se puede cambiar desde este formulario de edición.</span>
                        </div>

                        {{-- Obra (Desplegable) --}}
                        <div class="mb-4">
                            <x-input-label for="id_construction" :value="__('Obra')" />
                            <select name="id_construction" id="id_construction" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">{{ __('-- Seleccione una Obra --') }}</option>
                                @foreach($constructions as $construction)
                                    <option value="{{ $construction->id_construction }}"
                                            {{ old('id_construction', $assignment->id_construction) == $construction->id_construction ? 'selected' : '' }}>
                                        {{ $construction->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_construction')" class="mt-2" />
                        </div>

                        {{-- Fecha de Inicio --}}
                        <div class="mb-4">
                            <x-input-label for="start_date" :value="__('Fecha de Inicio')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                          :value="old('start_date', $assignment->start_date->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        {{-- Botones --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('asignaciones.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button>
                                {{ __('Actualizar Asignación') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
