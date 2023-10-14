<?php

namespace XForm\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class XFormInstallationCommand extends Command
{
    protected $signature = 'xform:install';

    protected $description = 'X-Form Blade Components';

    public function handle()
    {
        $this->info("Installing x-Form...");
        
        $livewire = Process::tty()->run('composer require livewire/livewire');
        $this->info($livewire->output());

        $this->info('Successfully installed!');
    }
}
