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
}
