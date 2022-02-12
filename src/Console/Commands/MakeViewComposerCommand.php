<?php

namespace Mrchetan\LaravelMakeExtender\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeViewComposerCommand extends GeneratorCommand
{
    protected $name = 'make:composer';

    protected $description = 'Create a new view composer';

    protected $type = 'Composer';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('viewcomposer.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath("stubs/vendor/laravel-make-extender/".$stub))
            ? $customPath
            : __DIR__. "/../../../stubs/".$stub;
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\ViewComposers';
    }

    /**
     * @return bool
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $handle = parent::handle();

        if ($handle === false) {
            return false;
        }

        return true;
    }
}
