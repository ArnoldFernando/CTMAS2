<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dbName = 'ctams2';
        $dbUser = env('DB_USERNAME', 'root');
        $dbPass = env('DB_PASSWORD', '');
        $dbHost = env('DB_HOST', '127.0.0.1');
        $backupPath = public_path('backupdatabase/' . $dbName . '_' . now()->format('Y_m_d_H_i_s') . '.sql');

        $command = "\"C:\\xampp\\mysql\\bin\\mysqldump.exe\" --user={$dbUser} --password={$dbPass} --host={$dbHost} {$dbName} > \"{$backupPath}\"";



        $returnVar = null;
        $output = null;
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info('Database backup was successful!');
        } else {
            $this->error('Database backup failed.');
        }
    }
}
