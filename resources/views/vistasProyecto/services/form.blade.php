{{-- resources/views/vistasProyecto/services/_form.blade.php --}}
@csrf

<div class="mb-4">
    <x-input-label for="service" :value="__('Nombre del Servicio')" />
    <x-text-input id="service" class="block mt-1 w-full" type="text" name="service"
                  :value="old('service', $service->service ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('service')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="kilometers" :value="__('Intervalo de Kilómetros para Mantenimiento')" />
    <x-text-input id="kilometers" class="block mt-1 w-full" type="number" name="kilometers"
                  :value="old('kilometers', $service->kilometers ?? 0)" required min="0" />
    <x-input-error :messages="$errors->get('kilometers')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('services.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
        {{ __('Cancelar') }}
    </a>
    <x-primary-button>
        {{ isset($service) ? __('Actualizar Servicio') : __('Guardar Servicio') }}
    </x-primary-button>
</div>