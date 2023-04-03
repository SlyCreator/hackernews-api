<?php

namespace App\Http\Controllers;

use App\Services\HackernewsService;
use App\Services\StoryServices;
use Illuminate\Http\Request;

class HackernewsController extends Controller
{
    public $storyService;

    public function __construct(StoryServices $storyService)
    {
        $this->storyService = $storyService;
    }

    public function indexStories()
    {
        $data = $this->storyService->fetchStories();
        return response()->json($data);
    }
    public function fetchById($id)
    {
        $data = $this->storyService->fetchStoryById($id);
        return response()->json($data);
    }

}
