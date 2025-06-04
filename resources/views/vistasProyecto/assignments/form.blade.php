{{-- resources/views/vistasProyecto/assignments/_form.blade.php --}}

@csrf

{{-- Máquina (Desplegable con máquinas disponibles) --}}
<div class="mb-4">
    <x-input-label for="id_machine" :value="__('Máquina (Disponible)')" />
    <select name="id_machine" id="id_machine" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">{{ __('-- Seleccione una Máquina --') }}</option>
        @foreach($availableMachines as $machine)
            <option value="{{ $machine->id_machine }}" {{ old('id_machine', $assignment->id_machine ?? '') == $machine->id_machine ? 'selected' : '' }}>
                {{ $machine->serial_number }} ({{ $machine->type->name ?? 'Sin tipo' }} - {{ $machine->brand->brand ?? 'Sin marca' }})
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('id_machine')" class="mt-2" />
</div>

{{-- Obra (Desplegable) --}}
<div class="mb-4">
    <x-input-label for="id_construction" :value="__('Obra')" />
    <select name="id_construction" id="id_construction" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">{{ __('-- Seleccione una Obra --') }}</option>
        @foreach($constructions as $construction)
            <option value="{{ $construction->id_construction }}" {{ old('id_construction', $assignment->id_construction ?? '') == $construction->id_construction ? 'selected' : '' }}>
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
                  :value="old('start_date', isset($assignment) ? \Carbon\Carbon::parse($assignment->start_date)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d'))" required />
    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
</div>


<div class="flex items-center justify-end mt-6">
    <a href="{{ route('asignaciones.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
        {{ __('Cancelar') }}
    </a>
    <x-primary-button>
        {{-- El texto del botón cambiará si estamos editando o creando --}}
        {{ isset($assignment) ? __('Actualizar Asignación') : __('Guardar Asignación') }}
    </x-primary-button>
</div>
