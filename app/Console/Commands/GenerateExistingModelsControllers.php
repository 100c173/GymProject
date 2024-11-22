<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateExistingModelsControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:all-models-controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate controllers for all existing models';

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
            
            // Create controller
            Artisan::call('make:controller', [
                'name' => "{$model}Controller",
                '--resource' => true,
            ]);

            $this->info("Controller for {$model} created successfully.");
        }
    }
}
