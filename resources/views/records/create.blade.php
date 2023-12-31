<x-app-layout>
    <div class="sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-24 items-center py-2 px-4 ">
                    <h2 class="text-2xl font-bold">Create Record</h2>
                    <div class="flex flex-col justify-end sm:flex-row flex-1 gap-4">
                        {{-- Return --}}
                        <a href="{{ route('records.index') }}" class="flex justify-center items-center gap-2 py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                            </svg>
                            <span>Return</span>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-4 sm:gap-24 items-center py-8 px-4 border-t border-gray-100 mt-2 pt-8">
                    {{-- Mensaje de error --}}
                    @if ($errors->any())
                        <div class="flex flex-col gap-2 items-center">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li class="text-xs">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('records.store')}}" method="POST" class="w-full max-w-lg flex flex-col flex-1 gap-4" x-data="{ transfer: false }">
                        @csrf
                        <div class="flex flex-col flex-1 gap-1">
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                <li>
                                    <input type="radio" id="expense" name="type" value="expense" class="hidden peer" required checked>
                                    <label @click="transfer = false" for="expense" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="w-full text-center text-md font-semibold">Expence</div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="income" name="type" value="income" class="hidden peer">
                                    <label @click="transfer = false" for="income" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="w-full text-center text-md font-semibold">Income</div>
                                    </label>
                                </li>
                                <li >
                                    <input type="radio" id="transfer" name="type" value="transfer" class="hidden peer">
                                    <label @click="transfer = true" for="transfer" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="w-full text-center text-md font-semibold">Transfer</div>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-center items-center w-full flex-col sm:flex-row flex-1 gap-2 mt-8 sm:mt-4">
                            <section id="account-1" class="flex-1 flex flex-col gap-4">
                                {{-- Account --}}
                                <div class="flex flex-col flex-1 gap-1">
                                    <x-label for="account" value="{{ __('From Account') }}" />
                                    <select id="account" name="account" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required autofocus >
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->icon }} {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="flex flex-1 gap-2">
                                    {{-- Amount --}}
                                    <div class="flex flex-col flex-1 gap-1">
                                        <x-label for="amount" value="{{ __('Amount') }}" />
                                        <div class="flex items-center gap-1">
                                            <div id="symbol_amount" class="text-xs">➖</div>
                                            <x-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('ammount', 0.00)" min="0.00" max="10000.00" step="0.10" attern="^\d*(\.\d{2}$)?" required autofocus />
                                        </div>
                                    </div>
                                    {{-- Currency --}}
                                    <div class="flex flex-col flex-1 gap-1">
                                        <x-label for="currency" value="{{ __('Currency') }}" />
                                        <select id="currency" name="currency" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required autofocus >
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}">{{ $currency->symbol }} {{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </section>

                            <template x-if="transfer">
                                <section class="text-3xl text-center pb-2 pt-6 sm:pb-0 sm:pt-0 sm:px-2">
                                    <span class="sm:hidden">⏬</span>
                                    <span class="hidden sm:block">➡️</span>
                                </section>
                            </template>
                            <template x-if="transfer">
                                <section id="account-2" class="flex-1 flex flex-col gap-4">
                                    
                                    <div class="flex flex-col flex-1 gap-1">
                                        <x-label for="account_2" value="{{ __('To Account') }}" />
                                        <select id="account_2" name="account_2" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required autofocus >
                                            @foreach ($accounts as $key => $account)
                                                <option value="{{ $account->id }}"
                                                    @if ($key == 0)
                                                        disabled
                                                    @endif
                                                >{{ $account->icon }} {{ $account->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="flex flex-1 gap-2">
                                        
                                        <div class="flex flex-col flex-1 gap-1">
                                            <x-label for="amount_2" value="{{ __('Amount') }}" />
                                            <div class="flex items-center gap-1">
                                                <div id="symbol_amount_2" class="text-xs">➕</div>
                                                <x-input id="amount_2" class="block mt-1 w-full" type="number" name="amount_2" :value="old('ammount', 0.00)" min="0.00" max="10000.00" step="0.10" attern="^\d*(\.\d{2}$)?" required autofocus />
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col flex-1 gap-1">
                                            <x-label for="currency_2" value="{{ __('Currency') }}" />
                                            <select id="currency_2" name="currency_2" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required autofocus >
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}"> {{ $currency->symbol }} {{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </section>
                            </template>

                        </div>


                        <div class="flex flex-1 gap-2">
                            {{-- Category --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="category" value="{{ __('Category') }}" />
                                <select id="category" name="category" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required autofocus >
                                    @foreach ($categories as $category)
                                        <optgroup label="{{$category->icon}} {{$category->name}}">
                                            @foreach ($category->subcategories as $subcategories)
                                                <option value="{{ $subcategories->id }}">
                                                    {{ $subcategories->icon }} {{ $subcategories->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Label --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="label" value="{{ __('Label') }}" />
                                <select id="label" name="label" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" autofocus >
                                    <option value="none">None</option>
                                    @foreach ($labels as $label)
                                        <option value="{{ $label->id }}">
                                             {{ $label->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex flex-1 gap-2">
                            {{-- Date --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="date" value="{{ __('Date') }}" />
                                <x-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $currentDate }}" required autofocus />
                            </div>
                            {{-- Time --}}
                            <div class="flex flex-col flex-1 gap-1">
                                <x-label for="time" value="{{ __('Time') }}" />
                                <x-input id="time" class="block mt-1 w-full" type="time" name="time" value="{{ $currentTime }}" required autofocus />
                            </div>
                        </div>
                        
                        {{-- Submit --}}
                        <div class="flex flex-col flex-1 gap-1">
                            <button type="submit" class="flex justify-center items-center gap-2 py-2.5 px-3 text-sm font-medium text-white text-center bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="
                                    round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6Z"/>
                                </svg>
                                <span class="sm:ms-2">Create</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const type = document.getElementsByName('type');
        const symbol_amount = document.getElementById('symbol_amount');
        
        type.forEach(element => {
            element.addEventListener('change', () => {
                if (element.value == 'expense') {
                    symbol_amount.innerHTML = '➖';
                } else if (element.value == 'income') {
                    symbol_amount.innerHTML = '➕';
                } else if (element.value == 'transfer') {
                    const symbol_amount_2 = document.getElementById('symbol_amount_2');
                    symbol_amount.innerHTML = '➖';
                    symbol_amount_2.innerHTML = '➕';
                }

                if (element.value == 'transfer'){
                    const amount = document.getElementById('amount');
                    const amount_2 = document.getElementById('amount_2');
                    const currency = document.getElementById('currency');
                    const currency_2 = document.getElementById('currency_2');
                    const account = document.getElementById('account');
                    const account_2 = document.getElementById('account_2');

                    amount.addEventListener('change', () => {
                        amount_2.value = amount.value;
                    });

                    amount_2.addEventListener('change', () => {
                        amount.value = amount_2.value;
                    });

                    account.addEventListener('change', () => {
                        const selectedValue = account.value;
                        for (let i = 0; i < account_2.options.length; i++) {
                            if (account_2.options[i].value === selectedValue) {
                                account_2.options[i].disabled = true;
                            } else {
                                account_2.options[i].disabled = false;
                            }
                        }
                    });

                    account_2.addEventListener('change', () => {
                        const selectedValue = account_2.value;
                        for (let i = 0; i < account.options.length; i++) {
                            if (account.options[i].value === selectedValue) {
                                account.options[i].disabled = true;
                            } else {
                                account.options[i].disabled = false;
                            }
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>