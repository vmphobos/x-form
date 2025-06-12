<?php

namespace Vmphobos\XForm\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class XFormAutoInstaller extends Command
{
    protected $signature = 'x-form:install';

    protected $description = 'X-Form Blade Components';

    public function handle()
    {
        $this->info('Publishing X-Form Configuration...');

        Artisan::call('vendor:publish --tag=x-form:config');
        Artisan::call('vendor:publish --tag=Vmphobos\XForm\ServiceProvider');

        $this->info('Successfully installed!');
    }
}
