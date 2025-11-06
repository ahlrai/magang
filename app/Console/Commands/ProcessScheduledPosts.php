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
    public function handle(FacebookService $facebookService)
    {
        $now = now();

        // ambil semua post terjadwal yang waktunya sudah lewat
        $posts = Post::where('status', 'scheduled')
            ->where('scheduled_at', '<=', $now)
            ->get();

        if ($posts->isEmpty()) {
            $this->info("No scheduled posts to process at {$now}.");
            return 0;
        }

        foreach ($posts as $post) {
            try {
                // kirim ke service dummy
                $response = $facebookService->postToPage($post->caption, $post->media_url);

                if (isset($response['status']) && $response['status'] === 'success') {
                    $post->update([
                        'status'    => 'posted',
                        'posted_at' => $now,
                        'response'  => $response,
                    ]);
                    $this->info("Post {$post->id} marked as posted at {$now}");
                } else {
                    // kalau gagal, tetap simpan response
                    $post->update([
                        'response' => $response,
                    ]);
                    $this->warn("Post {$post->id} failed to post (dummy).");
                }
            } catch (Throwable $e) {
                Log::error("Error processing post {$post->id}: " . $e->getMessage());

                $post->update([
                    'response' => [
                        'status'  => 'error',
                        'message' => $e->getMessage(),
                    ],
                ]);
            }
        }

            return 0;
        }
    }
