<?php
App::uses('FaqCategoriesController', 'Faq.Controller');
App::uses('CroogoControllerTestCase', 'Croogo.TestSuite');

class FaqCategoriesControllerTest extends CroogoControllerTestCase
{

    /**
     * fixtures
     */
    public $fixtures = array(
        'plugin.croogo.aco',
        'plugin.croogo.aro',
        'plugin.croogo.aros_aco',
        'plugin.blocks.block',
        'plugin.comments.comment',
        'plugin.contacts.contact',
        'plugin.translate.i18n',
        'plugin.settings.language',
        'plugin.menus.link',
        'plugin.menus.menu',
        'plugin.contacts.message',
        'plugin.nodes.node',
        'plugin.meta.meta',
        'plugin.taxonomy.nodes_taxonomy',
        'plugin.blocks.region',
        'plugin.users.role',
        'plugin.settings.setting',
        'plugin.taxonomy.taxonomy',
        'plugin.taxonomy.term',
        'plugin.taxonomy.type',
        'plugin.taxonomy.types_vocabulary',
        'plugin.users.user',
        'plugin.taxonomy.vocabulary',
    );

    /**
     * setUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        App::build(
            array(
                'View' => array(CakePlugin::path('Faq') . 'View' . DS)
            ),
            App::APPEND
        );
        $this->FaqCategoriesController = $this->generate(
            'Faq.FaqCategories',
            array(
                'methods' => array(
                    'redirect',
                ),
                'components' => array(
                    'Auth' => array('user'),
                    'Session',
                ),
            )
        );
        $this->FaqCategoriesController->Auth
            ->staticExpects($this->any())
            ->method('user')
            ->will($this->returnCallback(array($this, 'authUserCallback')));
    }

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->FaqCategoriesController);
    }

    /**
     * testAdminIndex
     *
     * @return void
     */
    public function testAdminIndex()
    {
        $this->testAction('/admin/faq/faq_categories/index');
        $this->assertNotEmpty($this->vars['categories']);
    }

    /**
     * testAdminAdd
     *
     * @return void
     */
    public function testAdminAdd()
    {
        $this->expectFlashAndRedirect('The FAQ category has been saved');
        $this->testAction(
            'admin/faq/faq_categories/add',
            array(
                'data' => array(
                    'FaqCategory' => array(
                        'parent_id' => 2,
                        'name' => 'New Category',
                    ),
                ),
            )
        );
        $newCategory = $this->FaqCategoriesController->FaqCategory->findByName('New Category');
        $this->assertEqual($newCategory['FaqCategory']['parent_id'], 2);
        $this->assertEqual($newCategory['FaqCategory']['name'], 'New Category');
    }

    /**
     * testAdminEdit
     *
     * @return void
     */
    public function testAdminEdit()
    {
        $this->expectFlashAndRedirect('The FAQ Category has been saved');
        $this->testAction(
            '/admin/faq/faq_categories/edit/3',
            array(
                'data' => array(
                    'FaqCategory' => array(
                        'id' => 3,
                        'parent_id' => 2,
                        'name' => 'Children 1 Main 2',
                    ),
                ),
            )
        );
        $category = $this->FaqCategoriesController->FaqCategory->findById(3);
        $this->assertEqual($category['FaqCategory']['parent_id'], 2);
        $this->assertEqual($category['FaqCategory']['name'], 'Children 1 Main 2');
    }

    /**
     * testAdminDelete
     *
     * @return void
     */
    public function testAdminDelete()
    {
        $this->expectFlashAndRedirect('FAQ Category deleted');
        $this->testAction('admin/faq/faq_categories/delete/3');
        $hasAny = $this->FaqCategoriesController->FaqCategory->hasAny(
            array(
                'FaqCategory.parent_id' => 1,
                'FaqCategory.name' => 'Children 1 Main 2',
            )
        );
        $this->assertFalse($hasAny);
    }

    /**
     * testAdminMoveup
     *
     * @return void
     */
    public function testAdminMoveup()
    {
        $this->expectFlashAndRedirect('Moved up successfully');
        $this->testAction('admin/faq/faq_categories/moveup/2');
        $categories = $this->FaqCategoriesController->FaqCategory->find(
            'list',
            array(
                'fields' => array(
                    'id',
                    'name',
                ),
                'order' => 'FaqCategory.lft ASC',
            )
        );
        $expected = array(
            '2' => 'Main 1',
            '1' => 'Main 2',
        );
        $this->assertEqual($categories, $expected);
    }

    /**
     * testAdminMovedown
     *
     * @return void
     */
    public function testAdminMovedown()
    {
        $this->expectFlashAndRedirect('Moved down successfully');
        $this->testAction('admin/faq/faq_categories/movedown/1');
        $categories = $this->FaqCategoriesController->FaqCategory->find(
            'list',
            array(
                'fields' => array(
                    'id',
                    'name',
                ),
                'order' => 'FaqCategory.lft ASC',
            )
        );
        $expected = array(
            '2' => 'Main 1',
            '1' => 'Main 2',
        );
        $this->assertEqual($categories, $expected);
    }

}