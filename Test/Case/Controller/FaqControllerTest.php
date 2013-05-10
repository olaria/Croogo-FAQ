<?php
App::uses('FaqController', 'Faq.Controller');
App::uses('CroogoControllerTestCase', 'Croogo.TestSuite');
App::uses('CroogoTestFixture', 'Croogo.TestSuite');

class FaqControllerTest extends CroogoControllerTestCase
{

    /**
     * fixtures
     */
    public $fixtures = array(
        /*

        'plugin.blocks.block',
        'plugin.comments.comment',
        'plugin.contacts.contact',

        'plugin.settings.language',
        'plugin.menus.link',

        'plugin.contacts.message',
        'plugin.nodes.node',
        'plugin.meta.meta',
        'plugin.taxonomy.nodes_taxonomy',
        'plugin.blocks.region',


        'plugin.taxonomy.taxonomy',
        'plugin.taxonomy.term',



        */
        'plugin.settings.setting',
        'plugin.croogo.aco',
        'plugin.croogo.aro',
        'plugin.croogo.aros_aco',
        'plugin.users.user',
        'plugin.users.role',
        'plugin.menus.menu',
        'plugin.taxonomy.type',
        'plugin.taxonomy.vocabulary',
        'plugin.taxonomy.types_vocabulary',
        'plugin.translate.i18n',
        'plugin.faq.faq_category',
        'plugin.faq.faq',
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
        $this->FaqController = $this->generate(
            'Faq.Faq',
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
        $this->controller->plugin = 'Faq';
        $this->FaqController->Auth
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
        unset($this->FaqController);
    }

    /**
     * testAdminIndex
     *
     * @return void
     */
    public function testAdminIndex()
    {
        $this->testAction('/admin/faq/faq/index');
        $this->assertNotEmpty($this->vars['faqs']);
    }

    /**
     * testAdminAdd
     *
     * @return void
     */
    public function testAdminAdd()
    {
        $this->expectFlashAndRedirect('The FAQ has been saved');
        $this->testAction(
            'admin/faq/faq/add',
            array(
                'data' => array(
                    'Faq' => array(
                        'category_id' => 3,
                        'question' => 'New Question',
                        'answer' => 'Answer New Question',
                    ),
                ),
            )
        );
        $newFaq = $this->FaqController->Faq->findByQuestion('New Question');
        $this->assertEqual($newFaq['Faq']['category_id'], 3);
        $this->assertEqual($newFaq['Faq']['question'], 'New Question');
        $this->assertEqual($newFaq['Faq']['answer'], 'Answer New Question');
    }

    /**
     * testAdminEdit
     *
     * @return void
     */
    public function testAdminEdit()
    {
        $this->expectFlashAndRedirect('The FAQ has been saved');
        $this->testAction(
            '/admin/faq/faq/edit/1',
            array(
                'data' => array(
                    'Faq' => array(
                        'id' => 1,
                        'category_id' => 4,
                        'question' => 'Question 1 Children 2 Main 1',
                        'answer' => 'Answer Question 1 Children 2 Main 1',
                    ),
                ),
            )
        );
        $faq = $this->FaqController->Faq->findById(1);
        $this->assertEqual($faq['Faq']['category_id'], 4);
        $this->assertEqual($faq['Faq']['question'], 'Question 1 Children 2 Main 1');
        $this->assertEqual($faq['Faq']['answer'], 'Answer Question 1 Children 2 Main 1');
    }

    /**
     * testAdminDelete
     *
     * @return void
     */
    public function testAdminDelete()
    {
        $this->expectFlashAndRedirect('FAQ deleted');
        $this->testAction('admin/faq/faq/delete/1');
        $hasAny = $this->FaqController->Faq->hasAny(
            array(
                'Faq.category_id' => 1,
                'Faq.question' => 'Question 1 Children 2 Main 1',
                'Faq.answer' => 'Answer Question 1 Children 2 Main 1',
            )
        );
        $this->assertFalse($hasAny);
    }

}