<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for New actions
 * @author cedric Lombardot
 */
class NewControllerBuilder extends BaseNewBuilder
{
    public function getOutputName()
    {
        return $this->getGenerator()->getGeneratedControllerFolder().'/NewController.php';
    }
}
