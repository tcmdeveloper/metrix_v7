<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YouTubeService
{
    public function getPlaylistVideos(string $playlistId)
    {
        $apiKey = config('services.youtube.key');

        $response = Http::get(
            'https://www.googleapis.com/youtube/v3/playlistItems',
            [
                'part' => 'snippet,contentDetails',
                'playlistId' => $playlistId,
                'maxResults' => 50,
                'key' => $apiKey,
            ]
        );

        return $response->json();
    }



    public static function extractVideoId(string $url): ?string
    {
        $parsed = parse_url($url);

        // youtu.be/VIDEO_ID
        if (($parsed['host'] ?? '') === 'youtu.be') {
            return ltrim($parsed['path'], '/');
        }

        // youtube.com/watch?v=VIDEO_ID
        if (str_contains($parsed['host'] ?? '', 'youtube.com')) {

            parse_str($parsed['query'] ?? '', $query);

            return $query['v'] ?? null;
        }

        return null;
    }



}