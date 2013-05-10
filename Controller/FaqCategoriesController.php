<?php

App::uses('AppController', 'Controller');

/**
 * Croogo FAQ Extension Faq Categories Controller
 *
 * @category Controller
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class FaqCategoriesController extends FaqAppController
{
    public $uses = array('Faq.FaqCategory');

    /**
     * Admin index
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __d('croogo', 'FAQ Categories'));

        $this->FaqCategory->recursive = 0;
        $this->paginate['FaqCategory']['order'] = 'FaqCategory.lft ASC';
        $this->set('categories', $this->paginate());
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __d('croogo', 'Add FAQ Category'));

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['FaqCategory']['status'] = 1;
            $data['FaqCategory']['created'] = date('Y-m-d H:i:s');
            $data['FaqCategory']['updated'] = date('Y-m-d H:i:s');
            $this->FaqCategory->create();
            if ($this->FaqCategory->save($data)) {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ category has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ category could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }

        $parents = array(null => '') + $this->FaqCategory->generateTreeList(null, null, null, " - ");
        $this->set(compact('parents'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->set('title_for_layout', __d('croogo', 'Edit FAQ Category'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('croogo', 'Invalid FAQ Category'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['FaqCategory']['updated'] = date('Y-m-d H:i:s');
            $data['FaqCategory']['status'] = 1;

            $this->FaqCategory->recursive = -1;
            $category = $this->FaqCategory->read(null, $id);
            foreach ($category['FaqCategory'] as $k => $v) {
                if (!empty($data['FaqCategory'][$k])) {
                    $category['FaqCategory'][$k] = $data['FaqCategory'][$k];
                }
            }

            if ($this->FaqCategory->save($category)) {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ category has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The FAQ category could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->FaqCategory->read(null, $id);
        }

        $parents = array(null => '') + $this->FaqCategory->generateTreeList(null, null, null, " - ");
        $this->set(compact('parents'));
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
            $this->Session->setFlash(
                __d('croogo', 'Invalid id for FAQ category'),
                'default',
                array('class' => 'error')
            );
            $this->redirect(array('action' => 'index'));
        }
        if ($this->FaqCategory->delete($id)) {
            $this->Session->setFlash(__d('croogo', 'FAQ Category deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     */
    public function admin_moveup($id, $step = 1)
    {
        if ($this->FaqCategory->moveUp($id, $step)) {
            $this->Session->setFlash(__d('croogo', 'Moved up successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__d('croogo', 'Could not move up'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     */
    public function admin_movedown($id, $step = 1)
    {
        if ($this->FaqCategory->moveDown($id, $step)) {
            $this->Session->setFlash(__d('croogo', 'Moved down successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__d('croogo', 'Could not move down'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }

}