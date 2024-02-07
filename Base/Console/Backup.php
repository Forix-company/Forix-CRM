<?php

namespace Modules\Base\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Base\Entities\Backups;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'backup:laravel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create backup of Laravel.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $backupFiles = Storage::disk('local')->files('Laravel');

        usort($backupFiles, function ($a, $b) {
            return -1 * strcmp($a, $b);
        });

        $latestBackupName = basename($backupFiles[0]);
        Backups::create([
            'name' => 'Copia de seguridad',
            'folder' => 'si',
            'database' => 'si',
            'status' => 1,
            'date_create' => new \DateTime(),
            'location' => $latestBackupName,
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);
        
        exec('php artisan backup:run');

        $this->info('Created backup successfully.');
    }
}
