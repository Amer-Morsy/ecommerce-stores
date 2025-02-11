<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productsBySlug($slug)
    {
        $data = [];
        $data['categories'] = Category::parent()->select('id', 'slug')->with(['childrens' => function ($q) {
            $q->select('id', 'parent_id', 'slug');
            $q->with(['childrens' => function ($qq) {
                $qq->select('id', 'parent_id', 'slug');
            }]);
        }])->get();

        $data['category'] = Category::where('slug', $slug)->first();
        if ($data['category'])
            $data['products'] = $data['category']->products()->with('images')->paginate(PAGINATION_COUNT);

        return view('front.products', $data);

    }
}
