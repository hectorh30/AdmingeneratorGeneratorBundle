<?php

namespace Admingenerator\GeneratorBundle\Generator;

use Symfony\Component\Finder\Finder;

use Symfony\Component\DependencyInjection\ContainerAware;
use Admingenerator\GeneratorBundle\Validator\ValidatorInterface;

use Admingenerator\GeneratorBundle\Builder\Generator as AdminGenerator;

abstract class Generator extends ContainerAware implements GeneratorInterface
{
    private $controller;

    private $action;

    protected $root_dir;

    protected $cache_dir;

    protected $generator_yaml;

    protected $fieldGuesser;

    protected $base_generator_name;

    protected $validators = array();

    public function __construct($root_dir, $cache_dir)
    {
        $this->root_dir = $root_dir;
        $this->cache_dir = $cache_dir;
    }

    public function setGeneratorYml($yaml_file)
    {
        $this->generator_yaml = $yaml_file;
    }

    public function getGeneratorYml()
    {
        return $this->generator_yaml;
    }

    public function setBaseGeneratorName($base_generator_name)
    {
        $this->base_generator_name = $base_generator_name;
    }

    protected function getBaseGeneratorName()
    {
        return $this->base_generator_name;
    }

   /**
    * (non-PHPdoc)
    * @see Generator/Admingenerator\GeneratorBundle\Generator.GeneratorInterface::getCachePath()
    */
    public function getCachePath($namespace, $bundle_name)
    {
       return $this->cache_dir.'/Admingenerated/'.str_replace('\\', DIRECTORY_SEPARATOR, $namespace).$bundle_name;
    }

    /**
     * (non-PHPdoc)
     * @see Generator/Admingenerator\GeneratorBundle\Generator.GeneratorInterface::build()
     */
    public function build()
    {
        throw new \LogicException('Not implemented');
    }

    public function setFieldGuesser($fieldGuesser)
    {
        return $this->fieldGuesser = $fieldGuesser;
    }

    public function getFieldGuesser()
    {
        return $this->fieldGuesser;
    }

    /**
     * Check if we have to build file
     */
    public function needToOverwrite(AdminGenerator $generator)
    {
        // If set in the configuration file
        if ($this->container->getParameter('admingenerator.overwrite_if_exists')) {
            return true;
        }

        $namespace = $generator->getFromYaml('params.namespace_prefix');
        $bundle = $generator->getFromYaml('params.bundle_name');
        $cacheDir = $this->getCachePath($namespace, $bundle);

        // If there's no cache directory
        if (!is_dir($cacheDir)) {
            return true;
        }

        // If the *-generator.yml file is newer than the generated files
        $fileInfo = new \SplFileInfo($this->getGeneratorYml());

        $files = Finder::create()
                        ->files()
                        ->date('< '.date('Y-m-d H:i:s',$fileInfo->getMTime()))
                        ->in($cacheDir)
                        ->count()
        ;

        if ($files > 0) {
            return true;
        }

        // If the generated file if is a fake empty class
        $finder = Finder::create();
        foreach ($finder->files()->in($cacheDir) as $file) {
            if (false !== strpos(file_get_contents($file), 'AdmingeneratorEmptyBuilderClass')) {
                return true;
            }
        }

        return false;
    }

    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
    }

    public function validateYaml()
    {
        foreach ($this->validators as $validator) {
            $validator->validate($this);
        }
    }
}
