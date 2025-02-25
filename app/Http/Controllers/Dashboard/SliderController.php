<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImagesRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    public function addImages()
    {
        $images = Slider::get(['photo']);
        return view('admin.sliders.images.create', compact('images'));
    }

    //to save images to folder only
    public function saveSliderImages(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveSliderImagesDB(SliderImagesRequest $request)
    {
        if ($request->has('document') && count($request->document) > 0) {
            DB::transaction(function () use ($request) {
                foreach ($request->document as $image) {
                    try {
                        Slider::create([
                            'photo' => $image,
                        ]);

                    } catch (\Exception $e) {
                        Log::error('failed to update image data of slider: ' . $e->getMessage());
                        return redirect()->back()->with('error', __('general.update_error'));
                    }
                }
            });
        }

        return redirect()->back()->with('success', __('general.update_success'));
    }
}
