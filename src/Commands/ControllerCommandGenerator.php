<?php
namespace Safventure\laravelSRC\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ControllerCommandGenerator extends GeneratorCommand
{
    protected $name = 'make:rscontroller';
    protected $description = 'Create a new controller class';
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * @param string $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceModel($stub, $name)
            ->replaceService($stub, $name)
            ->replaceClass($stub, $name);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        if (strpos(trim($this->argument('name')), 'Service') !== false) {

            return trim($this->argument('name'));
        } else {

            return trim($this->argument('name'));
        }
    }

    private function replaceModel(&$stub, $name)
    {
        $model = str_replace('Controller', '', $this->getNameInput());

        $model_namespace = $this->getModelNamespace(). $model;

        $stub = str_replace('DummyModelNamespace', $model_namespace, $stub);

        $stub = str_replace('DummyModelParameter', Str::camel($model), $stub);

        $stub = str_replace('DummyModel',  $model, $stub);

        return $this;
    }

    private function getModelNamespace()
    {
        return config('laravelSRC.model.namespace', 'App\\');
    }

    private function replaceService(&$stub, $name)
    {
        $model = str_replace('Controller', '', $this->getNameInput());

        $service = $model . 'Service';

        $service_namespace = $this->getRepositoryNameSpace() . $service;

        $stub = str_replace('DummyServiceNamespace', $service_namespace, $stub);

        $stub = str_replace('DummyServiceParameter', Str::camel($service), $stub);

        $stub = str_replace('DummyService',  $service, $stub);

        return $this;
    }

    private function getRepositoryNameSpace()
    {
        return config('laravelSRC.repository.namespace', 'App\\Services\\');
    }
}
