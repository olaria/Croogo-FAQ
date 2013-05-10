<?php

$this->extend('/Common/admin_index');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'FAQ'), $this->here);

?>
<table class="table table-striped">
    <?php
    $tableHeaders = $this->Html->tableHeaders(
        array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('Category'),
            $this->Paginator->sort('Question'),
            $this->Paginator->sort('Answer'),
            __d('croogo', 'Actions'),
        )
    );
    ?>
    <thead>
    <?php echo $tableHeaders; ?>
    </thead>
    <?php

    $rows = array();
    foreach ($faqs as $faq) :
        $actions = array();
        $actions[] = $this->Croogo->adminRowActions($faq['Faq']['id']);
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq', 'action' => 'edit', $faq['Faq']['id']),
            array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'faq', 'action' => 'delete', $faq['Faq']['id']),
            array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
            __d('croogo', 'Are you sure?')
        );
        $actions = $this->Html->div('item-actions', implode(' ', $actions));
        $rows[] = array(
            $faq['Faq']['id'],
            $faq['FaqCategory']['name'],
            $this->Html->link(
                $faq['Faq']['question'],
                array('controller' => 'faq', 'action' => 'view', $faq['Faq']['id'])
            ),
            $faq['Faq']['answer'],
            $actions,
        );
    endforeach;

    echo $this->Html->tableCells($rows);
    ?>
</table>