<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends AdminController
{
    public function index()
    {
        $settings = Setting::find(1);

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $shipment = filter_var($request->shipment, FILTER_SANITIZE_NUMBER_INT);

        $settings = Setting::find(1);
        $settings->shipment = $shipment;
        $settings->rise = $request->rise;
        $settings->save();

        return redirect()->route('settings')
            ->with('success', 'Ajustes actualizados correctamente.');
    }
}
