<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for New actions
 * @author cedric Lombardot
 */
class NewTemplateBuilder extends BaseNewBuilder
{
    public function getTemplatesToGenerate()
    {
        return parent::getTemplatesToGenerate() + array(
            'EditTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/new/index.html.twig',
            'Edit/FormTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/new/form.html.twig',
        );
    }

    /**
     * Returns the corresponding template to extend the form view
     * 
     * @return string
     */
    public function getExtendingFormTemplate()
    {
        if ($this->getGenerator()->getFromYaml('builders.form')) {
            $bundle = $this->getNamespacePrefixForTemplate() . $this->getVariable('bundle_name');
            $folder = $this->getBaseGeneratorName();
            $file = 'form.html.twig';
            return $this->getDefinedOrGeneratedTemplateName($bundle, $folder, $file);
        }

        return false;
    }
}
