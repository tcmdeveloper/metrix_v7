<?php

namespace App\Http\Controllers;

use Google\Client;
use Illuminate\Support\Facades\Auth;


use Google\Service\YouTube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class YouTubeController extends Controller
{

    public function redirectToGoogle()
    {
        $client = new Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.readonly',
        ]);

        $client->setAccessType('offline'); // CRITICAL for refresh token
        $client->setPrompt('consent');     // ensures refresh token is returned

        return redirect($client->createAuthUrl());
    }



    public function handleGoogleCallback(Request $request)
    {
        $client = new Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        if (isset($token['error'])) {
            abort(401, 'Google auth failed');
        }

        Auth::user()->update([
            'google_access_token' => $token['access_token'],
            'google_refresh_token' => $token['refresh_token'] ?? null,
            'google_token_expires_at' => now()->addSeconds($token['expires_in']),
        ]);

        return redirect('/dashboard');
    }












    // private function client()
    // {
    //     $client = new Client();

    //     $client->setClientId(env('GOOGLE_CLIENT_ID'));
    //     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    //     $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

    //     $client->setAccessType('offline');

    //     $client->addScope(YouTube::YOUTUBE_READONLY);

    //     return $client;
    // }

    // public function connect()
    // {
    //     $client = $this->client();

    //     return redirect($client->createAuthUrl());
    // }

    // public function callback(Request $request)
    // {
    //     $client = $this->client();

    //     $token = $client->fetchAccessTokenWithAuthCode(
    //         $request->code
    //     );

    //     session(['youtube_token' => $token]);

    //     return redirect('/youtube/channel');
    // }

    // public function channel()
    // {
    //     $client = $this->client();

    //     $client->setAccessToken(
    //         session('youtube_token')
    //     );

    //     $youtube = new YouTube($client);

    //     $response = $youtube->channels->listChannels(
    //         'snippet,statistics',
    //         [
    //             'mine' => true
    //         ]
    //     );

    //     return response()->json($response);
    // }


    // public function showLiveChatList()
    // {

    //     // return Socialite::driver('google')
    //     //     ->scopes([
    //     //         'https://www.googleapis.com/auth/youtube.readonly'
    //     //     ])
    //     //     ->redirect();


    //     $googleUser = Socialite::driver('google')->stateless()->user();

    //     $accessToken = $googleUser->token;
    //     $refreshToken = $googleUser->refreshToken;

    //     session([
    //         'youtube_access_token' => $accessToken,
    //         'youtube_refresh_token' => $refreshToken,
    //     ]);

    // return redirect('/dashboard');


    //     // $response = Http::withToken($accessToken)->get(
    //     //     'https://www.googleapis.com/youtube/v3/liveBroadcasts',
    //     //     [
    //     //         'part' => 'snippet',
    //     //         'broadcastStatus' => 'active',
    //     //         'mine' => true,
    //     //     ]
    //     // );

    // }




    public function showData()
    {

        $googleUser = Socialite::driver('google')->user();
        
        $response = Http::withToken($googleUser->token)
            ->get('https://www.googleapis.com/youtube/v3/channels', [
                'part' => 'snippet',
                'mine' => 'true',
            ]);

        return $response->json();


        $isConnected = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => 'laravel',
            'maxResults' => 1,
            'key' => env('YOUTUBE_API_KEY'),
        ])->successful();


        return view('youtube.data.show', [
            'pageHeadings' => [
                'YouTube API',
                'Show data.'
            ], 
            'isConnected' => $isConnected
        ]);
    }
    



    

}