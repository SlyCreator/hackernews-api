<?php

namespace App\Jobs;


use App\Repositories\StoryRepository;
use App\Services\StoryServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SaveCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $kidId;
    private  $storyId;
    public string $base_url ;

    public StoryServices $storyServices;

    public function __construct($kidId, $storyId)
    {
        $this->kidId = $kidId;
        $this->base_url ='https://hacker-news.firebaseio.com/v0';
        $this->storyId = $storyId;
    }

    public function handle(StoryRepository $storyRepository)
    {
        $response = Http::get("$this->base_url/item/{$this->kidId}.json");
        $comment = $response->json();

        if ($comment['type'] === 'comment' && !isset($comment['dead'])) {

                $storyRepository->saveComment($comment,$this->storyId);

                SaveUserJob::dispatch($comment->by);


            if (isset($comment['kids'])) {
                foreach ($comment['kids'] as $grandKid) {
                    SaveCommentJob::dispatch($grandKid,$this->storyId);
                }
            }
        }

    }

}

