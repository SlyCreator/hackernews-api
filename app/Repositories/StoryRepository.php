<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Story;
use App\Models\User;
use Carbon\Carbon;

class StoryRepository
{

    public function saveComment($comment, $storyModelId)
    {
        if (isset($comment['dead']))return false ;
        return Comment::updateOrCreate(
            ['h_id' => $comment['id']],
            [
                'text' => $comment['text'],
                'by' => $comment['by'],
                'h_time' => Carbon::createFromTimestamp($comment['time']),
                'story_id' => $storyModelId
            ]
        );
    }

    public function saveStory($storyData)
    {

        return Story::updateOrCreate(
            ['h_id' => $storyData['id']],
            [
                'title' => $storyData['title'],
                'url' => $storyData['url'],
                'score' => $storyData['score'],
                'by' => $storyData['by'],
                'descendants' => $storyData['descendants'],
                'h_time' => Carbon::createFromTimestamp($storyData['time'])
            ]
        );
    }

    public function saveUser($userData)
    {
        return User::updateOrCreate(
            ['h_id' => $userData['id']],
            [
                'about' => $userData['about'],
                'karma' => $userData['karma'],
                'h_time' => Carbon::createFromTimestamp($userData['time'])
            ]
        );
    }

    public function fetchStories()
    {
       return Story::with('comments')->paginate(10);
    }

    public function fetchStoryById($id)
    {
        return Story::with('comments')->findOrFail($id);
    }
}
