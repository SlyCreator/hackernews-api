<?php

namespace App\Jobs;

use App\Services\StoryServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SaveUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;

    public string $base_url ;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->base_url ='https://hacker-news.firebaseio.com/v0';
    }

    public function handle()
    {

        $response = Http::get("$this->base_url/user/{$this->userId}.json");

        $user = $response->json();
        $storyService=new StoryServices();
        $storyService->storeUser($user);

    }
}
