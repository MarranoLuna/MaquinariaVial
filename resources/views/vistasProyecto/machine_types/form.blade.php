@csrf
<div class="mb-4">
    <x-input-label for="name" :value="__('Nombre del Tipo de Máquina')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                  :value="old('name', $machineType->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('machine_types.index') }}" class="text-sm ... mr-4">{{ __('Cancelar') }}</a>
    <x-primary-button>
        {{ isset($machineType) ? __('Actualizar Tipo') : __('Guardar Tipo') }}
    </x-primary-button>
</div>