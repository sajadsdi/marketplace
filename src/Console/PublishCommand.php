<?php

namespace Sajadsdi\Marketplace\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marketplace:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Marketplace configure and migration and routes!';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->info('Publishing Marketplace ...');
        $this->publish();
        return null;
    }

    private function publish()
    {
        $this->comment('Publishing configure ...');
        $this->call('vendor:publish', ['--tag' => "marketplace-configure"]);

        $this->comment('Publishing migration ...');
        $this->call('vendor:publish', ['--tag' => "marketplace-migration"]);
        $this->call('queue:table');

        $this->comment('Publishing routes ...');
        $this->call('vendor:publish', ['--tag' => "marketplace-route"]);

        $this->comment('Publishing views ...');
        $this->call('vendor:publish', ['--tag' => "marketplace-view"]);
    }
}
