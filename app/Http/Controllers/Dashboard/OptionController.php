<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class OptionController extends Controller
{
    public function index()
    {
        $options = Option::with([
            'product' => function ($prod) {
                $prod->select('id');
            },
            'attribute' => function ($attr) {
                $attr->select('id');
            }
        ])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

        return view('admin.options.index', compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('admin.options.create', $data);
    }

    public function store(OptionRequest $request)
    {
        try {
            DB::beginTransaction();

            $option = Option::create([
                'product_id' => $request->product_id,
                'attribute_id' => $request->attribute_id,
                'price' => $request->price,
            ]);

            //save translations
            $option->name = $request->name;
            $option->save();
            DB::commit();

            return redirect()->route('admin.options')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('failed to create : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        $option = Option::find($id);
        if (!$option)
            return redirect()->route('admin.options')->with(['error' => __('general.notExist')]);

        $data['option'] = $option;

        return view('admin.options.edit', $data);

    }

    public function update(OptionRequest $request, $id)
    {
        try {
            $option = Option::find($id);
            if (!$option)
                return redirect()->route('admin.options')->with(['error' => __('general.notExist')]);

            DB::beginTransaction();

            $option->attribute_id = $request->attribute_id;
            $option->product_id = $request->product_id;
            $option->price = $request->price;

            //save translations
            $option->name = $request->name;
            $option->save();

            DB::commit();

            return redirect()->route('admin.options')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('failed to update : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function destroy($id)
    {
        $option = Option::find($id);
        if (!$option)
            return redirect()->route('admin.options')->with(['error' => __('general.notExist')]);

        try {

            $option->delete();

            return redirect()->route('admin.options')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {

            Log::error('failed to update : ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }
}
