<?php

/**
 * Created by JetBrains PhpStorm.
 * User: helder
 * Date: 10/05/13
 * Time: 14:28
 * To change this template use File | Settings | File Templates.
 */

class FaqHelper extends AppHelper {

    public $helpers = array(
        'Html',
    );

    public function faq($faqs)
    {
        $html = "";
        foreach ($faqs as $faq) {
            $content = "";
            $html .= $this->Html->tag('h3', $faq['name']);

            if (!empty($faq['faqs'])) {
                $faq_content = "";
                foreach ($faq['faqs'] as $f)
                    $faq_content .= $this->Html->para(null, $f['Faq']['question']);

                $html .= $this->Html->div(null, $faq_content, array('escape' => false));
            }

            if (!empty($faq['children']))
                $content .= $this->faq($faq['children']);

            $html .= $this->Html->div(null, $content, array('class' => 'accord', 'escape' => false));
        }

        return $html;
    }
}