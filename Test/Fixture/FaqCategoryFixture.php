<?php

/**
 * Croogo FAQ Extension FaqCategory Fixture
 *
 * @category Fixture
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class FaqCategoryFixture extends CroogoTestFixture
{

    public $name = 'FaqCategory';

    public $fields = array(
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

    public $records = array(
        array(
            'id' => '1',
            'parent_id' => null,
            'lft' => '1',
            'rght' => '6',
            'name' => 'Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:18:41',
            'created' => '2013-05-09 14:18:41'
        ),
        array(
            'id' => '2',
            'parent_id' => null,
            'lft' => '7',
            'rght' => '10',
            'name' => 'Main 2',
            'status' => '1',
            'updated' => '2013-05-09 14:18:51',
            'created' => '2013-05-09 14:18:51'
        ),
        array(
            'id' => '3',
            'parent_id' => '1',
            'lft' => '2',
            'rght' => '3',
            'name' => 'Children 1 Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:19:10',
            'created' => '2013-05-09 14:19:10'
        ),
        array(
            'id' => '4',
            'parent_id' => '1',
            'lft' => '4',
            'rght' => '5',
            'name' => 'Children 2 Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:19:25',
            'created' => '2013-05-09 14:19:25'
        ),
        array(
            'id' => '5',
            'parent_id' => '2',
            'lft' => '8',
            'rght' => '9',
            'name' => 'Children 1 Main 2',
            'status' => '1',
            'updated' => '2013-05-09 14:19:36',
            'created' => '2013-05-09 14:19:36'
        )
    );
}