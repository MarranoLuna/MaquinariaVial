
@csrf

{{-- Nombre de la Obra --}}
<div class="mb-4">
    <x-input-label for="name" :value="__('Nombre de la Obra')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                  :value="old('name', $construction->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

{{-- Provincia (Desplegable) --}}
<div class="mb-4">
    <x-input-label for="id_province" :value="__('Provincia')" />
    <select name="id_province" id="id_province" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">{{ __('-- Seleccione una Provincia --') }}</option>
        @foreach($provinces as $province)
            <option value="{{ $province->id_province }}"
                    {{ (old('id_province', $construction->id_province ?? '') == $province->id_province) ? 'selected' : '' }}>
                {{ $province->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('id_province')" class="mt-2" />
</div>

{{-- Fecha de Inicio --}}
<div class="mb-4">
    <x-input-label for="start_date" :value="__('Fecha de Inicio')" />
    <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                  :value="old('start_date', isset($construction) ? \Carbon\Carbon::parse($construction->start_date)->format('Y-m-d') : '')" required />
    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
</div>


{{-- Botones --}}
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('obras.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
        {{ __('Cancelar') }}
    </a>
    <x-primary-button>
        {{ isset($construction) ? __('Actualizar Obra') : __('Guardar Obra') }}
    </x-primary-button>
</div>
