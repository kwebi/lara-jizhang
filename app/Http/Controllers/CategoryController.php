<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with(['user', 'transactions'])
            ->where('user_id', $request->user()->id)->paginate(15)->withQueryString();
        // dump("transactions.index");
        return view('categories.index', compact('categories'));
    }
}
