<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Http\Requests\Admin\StoreClientReviewRequest;
use App\Http\Requests\Admin\UpdateClientReviewRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // return ClientReview::all();
        $perPage = Request::input('perPage') ?: 8;
        return Inertia::render('Admin/Review/Index', [

            'reviews' => ClientReview::query()
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientReviewRequest $request)
    {

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $img_url = uploadFile($request->file('image'), 570, 696, 'media/review/');
                $data['image'] = $img_url; // Add the image URL to the data array
            }
            ClientReview::create($data);
            return redirect()->back();
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientReview $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientReview $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientReviewRequest $request, ClientReview $review)
    {


        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $img_url = uploadFile($request->file('image'), 570, 696, 'media/review/');
                $data['image'] = $img_url; // Add the image URL to the data array
                @unlink($review->image);
            }
            $review->update($data);
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientReview $review)
    {
        try {
            @unlink($review->image);
            $review->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }



    public function multipleDelete()
    {
        try {
            foreach (request('ids') as $id) {
                $review = ClientReview::find($id);
                @unlink($review->image);
                $review->delete();
            }
            // ClientReview::whereIn('id', request('ids'))->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}