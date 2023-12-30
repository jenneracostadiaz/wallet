<x-app-layout>
    <div class="sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-24 items-center py-2 px-4 ">
                    <h2 class="text-2xl font-bold">Edit Label</h2>
                    <div class="flex flex-col justify-end sm:flex-row flex-1 gap-4">
                        {{-- Return --}}
                        <a href="{{ route('labels.index') }}" class="flex justify-center items-center gap-2 py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                            </svg>
                            <span>Return</span>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-4 sm:gap-24 items-center py-8 px-4 border-t border-gray-100 mt-2 pt-8">
                    <form action="{{ route('labels.update', $label) }}" method="POST" class="w-full max-w-80 flex flex-col flex-1 gap-4">
                        @csrf
                        @method('PUT')
                        {{-- Name --}}
                        <div class="flex flex-col flex-1 gap-1">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" name="name" type="text" class="block mt-1 w-full" placeholder="Ex. Joe Done" required autofocus value="{{ $label->name }}" />
                        </div>
                        
                        {{-- Color --}}
                        <div class="flex flex-col flex-1 gap-1">
                            <x-label for="color" value="{{ __('Color') }}" />
                            <input type="color" name="color" id="color" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ $label->color }}">
                        </div>

                        {{-- Submit --}}
                        <div class="flex flex-col items-center flex-1 gap-1">
                            <x-button>
                                🔁 {{ __('Update Label') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>