<?php

namespace App\Services;

use App\Repositories\StoryRepository;

class StoryServices
{
    public StoryRepository $storyRepository;
    public function __construct(StoryRepository $storyRepository)
    {
        $this->storyRepository= $storyRepository;
    }



    public function fetchStories()
    {
        return $this->storyRepository->fetchStories();
    }

    public function fetchStoryById($id)
    {
        return $this->storyRepository->fetchStoryById($id);
    }
    public function storeStory($storyData)
    {
         return $this->storyRepository->saveStory($storyData);
    }

    public function storeComment($comment, $storyModel)
    {
        return $this->storyRepository->saveComment($comment,$storyModel);
    }
    public function storeUser($userData)
    {
        return $this->storyRepository->saveUser($userData);
    }


}
