<?php

App::uses('AppController', 'Controller');

/**
 * Croogo FAQ Extension Faq Controller
 *
 * @category Controller
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class FaqController extends FaqAppController
{
    public $uses = array('Faq.Faq', 'Faq.FaqCategory');
    public $helpers = array('Faq.Faq');

    /**
     * Admin index
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __d('croogo', 'FAQs'));

        $this->Faq->recursive = 0;
        $this->paginate['Faq']['order'] = 'Faq.updated DESC';
        $this->set('faqs', $this->paginate());
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __d('croogo', 'Add FAQ'));

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Faq']['status'] = 1;
            $data['Faq']['created'] = date('Y-m-d H:i:s');
            $data['Faq']['updated'] = date('Y-m-d H:i:s');
            $this->Faq->create();
            if ($this->Faq->save($data)) {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                print_r($this->Faq->validationErrors);
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }

        $categories = $this->Faq->FaqCategory->generateTreeList(null, null, null, " -> ");
        $this->set(compact('categories'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->set('title_for_layout', __d('croogo', 'Edit FAQ'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('croogo', 'Invalid FAQ'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Faq']['updated'] = date('Y-m-d H:i:s');
            $data['Faq']['status'] = 1;

            $this->Faq->recursive = -1;
            $faq = $this->Faq->read(null, $id);
            foreach ($faq['Faq'] as $k => $v) {
                if (!empty($data['Faq'][$k])) {
                    $faq['Faq'][$k] = $data['Faq'][$k];
                }
            }

            if ($this->Faq->save($faq)) {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Faq->read(null, $id);
        }

        $categories = $this->Faq->FaqCategory->generateTreeList(null, null, null, " - ");
        $this->set(compact('categories'));
    }

    /**
     * Admin delete
     *
     * @param integer $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__d('croogo', 'Invalid id for FAQ'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Faq->delete($id)) {
            $this->Session->setFlash(__d('croogo', 'FAQ deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function view()
    {
        $faqs = $this->Faq->generateHierarchy();

        $this->set(compact('faqs'));
    }
}