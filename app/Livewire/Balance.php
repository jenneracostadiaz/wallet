<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Currency;
use Livewire\Component;

class Balance extends Component
{
    public function render()
    {

        $accounts = Account::all();

        $accounts_PEN = Account::where('currency_id', 1)->sum('current_balance');
        $accounts_USD = Account::where('currency_id', 2)->sum('current_balance');
        $accounts_EUR = Account::where('currency_id', 3)->sum('current_balance');
        
        $yesterday = date('Y-m-d',strtotime("-1 days"));
        $dlr_api = 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha='.$yesterday;
        $json = file_get_contents($dlr_api);
        $data = json_decode($json, true);
        $compra_dolar = $data['compra'];
        $venta_dolar = $data['venta'];
        
        $accounts_USD = $accounts_USD * $compra_dolar;
        $balance = $accounts_PEN + $accounts_USD + $accounts_EUR;
        $balance = number_format($balance, 2, '.', ',');

        $accounts_PEN = number_format($accounts_PEN, 2, '.', ',');
        $accounts_USD = number_format($accounts_USD, 2, '.', ',');
        $accounts_EUR = number_format($accounts_EUR, 2, '.', ',');

        // Suma de current_balance de accounts tipo bank
        $accounts_bank_sum = Account::where('type', 'bank')->sum('current_balance');
        $accounts_bank_sum = number_format($accounts_bank_sum, 2, '.', ',');

        // Suma de current_balance de accounts tipo credit_card
        $accounts_credit_card_sum = Account::where('type', 'credit_card')->sum('current_balance');
        $accounts_credit_card_sum = number_format($accounts_credit_card_sum, 2, '.', ',');

        return view('livewire.balance', compact('accounts_PEN', 'accounts_USD', 'balance', 'accounts_bank_sum', 'accounts_credit_card_sum'));
    }
}
