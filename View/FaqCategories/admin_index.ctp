<?php

$this->extend('/Common/admin_index');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'FAQ'), array('plugin' => 'faq', 'controller' => 'faq', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'Categories'), $this->here);

?>
<table class="table table-striped">
    <?php
    $tableHeaders = $this->Html->tableHeaders(
        array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('Parent'),
            $this->Paginator->sort('Name'),
            __d('croogo', 'Actions'),
        )
    );
    ?>
    <thead>
    <?php echo $tableHeaders; ?>
    </thead>
    <?php

    $rows = array();
    foreach ($categories as $category) :
        $actions = array();
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq_categories', 'action' => 'moveup', $category['FaqCategory']['id']),
            array('icon' => 'chevron-up', 'tooltip' => __d('croogo', 'Move up'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq_categories', 'action' => 'movedown', $category['FaqCategory']['id']),
            array('icon' => 'chevron-down', 'tooltip' => __d('croogo', 'Move down'))
        );
        $actions[] = $this->Croogo->adminRowActions($category['FaqCategory']['id']);
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq_categories', 'action' => 'edit', $category['FaqCategory']['id']),
            array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq_categories', 'action' => 'delete', $category['FaqCategory']['id']),
            array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
            __d('croogo', 'Are you sure?')
        );
        $actions = $this->Html->div('item-actions', implode(' ', $actions));
        $rows[] = array(
            $category['FaqCategory']['id'],
            !empty($category['Parent']['name']) ? $category['Parent']['name'] : "",
            $this->Html->link(
                $category['FaqCategory']['name'],
                array('controller' => 'faq_categories', 'action' => 'view', $category['FaqCategory']['id'])
            ),
            $actions,
        );
    endforeach;

    echo $this->Html->tableCells($rows);
    ?>
</table>