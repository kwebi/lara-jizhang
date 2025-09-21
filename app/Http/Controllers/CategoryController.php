<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('parent')
            ->where('user_id', $request->user()->id)->paginate(15)->withQueryString();
        
        return view('categories.index', compact('categories'));
    }
    
    public function create()
    {
        $parents = Category::roots()->ordered()->get();
        return view('categories.create', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', '分类已创建');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->ordered()->get();
        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', '分类已更新');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', '分类已删除');
    }
}
