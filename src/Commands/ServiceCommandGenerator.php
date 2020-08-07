<?php
namespace Safventure\laravelSRC\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ServiceCommandGenerator extends GeneratorCommand
{
    protected $name = 'make:service';
    protected $description = 'Create a new service class';
    protected $type = 'Service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/service.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Services';
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
            ->replaceRepository($stub, $name)
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

            return trim($this->argument('name')). 'Service';
        } else {

            return trim($this->argument('name')). 'Service';
        }
    }

    private function replaceModel(&$stub, $name)
    {
        $model = str_replace('Service', '', $this->getNameInput());

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

    private function replaceRepository(&$stub, $name)
    {
        $model = str_replace('Service', '', $this->getNameInput());

        $repository = $model . 'Repository';

        $repository_namespace = $this->getRepositoryNameSpace() . $repository;

        $stub = str_replace('DummyRepositoryNamespace', $repository_namespace, $stub);

        $stub = str_replace('DummyRepositoryParameter', Str::camel($repository), $stub);

        $stub = str_replace('DummyRepository',  $repository, $stub);

        return $this;
    }

    private function getRepositoryNameSpace()
    {
        return config('laravelSRC.repository.namespace', 'App\\Repositories\\');
    }
}
