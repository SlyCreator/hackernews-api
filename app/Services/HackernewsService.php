<?php

namespace App\Services;

use App\Jobs\FetchCommentsJob;
use App\Jobs\SaveStoryJob;
use App\Models\Comment;
use App\Models\Story;
use App\Repositories\StoryRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HackernewsService
{
    public string $base_url ;
    public $hackerNewsRepository;
    public function __construct(StoryRepository $hackerNewsRepository)
    {
        $this->base_url ='https://hacker-news.firebaseio.com/v0';
        $this->hackerNewsRepository=$hackerNewsRepository;
    }

    /**
     * @throws Exception
     */
    public function fetchStories($limit)
    {
        $response = Http::get("$this->base_url/topstories.json");

        if (!$response->ok()) {
            throw new Exception("Error fetching top stories: " . $response->status());
        }

        $ids = collect($response->json())->slice(0, $limit);
        $stories = $ids->map(function ($id) {
            $response = Http::get("$this->base_url/item/{$id}.json");

            if (!$response->ok()) {
                // Log the error and return null to exclude the story from the results
                Log::error("Error fetching story $id: " . $response->status());
                return null;
            }
            $story = $response->json();
            if ($story['type'] === 'story') {
                SaveStoryJob::dispatch($story);
                return $story;
            }
            return null;
        })->filter();

        return $stories->all();
    }

}

