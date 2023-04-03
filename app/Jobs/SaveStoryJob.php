<?php

namespace App\Jobs;


use App\Services\StoryServices;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SaveUserJob;
use App\Jobs\SaveCommentJob;
class SaveStoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $story;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($story)
    {
        $this->story = $story;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $storyService=new StoryServices();
        $storyModel = $storyService->storeStory($this->story);

        SaveUserJob::dispatch($this->story['by']);
        // Dispatch a SaveCommentJob for each comment associated with the story
        if (isset($this->story['kids'])) {
            foreach ($this->story['kids'] as $kidId) {
                SaveCommentJob::dispatch($kidId, $storyModel->id);
            }
        }

    }

}
