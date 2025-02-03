<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::select('id', 'parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            if ($request->type == CategoryType::mainCategory) {
                $request->request->add(['parent_id' => null]);
            }

            $category = Category::create($request->except('_token'));
            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->back()->with('success', __('general.update_success'));
        } catch (\Exception $ex) {
            DB::rollback();

            Log::error('Category create failed: ' . $ex->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => __('general.notExist')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $category->update($request->all());

            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('admin.categories')->with('success', __('general.update_success'));
        } catch (\Exception $ex) {
            DB::rollback();

            Log::error('Shipping method update failed: ' . $ex->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => __('general.notExist')]);

            $category->delete();

            DB::commit();
            return redirect()->back()->with('success', __('general.update_success'));
        } catch (\Exception $ex) {
            DB::rollback();

            Log::error('Category update failed: ' . $ex->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }
}
