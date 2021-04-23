<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateServiceCommand extends GeneratorCommand
{
    protected $name = 'make:service';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : Services name you want to use.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class.';


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path('Console/Stubs/service.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }
}
