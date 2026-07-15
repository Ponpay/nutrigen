<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Ibu;

class PortalIbuAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        if ($token) {
            $ibu = Ibu::where('token_whatsapp', $token)->first();
            if ($ibu) {
                // Store authenticated ibu_id in session
                $request->session()->put('portal_ibu_id', $ibu->id);
                
                // Optional: remove token from URL for cleaner address bar
                return redirect($request->url());
            }
        }

        // Bypass for local development if no session and no token
        if (app()->environment('local') && !$request->session()->has('portal_ibu_id')) {
            $ibu = Ibu::first();
            if ($ibu) {
                $request->session()->put('portal_ibu_id', $ibu->id);
            }
        }

        // If no token in URL and no session, check session
        if (!$request->session()->has('portal_ibu_id')) {
            abort(403, 'Akses ditolak. Silakan buka aplikasi melalui tautan dari WhatsApp Bot NutriGen.');
        }

        // Validate the ibu still exists in database
        $ibuId = $request->session()->get('portal_ibu_id');
        $ibu = Ibu::find($ibuId);
        
        if (!$ibu) {
            $request->session()->forget('portal_ibu_id');
            abort(403, 'Data Ibu tidak ditemukan.');
        }

        // Make the Ibu instance available to the request
        $request->merge(['authenticated_ibu' => $ibu]);

        return $next($request);
    }
}
