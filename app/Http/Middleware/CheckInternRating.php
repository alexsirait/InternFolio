<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckInternRating
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // 1. Definisikan rute yang diizinkan tanpa rating
        $allowedRoutes = [
            'filament.intern.pages.create-rating', // Halaman mengisi rating
            'filament.intern.auth.logout',        // Halaman/Aksi Logout
        ];

        // 2. Cek apakah user sudah login dan merupakan intern
        if ($user && $user->is_admin == 0) {

            // 3. Cek apakah user sedang mengakses rute yang diizinkan
            $isAllowedRoute = $request->routeIs($allowedRoutes);

            // 4. Jika user belum memiliki rating
            if (!$user->rating) {

                // Jika user mencoba mengakses rute lain (yang tidak diizinkan)
                if (!$isAllowedRoute) {
                    // Redirect paksa ke halaman pengisian rating
                    return redirect()->route('filament.intern.pages.create-rating');
                }
            }
        }

        return $next($request);
    }
}
