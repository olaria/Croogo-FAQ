<?php

/**
 * Croogo FAQ Extension Schema
 *
 * @category Config
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */

class FaqActivation
{
    /**
     * onActivate will be called if this returns true
     *
     * @param object $controller Controller
     * @return boolean
     */
    public function beforeActivation($controller)
    {
        return true;
    }

    /**
     * onActivation of plugin
     *
     * @param Object $controller
     */
    public function onActivation($controller)
    {
        $controller->Croogo->addAco('Faq');
        $controller->Croogo->addAco('Faq/Faq');
        $controller->Croogo->addAco('Faq/Faq/admin_index');
        $controller->Croogo->addAco('Faq/Faq/admin_add');
        $controller->Croogo->addAco('Faq/Faq/admin_edit');
        $controller->Croogo->addAco('Faq/Faq/admin_view');
        $controller->Croogo->addAco('Faq/Faq/admin_delete');
        $controller->Croogo->addAco('Faq/FaqCategories');
        $controller->Croogo->addAco('Faq/FaqCategories/admin_index');
        $controller->Croogo->addAco('Faq/FaqCategories/admin_add');
        $controller->Croogo->addAco('Faq/FaqCategories/admin_edit');
        $controller->Croogo->addAco('Faq/FaqCategories/admin_view');
        $controller->Croogo->addAco('Faq/FaqCategories/admin_delete');

        App::import('Core', 'File');
        App::import('Model', 'CakeSchema', false);
        App::import('Model', 'ConnectionManager');

        $db = ConnectionManager::getDataSource('default');
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.', true));
        } else {
            CakePlugin::load('Faq');
            $schema =& new CakeSchema(array('plugin' => 'Faq', 'name' => 'Faq'));
            $schema = $schema->load();
            foreach ($schema->tables as $table => $fields) {
                $create = $db->createSchema($schema, $table);
                $db->execute($create);
            }
        }
    }

    /**
     * onDeactivate will be called if this returns true
     *
     * @param object $controller Controller
     * @return boolean
     */
    public function beforeDeactivation($controller)
    {
        return true;
    }

    /**
     * onDeactivation of plugin
     *
     * @param Object $controller
     */
    public function onDeactivation($controller)
    {
        App::import('Core', 'File');
        App::import('Model', 'CakeSchema', false);
        App::import('Model', 'ConnectionManager');

        $db = ConnectionManager::getDataSource('default');
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.', true));
        } else {
            CakePlugin::load('Faq');
            $schema =& new CakeSchema(array('plugin' => 'Faq', 'name' => 'Faq'));
            $schema = $schema->load();
            foreach ($schema->tables as $table => $fields) {
                $drop = $db->dropSchema($schema, $table);
                $db->execute($drop);
            }
        }

        $controller->Croogo->removeAco('Faq');
    }
}