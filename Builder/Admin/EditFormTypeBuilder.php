<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates form for edit actions
 * @author cedric Lombardot
 */
class EditFormTypeBuilder extends BaseEditBuilder
{
    public function getOutputName()
    {
        return 'Form/Type/'.$this->getBaseGeneratorName().'/EditType.php';
    }

    /**
     * Gets the correct class name to inherit from
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
