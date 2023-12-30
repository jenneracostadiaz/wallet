<x-app-layout>
    <div class="sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-24 items-center py-2 px-4 ">
                    <h2 class="text-2xl font-bold">Edit Account</h2>
                    <div class="flex flex-col justify-end sm:flex-row flex-1 gap-4">
                        {{-- Return --}}
                        <a href="{{ route('accounts.index') }}" class="flex justify-center items-center gap-2 py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                            </svg>
                            <span>Return</span>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-4 sm:gap-24 items-center py-8 px-4 border-t border-gray-100 mt-2 pt-8">
                    <form action="{{ route('accounts.update', $account) }}" method="POST" class="w-full max-w-80 flex flex-col flex-1 gap-4">
                        @csrf
                        @method('PUT')
                        {{-- Name --}}
                        <div class="flex flex-col flex-1 gap-1">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" name="name" type="text" class="block mt-1 w-full" placeholder="Ex. Joe Done" required autofocus value="{{ $account->name }}" />
                        </div>
                        {{-- Type --}}
                        <div class="flex flex-col flex-1 gap-1">
                            <x-label for="type" value="{{ __('Type') }}" />
                            <select name="type" id="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="general" @if ($account->type == 'general') selected @endif>General</option>
                                <option value="cash" @if ($account->type == 'cash') selected @endif>Cash</option>
                                <option value="bank" @if ($account->type == 'bank') selected @endif>Bank</option>
                                <option value="credit_card" @if ($account->type == 'credit_card') selected @endif>Credit</option>
                                <option value="saving_account" @if ($account->type == 'saving_account') selected @endif>Saving Account</option>
                                <option value="other" @if ($account->type == 'other') selected @endif>Other</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            {{-- Color --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="color" value="{{ __('Color') }}" />
                                <input type="color" name="color" id="color" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ $account->color }}">
                            </div>
                            {{-- Icon --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="icon" value="{{ __('Icon') }}" />
                                <x-input id="icon" name="icon" type="text" class="block mt-1 w-full"  placeholder="Ex. 💵" autofocus value="{{ $account->icon }}" />
                            </div>
                        </div>

                        <div class="flex gap-2">
                            {{-- starting_balance --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="starting_balance" value="{{ __('Starting Balance') }}" />
                                <x-input id="starting_balance" name="starting_balance" type="number" class="block mt-1 w-full" pattern="^\d*(\.\d{0,2})?$" min="0" value="{{ $account->starting_balance }}" step="any" placeholder="Ex. 1000" autofocus />
                            </div>
                            {{-- Currency --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="currency" value="{{ __('Currency') }}" />
                                <select name="currency" id="currency" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->code }}" @if ($account->currency_id == $currency->id) selected @endif>{{ $currency->name }} ({{ $currency->symbol }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex flex-col items-center flex-1 gap-1">
                            <x-button>
                                🔁 {{ __('Update Account') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>