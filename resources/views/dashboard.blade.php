
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Control Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-8 text-center">
                        Sistema de Gestión de Maquinaria Vial
                    </h3>

                    <div class="flex flex-wrap justify-center gap-6">

                        {{-- Tarjeta Obras --}}
                        <a href="{{ route('obras.index') }}"
                           class="flex flex-col items-center justify-between p-4 sm:p-6 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 text-center
                                  w-full sm:w-64 md:w-72 min-h-[420px] md:min-h-[480px]">

                            <div class="flex-grow flex flex-col items-center justify-center pt-4 w-full"> 
                                <img src="{{ asset('\images\Obras.jfif') }}"
                                     alt="Icono Obras" class="mb-4 h-32 w-32 md:h-36 md:w-36 object-contain"> 
                                <h5 class="mb-2 text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                                    Gestionar Obras
                                </h5>
                            </div>
                            <p class="font-normal text-sm text-gray-700 dark:text-gray-400 mt-2 px-2">
                                Proyectos de construcción.
                            </p>
                        </a>


                        {{-- Tarjeta Máquinas --}}
                        <a href="{{ route('maquinas.index') }}"
                           class="flex flex-col items-center justify-between p-4 sm:p-6 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 text-center
                                  w-full sm:w-64 md:w-72 min-h-[420px] md:min-h-[480px]">
                            <div class="flex-grow flex flex-col items-center justify-center pt-4 w-full">
                                <img src="{{ asset('\images\Maquinas.jfif') }}" {{-- Reemplaza con tu ruta --}}
                                     alt="Icono Máquinas" class="mb-4 h-32 w-32 md:h-36 md:w-36 object-contain">
                                <h5 class="mb-2 text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                                    Gestionar Máquinas
                                </h5>
                            </div>
                            <p class="font-normal text-sm text-gray-700 dark:text-gray-400 mt-2 px-2">
                                Inventario y estado.
                            </p>
                        </a>


                        {{-- Tarjeta Asignaciones --}}
                        <a href="{{ route('asignaciones.index') }}"
                           class="flex flex-col items-center justify-between p-4 sm:p-6 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 text-center
                                  w-full sm:w-64 md:w-72 min-h-[420px] md:min-h-[480px]">
                           <div class="flex-grow flex flex-col items-center justify-center pt-4 w-full">
                                <img src="{{ asset('\images\Asignaciones.jfif') }}" {{-- Reemplaza con tu ruta --}}
                                     alt="Icono Asignaciones" class="mb-4 h-32 w-32 md:h-36 md:w-36 object-contain">
                                <h5 class="mb-2 text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                                    Gestionar Asignaciones
                                </h5>
                            </div>
                            <p class="font-normal text-sm text-gray-700 dark:text-gray-400 mt-2 px-2">
                                Tareas e historiales.
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>