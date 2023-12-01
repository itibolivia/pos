<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

use Auth;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = Auth::user();
        $permissions = Auth::check() ? Auth::user()->permissions->mapWithKeys(function($pr){ return [$pr['name'] => true]; }) : [];
        $roles = Auth::check() ? Auth::user()->roles->mapWithKeys(function($pr){ return [$pr['name'] => true]; }) : [];

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'auth.user' => $user,
                'auth.user.permissions' => $permissions,
                'auth.user.roles' => $roles
            ],
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
        ]);
    }
}
