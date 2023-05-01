<?php

namespace Mrchetan\LaravelMakeExtender\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeHelperCommand extends GeneratorCommand
{
    protected $name = 'make:helper {--C|class=false}';

    protected $description = 'Create a new helper';

    protected $type = 'Helper';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath($this->option('class') ? 'helper-class.stub' :'helper.stub');
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
        return $rootNamespace . '\Helpers';
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
