<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {

        // return Setting::all();
        return Inertia::render('Admin/System/Settings', [
            'settings' => Setting::get(['key', 'value'])
        ]);
    }
    public function update(Request $request)
    {
        // Loop through the request data and update the settings in the database
        foreach ($request->all() as $key => $value) {

            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value],

            );
        }

        return redirect()->back();
    }

    public function fileUpdate(Request $request)
    {
        $setting = Setting::where('key', $request->key)->first();
        if ($setting) {
            @unlink($setting->value);
        }

        $link = "";
        if ($request->key === 'favicon') {
            $link = uploadSettingsImg($request->value,  'media/logo-icon/');
        } elseif ($request->key === 'logo') {
            $link = uploadSettingsImg($request->value, 'media/logo-icon/');
        } elseif ($request->key === 'logo_white') {
            $link = uploadSettingsImg($request->value,  'media/logo-icon/');
        } else {
            $link = uploadSettingsImg($request->value,  'media/logo-icon/');
        }
        $setting->updateOrInsert(
            ['key' => $request->key],
            ['value' => $link],
        );

        return redirect()->back();
    }
}
