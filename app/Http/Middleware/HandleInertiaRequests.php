<?php

namespace App\Http\Middleware;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'settings' => Setting::select(['key', 'value'])->get()->toArray(),
            'services' => Service::orderBy('name', 'ASC')->get(['name', 'slug', 'description']),


        ];
    }



    /**
     * Get the root view.
     *
     * @param Request $request
     * @return string
     */
    public function rootView(Request $request): string
    {
        if ($request->is('admin/*')) {
            return 'admin'; // Use admin.blade.php for admin routes
        }
        return 'app'; // Use app.blade.php for other routes
    }
}