<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        if ($user) {
            $user = $user->only(['name', 'email']);
            $parts = preg_split('/\s+/', trim($user['name']));
            $user['firstName'] = $parts[0] ?? null;
            $user['lastName'] = count($parts) > 1 ? $parts[count($parts) - 1] : null;

            $user['initials'] = implode('', array_map(
                fn ($part) => strtoupper(substr($part, 0, 1)),
                $parts
            ));
        }

        return [
            ...parent::share($request),
            'auth.loggedIn' => (bool) $user,
            'auth.user' => $user,
        ];
    }
}
