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
        if (!config('github.connections.main.token')) {
            $this->fail('GitHub token is not set! Set GH_TOKEN in .env to your personal access token');
        }

        $repoName = $this->argument('fullRepoName');

        try {
            $count = $service->uniqueFollowersCount($repoName);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }

        $this->line("{$repoName} core maintainers unique followers count: {$count}");
    }
}
