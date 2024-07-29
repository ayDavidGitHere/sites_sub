<?php

namespace App\Console\Commands; 

use App\Models\Post;
use App\Models\PostNotification;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPostNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify subscribers of new posts, via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = $this->getAllPosts();

        foreach ($posts as $post) {
            $subscribers = $post->website->subscriptions()->with('user')->get();

            foreach ($subscribers as $subscription) {
                if (!$this->hasNotificationBeenSent($subscription->user_id, $post->id)) {
                    $this->sendEmail($subscription, $post);
                }
            }
        }

        $this->info('Notification: success!');
    }

    public function getAllPosts()
    {
        return Post::all();
    }

    public function sendEmail($subscription, $post)
    {
        Mail::raw("Just Published! <br><br> TITLE: {$post->title} <br><br> DESCRIPTION: {$post->description}", function ($message) use ($subscription, $post) {
            $message->to($subscription->user->email)
                ->subject("New Published Post: {$post->website->name}");
        });

        PostNotification::create([
            'user_id' => $subscription->user_id,
            'post_id' => $post->id,
        ]);
    }

    public function hasNotificationBeenSent($userId, $postId)
    {
        return PostNotification::where('user_id', $userId)
            ->where('post_id', $postId)
            ->exists();
    }


} 