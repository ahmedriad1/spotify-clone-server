<?php

namespace App\Jobs;

use App\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class StreamSong implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }


    public function handle()
    {
        $audio = FFMpeg::fromDisk('public')->open('songs/' . $this->song->song_path);
        $duration = $audio->getDurationInSeconds();
        $audio->export()->onProgress(function ($percent) {
            $this->song->update([
                'upload_percent' => $percent
            ]);
        })->toDisk('public')->inFormat(new \FFMpeg\Format\Audio\Aac)
            ->save('songs/' . $this->song->id . '.aac');
        Storage::disk('public')->delete('songs/' . $this->song->song_path);
        $this->song->update([
            'song_path' => $this->song->id . '.aac',
            'duration' => $duration,
        ]);
    }
}
