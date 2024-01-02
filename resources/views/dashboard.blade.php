@php
    $accounts = \App\Models\Account::all();
@endphp
<x-app-layout>

    {{-- Accounts --}}
    <div class="w-11/12 py-12 max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-4 xl:px-8">
        @foreach ($accounts as $account)
            @if ($account->current_balance > 1)
                <div class="w-full py-2 px-4 rounded-md shadow-lg bg-slate-700 border-l-4" style="border-color: {{ $account->color }}">
                    <div class="w-full flex flex-col sm:flex-row justify-between sm:items-center sm:gap-2">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $account->icon }} {{ $account->name }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ $account->currency->symbol }} {{ $account->current_balance }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-row ml-5 hidden sm:block">
                        <span class="text-xs font-medium text-gray-900 dark:text-slate-300">
                            Starting Balance:
                            {{ $account->currency->symbol }} {{ $account->starting_balance }}
                        </span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    
</x-app-layout>
