<?php

namespace App\Providers;

use App\Repositories\StoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(StoryRepository::class, function ($app) {
            return new StoryRepository();
        });
    }
}
