<?php

namespace Admingenerator\GeneratorBundle\Generator;

use Admingenerator\GeneratorBundle\Builder\Generator as TwigGenerator;
use Admingenerator\GeneratorBundle\Exception\CantGenerateException;

use Admingenerator\GeneratorBundle\Builder\Propel\ListControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\ListTemplateBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\NestedListControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\NestedListTemplateBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\FiltersFormTypeBuilder;

use Admingenerator\GeneratorBundle\Builder\Propel\EditControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\EditTemplateBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\EditFormTypeBuilder;

use Admingenerator\GeneratorBundle\Builder\Propel\NewControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\NewTemplateBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\NewFormTypeBuilder;

use Admingenerator\GeneratorBundle\Builder\Propel\ShowControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\ShowTemplateBuilder;

use Admingenerator\GeneratorBundle\Builder\Propel\ActionsControllerBuilder;
use Admingenerator\GeneratorBundle\Builder\Propel\ActionsTemplateBuilder;

class PropelGenerator extends Generator
{
    /**
     * (non-PHPdoc)
     * @see Generator/Admingenerator\GeneratorBundle\Generator.Generator::build()
     * @see http://juliusbeckmann.de/blog/php-benchmark-isset-or-array_key_exists.html
     *   // Key is NULL
     *   $array['key'] = NULL;
     *   var_dump(isset($array['key'])); // false
     *   var_dump(array_key_exists('key', $array)); // true
     */
    public function build()
    {
        $this->validateYaml();

        $generator = new TwigGenerator($this->cache_dir, $this->getGeneratorYml());

        $generator->setContainer($this->container);
        $generator->setBaseAdminTemplate(
            $generator->getFromYaml(
                'base_admin_template',
                $this->container->getParameter('admingenerator.base_admin_template')
            )
        );
        $generator->setFieldGuesser($this->getFieldGuesser());
        $generator->setMustOverwriteIfExists($this->needToOverwrite($generator));
        $generator->setTemplateDirs(
            array_merge(
                $this->container->getParameter('admingenerator.propel_templates_dirs'),
                array(__DIR__.'/../Resources/templates/Propel')
            )
        );

        $generator->setBaseController('Admingenerator\GeneratorBundle\Controller\Propel\BaseController');
        $generator->setColumnClass($this->container->getParameter('admingenerator.propel_column.class'));
        $generator->setBaseGeneratorName($this->getBaseGeneratorName());

        $embed_types = $generator->getFromYaml('params.embed_types', array());

        foreach ($embed_types as $yaml_path) {
            $this->prebuildEmbedType($yaml_path, $generator);
        }

        $builders = $generator->getFromYaml('builders', array());

        if (array_key_exists('list', $builders)) {
            $generator->addBuilder(new ListControllerBuilder());
            $generator->addBuilder(new ListTemplateBuilder());
            $generator->addBuilder(new FiltersFormTypeBuilder());
        }

        if (array_key_exists('nested_list', $builders)) {
            $generator->addBuilder(new NestedListControllerBuilder());
            $generator->addBuilder(new NestedListTemplateBuilder());
            $generator->addBuilder(new FiltersFormTypeBuilder());
        }

        if (array_key_exists('edit', $builders)) {
            $generator->addBuilder(new EditControllerBuilder());
            $generator->addBuilder(new EditTemplateBuilder());
            $generator->addBuilder(new EditFormTypeBuilder());
        }

        if (array_key_exists('new', $builders)) {
            $generator->addBuilder(new NewControllerBuilder());
            $generator->addBuilder(new NewTemplateBuilder());
            $generator->addBuilder(new NewFormTypeBuilder());
        }

        if (array_key_exists('show', $builders)) {
            $generator->addBuilder(new ShowControllerBuilder());
            $generator->addBuilder(new ShowTemplateBuilder());
        }

        if (array_key_exists('actions', $builders)) {
            $generator->addBuilder(new ActionsControllerBuilder());
            $generator->addBuilder(new ActionsTemplateBuilder());
        }

        $generator->writeOnDisk(
            $this->getCachePath(
                $generator->getFromYaml('params.namespace_prefix'),
                $generator->getFromYaml('params.bundle_name')
            )
        );
    }

    public function prebuildEmbedType($yaml_path, $generator)
    {
        $pattern_string = '/(?<namespace_prefix>(?>.+\:)?.+)\:(?<bundle_name>.+Bundle)\:(?<generator_path>.*?)$/';

        if (preg_match($pattern_string, $yaml_path, $match_string)) {
            $namespace_prefix = $match_string['namespace_prefix'];
            $bundle_name      = $match_string['bundle_name'];
            $generator_path   = $match_string['generator_path'];
        } else {
            $namespace_prefix = $generator->getFromYaml('params.namespace_prefix');
            $bundle_name      = $generator->getFromYaml('params.bundle_name');
            $generator_path   = $yaml_path;
        }

        $kernel = $this->container->get('kernel');
        $yaml_file = $kernel->locateResource('@'.$namespace_prefix.$bundle_name.'/Resources/config/'.$generator_path);

        if (!file_exists($yaml_file)) {
            throw new CantGenerateException(
                "Can't generate embed type for $yaml_file, file not found."
            );
        }

        $embedGenerator = new AdminGenerator($this->cache_dir, $yaml_file);
        $embedGenerator->setContainer($this->container);
        $embedGenerator->setBaseAdminTemplate(
            $embedGenerator->getFromYaml(
                'base_admin_template',
                $this->container->getParameter('admingenerator.base_admin_template')
            )
        );
        $embedGenerator->setFieldGuesser($this->getFieldGuesser());
        $embedGenerator->setMustOverwriteIfExists($this->needToOverwrite($embedGenerator));
        $embedGenerator->setTemplateDirs(
            array_merge(
                $this->container->getParameter('admingenerator.propel_templates_dirs'),
                array(__DIR__.'/../Resources/templates/Propel')
            )
        );
        $embedGenerator->setColumnClass($this->container->getParameter('admingenerator.propel_column.class'));

        $embedGenerator->addBuilder(new EditFormTypeBuilder());
        $embedGenerator->addBuilder(new NewFormTypeBuilder());

        $embedGenerator->writeOnDisk(
            $this->getCachePath(
                $embedGenerator->getFromYaml('params.namespace_prefix'),
                $generator->getFromYaml('params.bundle_name')
            )
        );
    }
}
