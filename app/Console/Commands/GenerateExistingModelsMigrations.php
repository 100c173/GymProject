<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateExistingModelsMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:all-models-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migrations for all existing models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);

        foreach ($modelFiles as $modelFile) {
            $model = pathinfo($modelFile, PATHINFO_FILENAME);
            $table = Str::plural(Str::snake($model));  // Convert to snake case and pluralize
            
            // Create migration
            Artisan::call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
            ]);

            $this->info("Migration for {$model} created successfully.");
        }
    }
}
