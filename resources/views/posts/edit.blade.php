<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{-- -Aquie empieza el fomr edit --}}
            <!-- Card de bienvenida -->
            <div class="mb-6 p-6 bg-gradient-to-r from-indigo-800 to-teal-600 text-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center">  APARTADO DE EDITAR </h2>
                <p class="text-center mt-2">Comparte tus pensamientos con la comunidad.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-black-100">
                    <form method="POST" action="{{ route('posts.update',$post->id) }}">
                        @method('PATCH')
                        @csrf 
                        <textarea name="message" 
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm
                            @error('message') border-red-300 text-white dark:border-red-300 dark:text-white
                            @enderror
                            focus:border-indigo-200 focus:ring focus:ring-green-400 focus:ring-opacity-50 dark:border-gray-600
                            dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200
                            dark:focus:ring-opacity-50"
                            placeholder="{{ __('¿Qué estás pensando?') }}">{{ old('message',$post->message) }}</textarea>

                        <x-input-error :messages="$errors->get('message')"></x-input-error>

                        <x-primary-button class="mt-6 w-full bg-indigo-600 hover:bg-teal-700 text-white py-2 rounded-md">
                            {{ __("Guardar Cambios") }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        {{--Aqui termina--}}
        </div>
        </div>
        </x-app-layout>