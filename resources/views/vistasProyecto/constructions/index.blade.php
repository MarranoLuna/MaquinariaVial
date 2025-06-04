<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Obras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Obras Registradas</h3>
                         <a href="{{ route('obras.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded"> 
                            Añadir Nueva Obra
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($obras->isEmpty())
                        <p>No hay obras registradas por el momento.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nombre de la Obra
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Provincia
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Fecha Inicio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Fecha Fin 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($obras as $obra)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $obra->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $obra->province ? $obra->province->name : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $obra->start_date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $obra->end_date ? $obra->end_date->format('d/m/Y') : 'Indefinida' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                {{-- Icono Ver Detalles --}}
                                                <a href="{{ route('obras.show', ['obra' => $obra->id_construction]) }}" class="text-black hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200" title="Ver Detalles">
                                                    {{-- SVG del ojo --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                </a>

                                                {{-- Icono Editar (Lápiz) --}}
                                                {{-- Solo permitir editar si la obra no está finalizada (end_date es nulo) --}}
                                                @if(is_null($obra->end_date) || \Carbon\Carbon::parse($obra->end_date)->isFuture() || \Carbon\Carbon::parse($obra->end_date)->isToday())
                                                    <a href="{{ route('obras.edit', ['obra' => $obra->id_construction]) }}" class="text-black hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-200" title="Editar Obra">
                                                        {{-- SVG del lápiz --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                    </a>

                                                    {{-- Botón/Icono para FINALIZAR OBRA (Check Verde) --}}
                                                    <form action="{{ route('obras.finalize', ['obra' => $obra->id_construction]) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de finalizar esta obra? Asegúrate de que todas las asignaciones de máquinas a esta obra también hayan sido finalizadas.');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="text-black hover:text-green-800 dark:text-green-400 dark:hover:text-green-200 inline-flex items-center"
                                                                title="Finalizar Obra">
                                                            {{-- Icono Check --}}
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="w-5 h-5 opacity-0" aria-hidden="true"></span> {{-- Placeholder para Editar si está finalizada --}}
                                                    <span class="w-5 h-5 opacity-0" aria-hidden="true"></span> {{-- Placeholder para Finalizar si está finalizada --}}
                                                @endif


                                                {{-- Icono Eliminar (Tacho de Basura) --}}
                                                <form action="{{ route('obras.destroy', ['obra' => $obra->id_construction]) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta obra?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-black hover:text-red-700 dark:text-red-400 dark:hover:text-red-200 inline-flex items-center"
                                                            title="Eliminar Obra">
                                                        {{-- SVG del tacho de basura --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        </tr>
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
