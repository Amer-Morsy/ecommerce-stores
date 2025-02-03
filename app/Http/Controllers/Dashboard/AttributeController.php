<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(AttributeRequest $request)
    {
        try {
            DB::beginTransaction();

            $attribute = Attribute::create([]);

            //save translations
            $attribute->name = $request->name;
            $attribute->save();
            DB::commit();

            return redirect()->route('admin.attributes')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('failed to create : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => __('general.notExist')]);

        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, $id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => __('general.notExist')]);

        try {
            DB::beginTransaction();

            //save translations
            $attribute->name = $request->name;
            $attribute->save();
            DB::commit();

            return redirect()->route('admin.attributes')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('failed to update : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => __('general.notExist')]);

        try {

            $attribute->delete();

            return redirect()->route('admin.attributes')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {

            Log::error('failed to update : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }
}
