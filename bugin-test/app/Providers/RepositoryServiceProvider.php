<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(IRecruitingRepository::class, RecruitingRepository::class);
        $this->app->bind(HrRepositoryInterface::class, HrRepository::class);
        $this->app->bind(IRecruitingCandidateRepository::class, RecruitingCandidateRepository::class);
    }

}
