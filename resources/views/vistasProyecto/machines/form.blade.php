{{-- resources/views/vistasProyecto/machines/_form.blade.php --}}

{{-- CSRF Token para seguridad del formulario --}}
@csrf

{{-- Campo Número de Serie --}}
<div class="mb-4">
    <x-input-label for="serial_number" :value="__('Número de Serie')" />
    <x-text-input id="serial_number" class="block mt-1 w-full" type="text" name="serial_number"
                  :value="old('serial_number', $machine->serial_number ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
</div>

{{-- Campo Tipo de Máquina (Desplegable) --}}
<div class="mb-4">
    <x-input-label for="id_type" :value="__('Tipo de Máquina')" />
    <select name="id_type" id="id_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">{{ __('-- Seleccione un Tipo --') }}</option>
        @foreach($machineTypes as $type)
            <option value="{{ $type->id_type }}"
                    {{ (old('id_type', $machine->id_type ?? '') == $type->id_type) ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
</div>

{{-- Campo Marca de Máquina (Desplegable) --}}
<div class="mb-4">
    <x-input-label for="id_brand" :value="__('Marca de Máquina')" />
    <select name="id_brand" id="id_brand" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">{{ __('-- Seleccione una Marca --') }}</option>
        @foreach($machineBrands as $brand)
            <option value="{{ $brand->id_brand }}"
                    {{ (old('id_brand', $machine->id_brand ?? '') == $brand->id_brand) ? 'selected' : '' }}>
                {{ $brand->brand }} {{-- Asumiendo que el campo en MachineBrand se llama 'brand' --}}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('id_brand')" class="mt-2" />
</div>

{{-- Campo Kilometraje --}}
<div class="mb-4">
    <x-input-label for="kilometers" :value="__('Kilometraje Inicial')" />
    <x-text-input id="kilometers" class="block mt-1 w-full" type="number" name="kilometers"
                  :value="old('kilometers', $machine->kilometers ?? 0)" required min="0" />
    <x-input-error :messages="$errors->get('kilometers')" class="mt-2" />
</div>

{{-- Botones --}}
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('maquinas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
        {{ __('Cancelar') }}
    </a>
    <x-primary-button>
        {{-- El texto del botón cambiará si estamos editando o creando --}}
        {{ isset($machine) ? __('Actualizar Máquina') : __('Guardar Máquina') }}
    </x-primary-button>
</div>