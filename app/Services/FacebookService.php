<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FacebookService
{
    /**
     * Dummy post to page.
     *
     * @param  string  $caption
     * @param  string|null  $mediaUrl
     * @param  string|null  $pageId
     * @return array
     */
    public function postToPage(string $caption, ?string $mediaUrl = null): array
    {
        return [
            'status'   => 'success',
            'post_id'  => 'fb_' . uniqid(),
            'caption'  => $caption,
            'media'    => $mediaUrl,
            'message'  => 'Posted successfully (dummy)',
            'time'     => now()->toDateTimeString(),
        ];
    }
}
