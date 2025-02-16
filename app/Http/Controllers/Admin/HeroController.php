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
            'hero' => Hero::select('id', 'name', 'title', 'description', 'social_links', 'code_snippet', 'my_image', 'my_description')->first()
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $hero = Hero::first();

            if ($request->hasFile('my_image')) {
                @unlink($hero->my_image);
                $myImgUrl = uploadFile($request->file('my_image'), 350, 390, 'uploads/hero/');
            }
            if ($request->hasFile('cv_link')) {
                $requestPDf = $request->cv_link;
                $fileName = 'cv' . '_' . time() . '.' . $requestPDf->extension();
                $path = 'uploads/hero';
                if (file_exists(public_path($hero->cv_link))) {
                    @unlink(public_path($hero->cv_link));
                }
                $requestPDf->move(public_path($path), $fileName);
                $savePdfUrl = $path .'/'. $fileName;
            }
            Hero::updateOrCreate(
                ['id' => 1],
                [
                    'name' => $request->name,
                    'title' => $request->title,
                    'description' => $request->description,
                    'social_links' => $request->social_links,
                    'cv_link' => $savePdfUrl ?? $hero->cv_link,
                    'code_snippet' => $request->code_snippet,
                    'my_description' => $request->my_description,
                    'my_image' => $myImgUrl ?? $hero->my_image
                ]
            );


            return redirect()->back();
        } catch (\Exception $e) {
            throw $e;
        }
    }



}
