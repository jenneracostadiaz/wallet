<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('order_column')
            ->select('id', 'name', 'slug', 'visibility', 'color', 'icon', 'parent_id', 'order_column')
            ->get();

        foreach ($categories as $parent_category) {
            $parent_category->subcategories = Category::where('parent_id', $parent_category->id)
                ->orderBy('order_column')
                ->get();
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('order_column')
            ->select('id', 'name', 'slug', 'visibility', 'color', 'icon', 'parent_id', 'order_column')
            ->get();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->name));
        $visibility = true;
        $order_column = Category::max('order_column') + 1;

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'visibility' => $visibility,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'order_column' => $order_column,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
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
        $category = Category::find($id);
        $categories = Category::whereNull('parent_id')
            ->orderBy('order_column')
            ->select('id', 'name', 'slug', 'visibility', 'color', 'icon', 'parent_id', 'order_column')
            ->get();
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::find($id)->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
