<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pricing;
use App\Http\Requests\Admin\StorePricingRequest;
use App\Http\Requests\Admin\UpdatePricingRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $perPage = Request::input('perPage') ?: 8;
        return Inertia::render('Admin/Pricing/Index', [
            'services' => Service::orderBy('name', 'ASC')->get(),
            'pricings' => Pricing::query()
                ->with(['service:id,name'])
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('type', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString(),

            'filters' => Request::only(['search', 'perPage'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePricingRequest $request)
    {
        Pricing::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pricing $pricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePricingRequest $request, Pricing $pricing)
    {
        $pricing->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pricing $pricing)
    {
        $pricing->delete();
        return redirect()->back();
    }



    public function multipleDelete()
    {
        Pricing::whereIn('id', request('ids'))->delete();
        return redirect()->back();
    }
}