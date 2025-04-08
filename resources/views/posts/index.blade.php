<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{-- -Aquie empieza el fomr post --}}
            <!-- Card de bienvenida -->
            <div class="mb-6 p-6 bg-gradient-to-r from-indigo-800 to-teal-600 text-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center"> Bienvenido a BISON </h2>
                <p class="text-center mt-2">Comparte tus pensamientos con la comunidad.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-black-100">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf 
                        <textarea name="message" 
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm
                            @error('message') border-red-300 text-white dark:border-red-300 dark:text-white
                            @enderror
                            focus:border-indigo-200 focus:ring focus:ring-green-400 focus:ring-opacity-50 dark:border-gray-600
                            dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200
                            dark:focus:ring-opacity-50"
                            placeholder="{{__('¿Qué estás pensando?') }}">{{ old('message') }}</textarea>

                        <x-input-error :messages="$errors->get('message')"></x-input-error>

                        <x-primary-button class="mt-6 w-full bg-indigo-600 hover:bg-teal-700 text-white py-2 rounded-md">
                            {{__("Publicar") }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
            
        </div>
        {{--Aqui termina--}}
        
               
                    {{-- -Aqui van los posts --}}
                    @foreach ($posts as $post )
                    
                   
                     <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                        <div class="p-6 flex space-x-2">
                        <svg class="h-8 w-8 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-4">
  <path strokeLinecap="round" strokeLinejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>

                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                <span class="text-gray-800 dark:text-gray-200">
                                    {{ $post->user->name }}
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
{{--      {{ $post->created_at->diffForHumans() }}--}}
                                    {{ $post->created_at->format('d M Y g: i a') }}
                                </small>
                                <!-- @if($post->created_at != $post->updated_at)
                            <small class="ml-2 text-sm text-gray-500 dark:text-gray-400">
                                &middot; {{_('Edited') }}</small>
                                @endif -->

                                {{-- Utilizando operadores de control comparativo--}}
                                @unless($post->created_at->eq($post->updated_at))
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    &middot; {{ _('Edited') }}
                                </small>
                            @endunless

                               </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                    {{$post->message}}
                </p>
                     </div>
                     <!-- @if($post->user_id==auth()->user()->id) -->
                      @can ('update', $post)
                     <x-dropdown>
                        <x-slot name="trigger">
                        <button ><svg class="w-9 h-7 text-gray-300 bg-gray-800 rounded-md dark:text-gray-200 dark:hover:bg-gray-600 dark:rounded-md" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
</svg>
</button>
                        </x-slot>
                        <x-slot  name="content">
                            <x-dropdown-link :href="route('posts.edit',$post->id)">{{__('Edit') }}</x-dropdown-link>
                          
                            {{-- -Esto es eliminar Directamente --}}
                        <!-- <form action="{{route('posts.destroy',$post)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <x-dropdown-link :href="route('posts.destroy',$post->id)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{__('Delete') }}
                        </x-dropdown-link>
                        </form> -->
                        <div x-data="{showConfirm: false}">
                        <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy',$post) }}" method="POST">
                        @csrf
                            @method('DELETE')
                            {{-- -Crear el button para abrir el modal --}}
                            <x-dropdown-link href="#" x-on:click.stop.prevent="showConfirm = true">
                                {{__('Delete') }}

                            </x-dropdown-link>
                            </form>

                            {{-- -Diseno del modal de confirmacion --}}
                            <div x-show="showConfirm" x-cloak class="fixed inset-0 flex items-center
                                                                 justify-center bg-black/50 p-4" x-on:click="showConfirm=false">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-75">
                                    <h2 class="bg-white font-semibold text-gray-900 dark:text-gray-900">
                                        {{ _('Are you sure you want to delete this post?') }}
                                    </h2>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                                        {{__ ('This action cannt be undone!')}}
                                    </p>
                        {{-- -Botones de confimacion y cancelacion --}}
                        <div class="mt-4 flex justify-end space-x-2">
                            <button x-on:click="showConfirm = false"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                                {{ __('No, keep it!') }}
                            </button>
                            <Button  x-on:click="document.getElementById('delete-post-form-{{ $post->id }}').submit()" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                {{__('Yes, delete it! :)') }}
                            </Button>
                        </div>
                        
                                </div>
                            </div>
                        </div>

                    </x-slot>

                     </x-dropdown>
                     <!-- @endif -->
                     @endcan
                </div>
            </div>
   
    @endforeach
    {{-- -Aqui terminan los post --}}
      </div>
    </div>
</x-app-layout>
