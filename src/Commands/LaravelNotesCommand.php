<?php

namespace AlphaOlomi\Notes\Commands;

use Illuminate\Console\Command;

class AddNoteCommand extends Command
{
    public $signature = 'notes:add';

    public $description = 'Create a Note';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
