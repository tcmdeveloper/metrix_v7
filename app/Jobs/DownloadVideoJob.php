<?php

namespace App\Jobs;

use App\Models\Download;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Illuminate\Queue\SerializesModels;

class DownloadVideoJob implements ShouldQueue
{
    use Queueable;

    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Download $download)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $videoId = $this->download->videoId;
        $fileName = $this->download->fileName ?: '%(title)s';
        
        $download = 'https://www.youtube.com/watch?v=' . $videoId;

        $ytDlp = '/opt/homebrew/bin/yt-dlp';

        $inputPath = $download;
        $outputPath = '/Users/frankjones/Movies/YouTube Downloads/' . $fileName . '.%(ext)s';


        $command = [
            $ytDlp,
            $inputPath,
            '--format', 'bestvideo+bestaudio',
            '--merge-output-format', 'mp4',
            '--recode-video', 'mp4',
            '-o', $outputPath,
        ];

        $this->download->update([
            'fileName' => $fileName
        ]);
        
        

        $process = new Process($command);

        Log::info('JOB STARTED');
        Log::info($process->getCommandLine());

        $process->setTimeout(null);

        try {

            $this->download->update([
                'status' => 'processing'
            ]);

            $process->mustRun();

            $this->download->update([
                'status' => 'completed'
            ]);

            Log::info($process->getOutput());
            

        } catch (\Exception $e) {

            $this->download->update([
                'status' => 'failed',
                'error' => $e->getMessage(),
            ]);

            Log::error($e->getMessage());
        }

    }




}
