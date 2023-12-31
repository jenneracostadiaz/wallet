<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Label;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::where('user_id', auth()->user()->id)
            ->with('account', 'currency', 'category', 'label')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(25);

        foreach ($records as $record) {
            if ($record->category) {
                $record->category->parent_name = $record->category->parent->name;
            }
        }

        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = Account::all();
        $currencies = Currency::all();
        
        $categories = Category::whereNull('parent_id')
                    ->select('id', 'name', 'icon', 'parent_id')
                    ->get();

        foreach ($categories as $category) {
            $category->subcategories = Category::where('parent_id', $category->id)
                ->select('id', 'name', 'icon', 'parent_id')
                ->get();
        }

        $labels = Label::all();
        $currentDate = now()->format('Y-m-d');
        $currentTime = now()->format('H:i');
        
        return view('records.create', compact('accounts', 'currencies', 'categories', 'labels', 'currentDate', 'currentTime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: add validation for transfer type
        $request->validate([
            'type' => 'required|in:expense,income,transfer', // 'in' is a validation rule that checks if the value is in the given array
            'account' => 'required|exists:accounts,id',
            'currency' => 'required|exists:currencies,id',
            'category' => 'nullable|exists:categories,id',
            'label' => 'nullable|exists:labels,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $user_id = auth()->user()->id;

        $record = new Record();
        $record->type = $request->type;
        $record->account_id = $request->account;
        $record->amount = $request->amount;
        $record->currency_id = $request->currency;
        $record->category_id = $request->category;
        $record->label_id = $request->label;
        $record->date = $request->date;
        $record->time = $request->time;
        $record->user_id = $user_id;
        $record->save();

        return redirect()->route('records.index')->with('success', 'Record created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
