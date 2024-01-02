<div class="grid gap-2">
    <div class="flex justify-between">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Balance S/. {{ $balance }}</h2>
        <div class="row">
            <p class="font-semibold text-gray-900 dark:text-white mb-2">Total (PEN) S/. {{ $accounts_PEN }}</p>
            <p class="font-semibold text-gray-900 dark:text-white mb-2">Total (USD) $ {{ $accounts_USD }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div class="w-full py-4 px-4 rounded-md shadow-lg bg-slate-700 border-l-4 border-green-600">
            <div class="w-full flex flex-row justify-between items-center gap-2">
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Debito</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-bold text-gray-900 dark:text-white">
                        S/. {{ $accounts_bank_sum }}
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full py-4 px-4 rounded-md shadow-lg bg-slate-700 border-l-4 border-red-600">
            <div class="w-full flex flex-row justify-between items-center gap-2">
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Crédito</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-bold text-gray-900 dark:text-white">
                        S/. {{ $accounts_credit_card_sum }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
</div>
