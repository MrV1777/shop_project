<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'description' => 'nullable|string|max:500',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_icon_' . $icon->getClientOriginalName();
            $icon->move(public_path('images/categories/icons'), $iconName);
            $iconPath = 'images/categories/icons/' . $iconName;
        }

        Category::create([
            'name' => $request->name,
            'icon' => $iconPath,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('category.index')->with('success', 'Category added successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'description' => 'nullable|string|max:500',
        ]);

        $category = Category::findOrFail($id);

        $iconPath = $category->icon;
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($category->icon && file_exists(public_path($category->icon))) {
                unlink(public_path($category->icon));
            }

            $icon = $request->file('icon');
            $iconName = time() . '_icon_' . $icon->getClientOriginalName();
            $icon->move(public_path('images/categories/icons'), $iconName);
            $iconPath = 'images/categories/icons/' . $iconName;
        }

        $category->update([
            'name' => $request->name,
            'icon' => $iconPath,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        // Delete icon if exists
        if ($category->icon && file_exists(public_path($category->icon))) {
            unlink(public_path($category->icon));
        }
        
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
