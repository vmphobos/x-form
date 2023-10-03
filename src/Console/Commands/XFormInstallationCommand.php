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
        $this->info("\n\n🔨 Installing x-form...\n\n");

        $directories = Process::tty()->run('mkdir -p app/Livewire && mkdir -p resources/views/components/layouts');
        $this->info($directories->output());

        $livewire = Process::tty()->run('composer require livewire/livewire');
        $this->info($livewire->output());

        $this->info('🌟 Enjoy!');
    }
}