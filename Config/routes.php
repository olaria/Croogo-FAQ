<?php
/**
 * Route to FAQ.
 */
CroogoRouter::connect(
    '/faq',
    array(
        'plugin' => 'faq',
        'controller' => 'faq',
        'action' => 'view',
        'faq'
    )
);