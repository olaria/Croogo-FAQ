<?php

/**
 * Croogo FAQ Extension Schema
 *
 * @category Schema
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class FaqSchema extends CakeSchema
{
    /**
     * Definitions to table faq_categories
     *
     * @var array
     */
    public $faq_categories = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null),
        'lft' => array('type' => 'integer', 'null' => true, 'default' => null),
        'rght' => array('type' => 'integer', 'null' => true, 'default' => null),
        'name' => array(
            'type' => 'string',
            'null' => false,
            'default' => null,
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8'
        ),
        'status' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );

    /**
     * Definitions to table faq
     *
     * @var array
     */
    public $faqs = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
        'category_id' => array('type' => 'integer', 'null' => false, 'default' => null),
        'question' => array(
            'type' => 'string',
            'null' => false,
            'default' => null,
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8'
        ),
        'answer' => array(
            'type' => 'text',
            'null' => false,
            'default' => null,
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8'
        ),
        'status' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
}