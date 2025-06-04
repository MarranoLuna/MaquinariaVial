<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Asignaciones de Maquinaria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Asignaciones Registradas</h3>
                        <a href="{{ route('asignaciones.create') }}" class="bg-purple-500 hover:bg-purple-700 text-black font-bold py-2 px-4 rounded">
                            Crear Nueva Asignación
                        </a>
                    </div>



                    @if($asignaciones->isEmpty())
                        <p>No hay asignaciones registradas por el momento.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Máquina (Nº Serie)
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Obra Asignada
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Fecha Inicio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Fecha Fin
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Motivo Fin
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Km Recorridos
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($asignaciones as $asignacion)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $asignacion->machine ? $asignacion->machine->serial_number : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $asignacion->construction ? $asignacion->construction->name : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($asignacion->start_date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $asignacion->end_date ? \Carbon\Carbon::parse($asignacion->end_date)->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $asignacion->endReason ? $asignacion->endReason->reason : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $asignacion->kilometers !== null ? number_format($asignacion->kilometers, 0, ',', '.') . ' km' : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if (is_null($asignacion->end_date))
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                        Activa
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                        Finalizada
                                                    </span>
                                                @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">

                                                @if (is_null($asignacion->end_date))
                                                    {{-- 1. ACCIÓN SI ESTÁ ACTIVA: Icono para FINALIZAR  --}}
                                                    <a href="{{ route('asignaciones.showFinalizeForm', $asignacion->id_assignment) }}"
                                                    class="text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white"
                                                    title="Finalizar Asignación">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    {{-- 1. ACCIÓN SI ESTÁ FINALIZADA: Icono para VER DETALLES --}}
                                            <a href="{{ route('asignaciones.show', $asignacion->id_assignment) }}"
                                                    class="text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white"
                                                    title="Ver Detalles">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </a> 

                                                    <span class="w-5 h-5 opacity-0" aria-hidden="true"></span> {{-- Placeholder invisible para alineación --}}
                                                @endif

                                                {{-- 2. ACCIÓN: Icono Editar - SOLO SI LA ASIGNACIÓN ESTÁ ACTIVA --}}
                                                @if (is_null($asignacion->end_date))
                                            <a href="{{ route('asignaciones.edit', ['asignacione' => $asignacion->id_assignment]) }}"
                                            class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-200"
                                            title="Editar Asignación">
                                                {{-- SVG del lápiz --}}
                                            <a href="{{ route('asignaciones.show', $asignacion->id_assignment) }}" class="text-gray-700 hover:text-black dark:text-indigo-400 dark:hover:text-indigo-200" title="Ver Detalles">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="w-5 h-5 opacity-0" aria-hidden="true"></span> {{-- Placeholder --}}
                                        @endif

                                                {{-- 3. ACCIÓN: Icono Eliminar --}}

                                                <form action="{{ route('asignaciones.destroy', ['asignacione' => $asignacion->id_assignment]) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta asignación?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-200 inline-flex items-center"
                                                            title="Eliminar Asignación">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form> 
                                            </div>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
