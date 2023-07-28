<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSiteAwareJobCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'test:siteawarejob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue a Job that is site aware.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        dispatch(new \App\Jobs\TestSiteAwareJob());
    }
}
