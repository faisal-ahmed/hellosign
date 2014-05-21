<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Represents a paged list of HelloSign Templates (a.k.a., ReusableForms)
 */
class TemplateList extends AbstractResourceList
{
    /**
     * @var string
     * @ignore
     */
    protected $list_type = 'templates';

    /**
     * @var string
     * @ignore
     */
    protected $resource_class = 'Template';
}