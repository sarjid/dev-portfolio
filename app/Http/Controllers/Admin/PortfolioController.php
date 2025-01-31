<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Requests\Admin\StorePortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 8;
        return Inertia::render('Admin/Portfolio/Index', [
            'portfolios' => Portfolio::query()
                ->with(['service:id,name'])
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
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
        return Inertia::render('Admin/Portfolio/Create', [
            'services' => Service::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        foreach ($request->images as $img) {
            $imgLink = uploadFile($img, 1440, 1440, 'media/portfolio/');
            Portfolio::create([
                'service_id' => $request->service_id,
                'image' => $imgLink,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            @unlink($portfolio->image);
            $portfolio->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }


    public function multipleDelete()
    {
        try {
            foreach (request('ids') as $id) {
                $portfolio = Portfolio::find($id);
                @unlink($portfolio->image);
                $portfolio->delete();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}