<pre>
    <?php //print_r($faqs); ?>
</pre>
<?php
echo $this->Html->css('/faq/css/jquery-ui.css', null);
$this->Html->script('/faq/js/jquery.ui.core.min.js', false);
$this->Html->script('/faq/js/jquery.ui.widget.min.js', false);
$this->Html->script('/faq/js/jquery.ui.effect.min.js', false);
$this->Html->script('/faq/js/jquery.ui.accordion.min.js', false);
$this->Html->script('/faq/js/faq.js', false);
?>
<div id="faqs-container" class="accord">
    <?php echo $this->Faq->faq($faqs); ?>
</div>