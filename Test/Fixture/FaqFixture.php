<?php

/**
 * Croogo FAQ Extension Faq Fixture
 *
 * @category Fixture
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class FaqFixture extends CroogoTestFixture
{

    public $name = 'Faq';

    public $fields = array(
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

    public $records = array(
        array(
            'id' => '1',
            'category_id' => '3',
            'question' => 'Question 1 Children 1 Main 1',
            'answer' => 'Answer Question 1 Children 1 Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:22:39',
            'created' => '2013-05-09 14:22:39'
        ),
        array(
            'id' => '2',
            'category_id' => '3',
            'question' => 'Question 2 Children 1 Main 1',
            'answer' => 'Answer Question 2 Children 1 Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:23:00',
            'created' => '2013-05-09 14:23:00'
        ),
        array(
            'id' => '3',
            'category_id' => '4',
            'question' => 'Question 1 Children 2 Main 1',
            'answer' => 'Answer Question 1 Children 2 Main 1',
            'status' => '1',
            'updated' => '2013-05-09 14:23:31',
            'created' => '2013-05-09 14:23:31'
        ),
        array(
            'id' => '4',
            'category_id' => '5',
            'question' => 'Question 1 Children 1 Main 2',
            'answer' => 'Answer Question 1 Children 1 Main 2',
            'status' => '1',
            'updated' => '2013-05-09 14:24:00',
            'created' => '2013-05-09 14:24:00'
        )
    );
}