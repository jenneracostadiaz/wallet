<x-app-layout>
    <div class="sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-24 items-center py-4 px-4">
                    <h2 class="text-2xl font-bold">Accounts</h2>
                    <div class="flex flex-col sm:flex-row flex-1 gap-4">
                        {{-- Crate New --}}
                        <a href="{{ route('accounts.create') }}" class="flex justify-center items-center gap-2 py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6Z"/>
                            </svg>
                            <span class="sm:ms-2">Create New</span>
                        </a>
                        {{-- Search --}}
                        <form class="flex items-center flex-1">   
                            <label for="voice-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    💰
                                </div>
                                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search account" required>
                                <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7v3a5.006 5.006 0 0 1-5 5H6a5.006 5.006 0 0 1-5-5V7m7 9v3m-3 0h6M7 1h2a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V4a3 3 0 0 1 3-3Z"/>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>

                                <span class="hidden sm:block sm:ms-2">Search</span>
                            </button>
                        </form>
                        {{-- Store By --}}
                        <div class="flex">
                            <label for="store-by" class="sr-only">Store By</label>
                            <select id="store-by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="name">Name</option>
                                <option value="balance">Balance</option>
                                <option value="created_at">Created At</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Grid of Accounts --}}
                <div class="flex flex-col gap-4 items-center py-4 px-4 mt-4">
                    @foreach ($accounts as $account)
                        <div class="w-full py-4 px-8 gap-4 rounded-md shadow-lg bg-slate-700 border-l-4" style="border-color: {{ $account->color }}">
                            <div class="flex flex-row justify-between items-center gap-2">
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $account->icon }} {{ $account->name }}</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        @switch($account->type)
                                            @case('general')
                                                General
                                                @break
                                            @case('cash')
                                                Cash
                                                @break
                                            @case('bank')
                                                Bank
                                                @break
                                            @case('credit_card')
                                                Credit Card
                                                @break
                                            @case('saving_account')
                                                Saving Account
                                                @break
                                            @case('other')
                                                Other
                                                @break
                                            @default
                                                Other
                                        @endswitch
                                    </span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $account->currency->symbol }} {{ $account->current_balance }}
                                    </span>
                                    <span class="text-xs font-medium text-gray-900 dark:text-slate-300">
                                        Starting Balance:
                                        {{ $account->currency->symbol }} {{ $account->starting_balance }}
                                    </span>
                                </div>
                                <div class="flex justify-end items-end gap-2">
                                    <a href="{{ route('accounts.edit', $account->id) }}" class="flex justify-center items-center py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        ✏️
                                        <span class="sm:ms-1">Edit</span>
                                    </a>
                                    <div class="relative">
                                        <form id="delete-form-{{$account->id}}" action="{{ route('accounts.destroy', $account->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="removeCategory({{$account->id}})" class="flex justify-center items-center py-2.5 px-1 text-sm font-medium text-white text-center">
                                                🗑️
                                            </button>
                                            <button type="submit" class="hidden">
                                                delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- js --}}
    <script>
        const removeCategory = (id) => {
            const message = confirm(`Are you sure?`);
            const form = document.querySelector(`#delete-form-${id}`);
            if (message) {
                form.submit();
            }
        }
    </script>
    
</x-app-layout>
