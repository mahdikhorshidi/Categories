<?php

declare(strict_types=1);

namespace mahdikhorshidi\categories\Console\Commands;

use Illuminate\Console\Command;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mahdikhorshidi:migrate:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate MahdiKhorshidi Categories Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->warn('Migrate mahdikhorshidi/categories:');
        $this->call('migrate', ['--step' => true, '--path' => 'vendor/mahdikhorshidi/categories/database/migrations']);
    }
}
