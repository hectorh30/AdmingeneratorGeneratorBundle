<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates form for New actions
 * @author cedric Lombardot
 */
class NewFormTypeBuilder extends BaseNewBuilder
{
    public function getOutputName()
    {
        return 'Form/Type/'.$this->getBaseGeneratorName().'/NewType.php';
    }

    public function getTemplateName()
    {
        return 'EditFormTypeBuilder'.self::TWIG_EXTENSION;
    }

    /**
     * Gets the correct class to inherit from
     * 
     * @param  string $namespace
     * @param  string $bundle   
     * @param  string $generator
     * @return string           
     */
    public function getExtendingClassName($namespace, $bundle, $generator)
    {
        if ($this->getGenerator()->getFromYaml('builders.form'))
            return $this->getDefinedOrGeneratedFormTypeClass($namespace, $bundle, $generator, 'FormType');

        return '\\Symfony\\Component\\Form\\AbstractType';
    }
}
