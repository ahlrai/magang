<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Services\FacebookService;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        $posts = Post::where('status', 'scheduled')
            ->where('scheduled_at', '<=', now()->addMinute())
            ->get();

        foreach ($posts as $post) {
            $post->update(['status' => 'posted']);
            $this->info("Post {$post->id} marked as posted at {$now}");
        }
    }
}
