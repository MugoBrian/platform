<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Ushahidi\Contracts\Repository\Entity\ExportBatchRepository;
use Ushahidi\Core\Concerns\SiteAware;
use Ushahidi\Core\Support\SiteManager;

class TestSiteAwareJob extends Job
{
    use SiteAware;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SiteManager $site)
    {
        // Get deployment ID
        Log::debug('Site Id', [$site->instance()->getId()]);

        // Get config
        Log::debug(
            'Site Config',
            [$site->instance()->getConfig()]
        );

        // Get an ohanzee DB connection
        // Get an illuminate DB connection
        Log::debug(
            'Export batch',
            [app(ExportBatchRepository::class)->getByJobId(10)]
        );
    }
}
