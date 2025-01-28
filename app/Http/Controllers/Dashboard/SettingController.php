<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\shippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    // Define constants for shipping method keys to improve maintainability
    const SHIPPING_METHODS = [
        'free' => 'free_shipping_label',
        'inner' => 'local_label',
        'outer' => 'outer_label'
    ];

    public function editShippingMethods($type)
    {
        // Use the constant mapping, with a default fallback
        $key = self::SHIPPING_METHODS[$type] ? self::SHIPPING_METHODS[$type] : self::SHIPPING_METHODS['free'];

        $shippingMethod = Setting::where('key', $key)->firstOrFail();

        return view('admin.settings.shipping.edit', compact('shippingMethod'));
    }

    public function updateShippingMethods(shippingsRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $shipping_method = Setting::findOrFail($id);

            $shipping_method->plain_value = $request->plain_value;
            $shipping_method->value = $request->value;
            $shipping_method->save();

            DB::commit();

            return redirect()->back()->with('success', __('general.update_success'));
        } catch (\Exception $ex) {
            DB::rollback();

            // Log the actual error for debugging
            Log::error('Shipping method update failed: ' . $ex->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }
}
