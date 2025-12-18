<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    /**
     * Redirect to the original URL using the short code.
     */
    public function redirect(string $code)
    {
        $shortLink = ShortLink::where('code', $code)->firstOrFail();
        
        // Increment click counter
        $shortLink->incrementClicks();
        
        // Redirect to original URL
        return redirect($shortLink->original_url);
    }
}
