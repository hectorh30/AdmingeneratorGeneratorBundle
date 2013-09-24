<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

use Admingenerator\GeneratorBundle\Generator\Column;

/**
 * This builder generate php for filters
 * @author cedric Lombardot
 */
class FormBuilder extends BaseBuilder
{
    public function getYamlKey()
    {
        return 'form';
    }
}
