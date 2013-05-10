<?php

$this->extend('/Common/admin_edit');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
    $this->Html
        ->addCrumb(__d('croogo', 'FAQs'), array('plugin' => 'faq', 'controller' => 'faq', 'action' => 'index',))
        ->addCrumb('Edit', $this->here);
}

if ($this->request->params['action'] == 'admin_add') {
    $this->Html
        ->addCrumb(__d('croogo', 'FAQs'), array('plugin' => 'faq', 'controller' => 'faq', 'action' => 'index',))
        ->addCrumb(__d('croogo', 'Add'), $this->here);
}

echo $this->Form->create('Faq');

?>
    <div class="row-fluid">
        <div class="span8">
            <ul class="nav nav-tabs">
                <?php
                echo $this->Croogo->adminTab(__d('croogo', 'FAQ'), '#faq-basic');
                echo $this->Croogo->adminTabs();
                ?>
            </ul>

            <div class="tab-content">

                <div id="faq-basic" class="tab-pane">
                    <?php
                    echo $this->Form->input('id');
                    $this->Form->inputDefaults(
                        array(
                            'class' => 'span10',
                            'label' => false,
                        )
                    );
                    echo $this->Form->input(
                        'category_id',
                        array(
                            'label' => __d('croogo', 'Category'),
                        )
                    );
                    echo $this->Form->input(
                        'question',
                        array(
                            'label' => __d('croogo', 'Question'),
                        )
                    );
                    echo $this->Form->input(
                        'answer',
                        array(
                            'label' => __d('croogo', 'Answer'),
                        )
                    );
                    ?>
                </div>

                <?php echo $this->Croogo->adminTabs(); ?>
                <?php //echo $this->Croogo->adminBoxes(); ?>
            </div>
        </div>

        <div class="span4">
            <?php
            echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
                $this->Form->button(__d('croogo', 'Save'), array('button' => 'default')) .
                $this->Html->link(
                    __d('croogo', 'Cancel'),
                    array('action' => 'index'),
                    array('button' => 'danger')
                ) .
                $this->Html->endBox();
            ?>
        </div>

    </div>
<?php echo $this->Form->end(); ?>