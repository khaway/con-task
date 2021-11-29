<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;

final class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize project';

    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private Filesystem $filesystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        exec('composer install');

        if ($this->createSqliteDatabase()) {
            $this->info('SQLite DB Initialized');
        }

        return Command::SUCCESS;
    }

    /**
     * @return bool
     */
    public function createSqliteDatabase(): bool
    {
        $sqliteDatabasePath = $this->sqliteDatabasePath();

        if ($this->filesystem->exists($sqliteDatabasePath)) {
            return false;
        }

        return $this->filesystem->put('database/database.sqlite', '');
    }

    /**
     * @return string
     */
    public function sqliteDatabasePath(): string
    {
        return database_path('database.sqlite');
    }
}
