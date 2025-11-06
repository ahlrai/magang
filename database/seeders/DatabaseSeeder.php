<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SocialMedia;
use App\Models\SocialAccount;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\Post;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user + role
        $admin = \App\Models\User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Admin',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
    ]
);

        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        $admin->assignRole($role);

        // Buat Social Media
        SocialMedia::factory(4)->create();

        // Buat Social Accounts
        SocialAccount::factory(5)->create();

        // Buat Contacts
        Contact::factory(3)->create();

        // Buat Conversations
        Conversation::factory(10)->create();

        // Buat Posts
        Post::factory(13)->create();
    }
}
