<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with('currency')
            ->orderBy('order_column')
            ->get();
        
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::all();

        return view('accounts.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'currency' => 'required',
            'starting_balance' => 'numeric',
        ]);

        $currency = Currency::where('code', $request->currency)->first();

        $order = Account::max('order_column') + 1;

        $slug = str_replace(' ', '-', strtolower($request->name));

        $current_balance = $request->starting_balance;

        Account::create([
            'name' => $request->name,
            'type' => $request->type,
            'color' => $request->color,
            'icon' => $request->icon,
            'order_column' => $order,
            'slug' => $slug,
            'starting_balance' => $request->starting_balance,
            'current_balance' => $current_balance,
            'currency_id' => $currency->id,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = Account::with('currency')->findOrFail($id);
        $currencies = Currency::all();

        return view('accounts.edit', compact('account', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'currency' => 'required',
            'starting_balance' => 'numeric',
        ]);

        $currency = Currency::where('code', $request->currency)->first();

        $account = Account::findOrFail($id);

        $starting_balance = $account->starting_balance;

        $current_balance = $account->current_balance + ($request->starting_balance - $starting_balance);

        $account->update([
            'name' => $request->name,
            'currency_id' => $currency->id,
            'starting_balance' => $request->starting_balance,
            'current_balance' => $current_balance,
            'type' => $request->type,
            'color' => $request->color,
            'icon' => $request->icon,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);

        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }
}
