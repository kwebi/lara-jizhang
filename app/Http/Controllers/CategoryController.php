<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // $categories = Category::with('parent')
        // ->where('user_id', $request->user()->id)->paginate(15)->withQueryString();
        // $parents = Category::root()->orderBy('name')->get();
        
        // dd($parents);
        $categories = Category::with(['children' => function ($query) {
            $query->select('id', 'parent_id', 'name', 'type', 'icon');
        }])->whereNull('parent_id')
           ->where('user_id', $request->user()->id)
           ->select('id', 'name', 'type', 'icon')
           ->get();
        // dd($categories);
        return view('categories.index', compact('categories'));
    }
    
    public function create()
    {
        $parents = Category::root()->where('user_id', Auth::user()->id)->orderBy('name')->get();
        return view('categories.create', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Category::create($data);
        return redirect()->route('categories.index')->with('success', '分类已创建');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('user_id', Auth::user()->id)
            ->where('id', '!=', $category->id)
            ->orderBy('name')->get();
        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        if($data['parent_id'] == $category->id) {
            return back()->withErrors(['parent_id' => '分类不能是自己的父分类']);
        }

        // 如果修改了父分类，检查父分类是否属于当前用户
        if (isset($data['parent_id']) && $data['parent_id']) {
            $parentCategory = Category::find($data['parent_id']);
            if ($parentCategory && $parentCategory->user_id !== Auth::user()->id) {
                return back()->withErrors(['parent_id' => '父分类不存在或无权访问']);
            }
        }

        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', '分类已更新');
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::user()->id) {
            abort(403, '无权访问此分类');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', '分类已删除');
    }
}
