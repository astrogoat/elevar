<?php

namespace Astrogoat\Elevar\Commands;

use Illuminate\Console\Command;

class ElevarCommand extends Command
{
    public $signature = 'elevar';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
