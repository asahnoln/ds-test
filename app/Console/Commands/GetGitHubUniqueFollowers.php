<?php

namespace App\Console\Commands;

use App\Contracts\FollowerServiceInterface;
use Illuminate\Console\Command;

class GetGitHubUniqueFollowers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gh:followers:unique {fullRepoName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get unique follower of core maintainers of a given repo.';

    /**
     * Execute the console command.
     */
    public function handle(FollowerServiceInterface $service)
    {
        $count = $service->uniqueFollowersCount($this->argument('fullRepoName'));
        $this->line('testUser/testReoi core maintainers unique followers count: ' . $count);
    }
}
