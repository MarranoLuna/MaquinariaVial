<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold ...">{{ __('Añadir Nuevo Tipo de Máquina') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto ...">
            <div class="bg-white ...">
                <div class="p-6 ...">
                    <form method="POST" action="{{ route('machine_types.store') }}">
                        @include('vistasProyecto.machine_types.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>