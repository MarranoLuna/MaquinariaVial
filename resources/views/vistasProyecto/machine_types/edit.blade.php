<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold ...">{{ __('Editar Tipo de Máquina') }}: {{ $machineType->name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto ...">
            <div class="bg-white ...">
                <div class="p-6 ...">
                    <form method="POST" action="{{ route('machine_types.update', ['machineType' => $machineType->id_type]) }}"> {{-- Ajusta 'machineType' si personalizaste el parámetro --}}
                        @csrf
                        @method('PUT')
                        @include('vistasProyecto.machine_types.form', ['machineType' => $machineType])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>