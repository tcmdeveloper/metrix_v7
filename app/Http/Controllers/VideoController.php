<?php

namespace App\Http\Controllers;

use App\Jobs\DownloadVideoJob;
use App\Models\Download;
use App\Services\YouTubeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

class VideoController extends Controller
{


    // INDEX VIEW

    public function index(YouTubeService $youtube)
    {
        $videos = $youtube->getPlaylistVideos('PLAYLIST_ID');

        return response()->json($videos);
    }




    // SHOW DOWNLOAD FORM

    public function showDownloadForm(){
        

        return view('videos.download', [
            'pageHeadings' => [
                'Download page',
                'Something about the download page.'
            ]
        ]);

    }




    // SUBIT FORM DATA

    public function submitFormData(Request $request)
    {
        

    // dd(shell_exec('which yt-dlp'));


        $request->validate([
            'url' => ['required', 'url'],
            'fileName' => ['nullable', 'string', 'max:500']
        ]);

       
        $videoId = YoutubeService::extractVideoId($request->url);


        $download = Download::create([
            'source' => 'youtube',
            'videoId' => $videoId,
            'fileName' => $request->fileName,
            'status' => 'pending',
        ]);

        DownloadVideoJob::dispatch($download);

        return response()->json([
            'download_id' => $download->id
        ]);
        

        

        



    }




}