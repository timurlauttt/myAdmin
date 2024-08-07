<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class ShareNotifications
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Ambil file yang sudah di print sebagai notifikasi
            $notifications = File::where('status', 'Sudah di Print')
                                 ->orderBy('updated_at', 'desc')
                                 ->take(5)
                                 ->get();
            view()->share('notifications', $notifications);
        }

        return $next($request);
    }
}
