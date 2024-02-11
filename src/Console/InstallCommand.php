<?php

namespace Sajadsdi\Marketplace\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marketplace:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Marketplace';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->info('Installing Marketplace ...');
        $this->installMigrations();
        $this->installRouter();
        $this->installStorageLink();
        $this->clearOptimize();
        return null;
    }


    private function installMigrations()
    {
        $this->comment('Migrating ...');
        $this->call('migrate');
    }

    private function installRouter()
    {
        $this->call('dynamic-router:install');
    }

    private function installStorageLink()
    {
        $this->comment('Linking storage public path ...');
        $this->call('storage:link');
    }

    private function clearOptimize()
    {
        $this->comment('Clearing laravel Optimize ...');
        $this->call('optimize:clear');
    }
}
