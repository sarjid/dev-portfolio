<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ClientReview;
use App\Models\Hero;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // return Setting::all();
        return Inertia::render('Index', [
            'hero' => Hero::first(),
            'teams' => team::all(),
            'reviews' => ClientReview::all(),
        ]);
    }


    public function service()
    {
        return Inertia::render('Services');
    }


    public function portfolio()
    {
        return Inertia::render('Portfolio');
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }


    public function contactStore(StoreContactRequest $request)
    {
        dd($request->validated());
    }

    public function pricing(Service $service)
    {
        return Inertia::render('Pricing', [
            'service' => $service->load('pricings')
        ]);
    }

    public function team()
    {

        return Inertia::render('Team', [
            'teams' => Team::all()
        ]);
    }



    public function billing(Pricing $pricing)
    {
        return Inertia::render('Billing', [
            'pricing' => $pricing
        ]);
    }


    public function downloadCv()
    {

        $hero = Hero::first();
        if (!$hero || !file_exists(public_path($hero->cv_link))) {
            return back()->with('error', 'File not found.');
        }

        return response()->download(public_path($hero->cv_link));
    }
}
