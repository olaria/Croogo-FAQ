<?php
/**
 * Add Faq to admin menu
 */
CroogoNav::add(
    'faq',
    array(
        'title' => __d('croogo', 'FAQ'),
        'url' => array(
            'admin' => true,
            'plugin' => 'faq',
            'controller' => 'faq',
            'action' => 'index',
        ),
        'weight' => 50,
        'children' => array(
            'list' => array(
                'title' => __d('croogo', 'List'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'faq',
                    'controller' => 'faq',
                    'action' => 'index',
                ),
            ),
            'new' => array(
                'title' => __d('croogo', 'Add New'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'faq',
                    'controller' => 'faq',
                    'action' => 'add',
                ),
            ),
            'categories' => array(
                'title' => __d('croogo', 'Categories'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'faq',
                    'controller' => 'faq_categories',
                    'action' => 'index',
                ),
            ),
        ),
    )
);