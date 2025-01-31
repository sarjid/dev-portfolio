<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HeroController extends Controller
{


    public function index()
    {
        return Inertia::render('Admin/Hero/Index', [
            'hero' => Hero::select('id', 'title', 'short_descp', 'video_url', 'image_one', 'image_two')->first()
        ]);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $hero = Hero::first();
            if ($request->hasFile('image_one')) {
                @unlink($hero->image_one);
                $imgOneUrl = uploadFile($request->file('image_one'), 350, 390, 'media/hero/');
            }
            if ($request->hasFile('image_two')) {
                @unlink($hero->image_two);
                $imgTwoUrl = uploadFile($request->file('image_two'), 350, 390, 'media/hero/');
            }
            Hero::updateOrCreate(
                ['id' => 1],
                [
                    'title' => $request->title,
                    'short_descp' => $request->short_descp,
                    'video_url' => $request->video_url,
                    'image_one' =>   $request->file('image_one') ? $imgOneUrl : $hero->image_one,
                    'image_two' =>   $request->file('image_two') ? $imgTwoUrl : $hero->image_two,
                ]
            );


            return redirect()->back();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}