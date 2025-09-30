<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CreateDailyDataTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:create-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create daily data table and backup posts into it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->format('Y_m_d');
        $tableName = "daily_data_$today";

        DB::statement("
            CREATE TABLE IF NOT EXISTS $tableName (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                post_id BIGINT,
                platform VARCHAR(50),
                caption TEXT,
                status VARCHAR(50),
                scheduled_at TIMESTAMP NULL,
                posted_at TIMESTAMP NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");

    $posts = DB::table('posts')->get();

        foreach ($posts as $post) {
            DB::table($tableName)->insert([
                'post_id'      => $post->id,
                'platform'     => $post->platform,
                'caption'      => $post->caption,
                'status'       => $post->status,
                'scheduled_at' => $post->scheduled_at,
                'posted_at'    => $post->posted_at,
                'created_at'   => $post->created_at,
                'updated_at'   => $post->updated_at,
            ]);
        }

        $this->info("Table $tableName created and filled with " . count($posts) . " records!");
    }
}
