<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $fileName = uploadImage('brands', $request->photo);

            $brand = Brand::create([
                'photo' => $fileName,
                'is_active' => $request->is_active
            ]);

            $brand->name = $request->name;
            $brand->save();

            DB::commit();

            return redirect()->back()->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('Brand create failed: ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => __('general.notExist')]);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('general.notExist')]);

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $brand->is_active = $request->is_active;

            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
                $brand->photo = $fileName;
            }

            $brand->name = $request->name;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.brands')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('Brand update failed: ' . $exception->getMessage());

            return redirect()->route('admin.brands')->with('error', __('general.update_error'));
        }
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('general.notExist')]);

            $brand->detelte();

            return redirect()->route('admin.brands')->with('success', __('general.update_success'));

        }catch (\Exception $exception){
            Log::error('Brand delete failed: ' . $exception->getMessage());

            return redirect()->route('admin.brands')->with('error', __('general.update_error'));
        }
    }
}
