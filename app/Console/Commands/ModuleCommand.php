<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ModuleCommand extends Command
{
    public $files;

    /**
     * __DIR__ = /var/www/html/app/Console/Commands
     * SOURCE_FILE = /var/www/html/app/Console/Commands/../../../resources/stubs/
     */
    const SOURCE_FILE = __DIR__ . '/../../../resources/stubs/';
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    protected $signature = 'make:module {path}';
    protected $description = 'Create module successfully';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pathArgument = $this->argument('path');

        [$path, $class, $instance] = $this->getNameModule($pathArgument);

        $this->mkDir_Model($path, $class);
        $this->mkDir_Controller($path, $class, $instance);
        $this->mkDir_Request($path, $class);
        $this->mkDir_Interface($path, $class);
        $this->mkDir_Service($path, $class, $instance);
        $this->mkDir_Trait($path, $class);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @return void
     */
    protected function mkDir_Model($pathRoot, $class)
    {
        $path = 'app/Modules/'. $pathRoot .'/Models';
        $full_path = base_path($path) . '/' . $class. '.php';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'model.module.stub');
        $resultMkDir = $this->makeDir($path);

        $content = str_replace(
            [
                '{{ path }}',
                '{{ nameModule }}'
            ],
            [str_replace('/', '\\', $pathRoot), $class],
            $fileStubContent
        );

        $resultFile = $this->putFile($full_path, $content);

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @param $instance
     * @return void
     */
    protected function mkDir_Controller($pathRoot, $class, $instance)
    {
        $path = 'app/Modules/'. $pathRoot .'/Http/Controllers';
        $full_path = base_path($path) . '/' . $class. 'Controller.php';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'controller.module.stub');
        $resultMkDir = $this->makeDir($path);

        $content = str_replace(
            [
                '{{ path }}',
                '{{ nameModule }}',
                '{{ name }}'
            ],
            [str_replace('/', '\\', $pathRoot), $class, $instance],
            $fileStubContent
        );

        $resultFile = $this->putFile($full_path, $content);

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @return void
     */
    protected function mkDir_Request($pathRoot, $class)
    {
        $path = 'app/Modules/'. $pathRoot .'/Http/Requests';
        $full_path = base_path($path) . '/' . $class. 'Request.php';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'request.module.stub');
        $resultMkDir = $this->makeDir($path);

        $content = str_replace(
            [
                '{{ path }}',
                '{{ nameModule }}',
            ],
            [str_replace('/', '\\', $pathRoot), $class],
            $fileStubContent
        );

        $resultFile = $this->putFile($full_path, $content);

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @return void
     */
    protected function mkDir_Interface($pathRoot, $class)
    {
        $path = 'app/Modules/'. $pathRoot .'/Interfaces';
        $full_path = base_path($path) . '/' . $class. 'Interface.php';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'interface.module.stub');
        $resultMkDir = $this->makeDir($path);

        $content = str_replace(
            [
                '{{ path }}',
                '{{ nameModule }}',
            ],
            [str_replace('/', '\\', $pathRoot), $class],
            $fileStubContent
        );

        $resultFile = $this->putFile($full_path, $content);

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @param $instance
     * @return void
     */
    protected function mkDir_Service($pathRoot, $class, $instance)
    {
        $path = 'app/Modules/'. $pathRoot .'/Services';
        $full_path = base_path($path) . '/' . $class. 'Service.php';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'service.module.stub');
        $resultMkDir = $this->makeDir($path);

        $content = str_replace(
            [
                '{{ path }}',
                '{{ nameModule }}',
                '{{ name }}',
            ],
            [str_replace('/', '\\', $pathRoot), $class, $instance],
            $fileStubContent
        );

        $resultFile = $this->putFile($full_path, $content);

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $pathRoot
     * @param $class
     * @return void
     */
    protected function mkDir_Trait($pathRoot, $class)
    {
        $path = 'app/Modules/'. $pathRoot .'/Models/Traits';
        $fileStubContent = file_get_contents(self::SOURCE_FILE.'trait.module.stub');
        $resultMkDir = $this->makeDir($path);

        $arrName = [
            $class.'Attribute',
            $class.'Scope',
            $class.'Relationship',
            $class.'Method',
        ];

        for ($i = 0; $i < 4; $i ++) {
            $full_path = base_path($path) . '/' . $arrName[$i].'.php';
            $content = str_replace(
                [
                    '{{ path }}',
                    '{{ nameModule }}',
                ],
                [str_replace('/', '\\', $pathRoot), $arrName[$i]],
                $fileStubContent
            );

            $resultFile = $this->putFile($full_path, $content);
        }

        $this->getMsg($resultMkDir, $resultFile, $path, $full_path);
    }

    /**
     * @param $resultMkDir
     * @param $resultFile
     * @param $path
     * @param $full_path
     *
     * @return void
     */
    private function getMsg($resultMkDir, $resultFile, $path, $full_path)
    {
        $resultMkDir ? $this->info("Directory {$path} has been initialized")
            : $this->error("Directory {$path} already exist");

        $resultFile ? $this->info("File {$full_path} has been initialized")
            : $this->error("File {$full_path} already exist");
    }

    /**
     * @param $path
     * @return bool
     */
    private function makeDir($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);

            return true;
        }
        return false;
    }

    /**
     * @param $fullPath
     * @param $content
     *
     * @return bool
     */
    private function putFile($fullPath, $content)
    {
        if(!$this->files->exists($fullPath)) {
            $this->files->put($fullPath, $content);

            return true;
        }

        return false;
    }

    /**
     * @param $path
     *
     * @return array
     */
    private function getNameModule($path)
    {
        $pathElementArray = explode('/', $path);
        $lastElementInArray = $pathElementArray[count($pathElementArray) - 1];

        return [$path, ucfirst($lastElementInArray), strtolower($lastElementInArray)];
    }
}
