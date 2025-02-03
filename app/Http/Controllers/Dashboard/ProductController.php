<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\PriceProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\StockProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'price', 'is_active', 'created_at')->paginate(PAGINATION_COUNT);
        return view('admin.products.general.index', compact('products'));
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();

        return view('admin.products.general.create', $data);
    }

    public function store(GeneralProductRequest $request)
    {
        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $product = Product::create([
                'slug' => $request->slug,
                'brand_id' => $request->brand_id,
                'is_active' => $request->is_active,
            ]);

            //save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories
            $product->categories()->attach($request->categories);

            //save product tags
            $product->tags()->attach($request->tags);

            DB::commit();
            return redirect()->route('admin.products')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('failed to create main data of product: ' . $exception->getMessage());
            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function getPrice($product_id)
    {
        return view('admin.products.prices.create')->with('id', $product_id);
    }

    public function saveProductPrice(PriceProductRequest $request)
    {

        try {
            Product::whereId($request->product_id)->update($request->only([
                'price',
                'special_price',
                'special_price_type',
                'special_price_start',
                'special_price_end']));

            return redirect()->route('admin.products')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {

            Log::error('failed to update price data of product: ' . $exception->getMessage());
            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function getStock($product_id)
    {
        return view('admin.products.stock.create')->with('id', $product_id);
    }

    public function saveProductStock(StockProductRequest $request)
    {
        try {
            Product::whereId($request->product_id)->update($request->except(['_token', 'product_id']));

            return redirect()->route('admin.products')->with('success', __('general.update_success'));

        } catch (\Exception $exception) {

            Log::error('failed to update stock data of product: ' . $exception->getMessage());
            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function addImages($product_id)
    {
        return view('admin.products.images.create')->withId($product_id);
    }

    //to save images to folder only
    public function saveProductImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function saveProductImagesDB(ProductImagesRequest $request)
    {
        if ($request->has('document') && count($request->document) > 0) {
            DB::transaction(function () use ($request) {
                foreach ($request->document as $image) {
                    try {
                        Image::create([
                            'product_id' => $request->product_id,
                            'photo' => $image,
                        ]);

                    } catch (\Exception $e) {
                        Log::error('failed to update image data of product: ' . $e->getMessage());
                        return redirect()->back()->with('error', __('general.update_error'));
                    }
                }
            });
        }

        return redirect()->route('admin.products')->with('success', __('general.update_success'));

    }
}
