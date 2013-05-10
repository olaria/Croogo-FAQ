<?php

app::uses("AppModel", "Model");

/**
 * Croogo FAQ Extension Faq Model
 *
 * @category Model
 * @package  Croogo.Faq
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class Faq extends AppModel
{

    /**
     * Model name
     *
     * @var string
     */
    public $name = "Faq";

    /**
     * Behaviors used by the Model
     *
     * @var array
     */
    public $actsAs = array(
        'Search.Searchable',
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'id' => array(
            'blank' => array(
                'rule' => 'blank',
                'on' => 'create',
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
                'on' => 'update',
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'This field must be numeric.',
                'on' => 'update',
            ),
        ),
        'category_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'This field must be numeric.',
            ),
        ),
        'question' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 3),
                'required' => true,
                'message' => 'This field must be at least 3 characters long.'
            ),
        ),
        'answer' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 3),
                'required' => true,
                'message' => 'This field must be at least 3 characters long.'
            ),
        ),
        'status' => array(
            'inList' => array(
                'rule' => array('inList', array(0, 1)),
                'required' => true,
                'message' => 'This field must be either Active or Inactive.',
            ),
        ),
        'created' => array(
            'datetime' => array(
                'rule' => 'datetime',
                'required' => true,
                'message' => 'This field must be datetime',
            )
        ),
        'updated' => array(
            'datetime' => array(
                'rule' => 'datetime',
                'required' => true,
                'message' => 'This field must be datetime',
            )
        ),
    );

    /**
     * Model associations: belongsTo
     *
     * @var array
     */
    public $belongsTo = array(
        'FaqCategory' => array(
            'className' => 'Faq.FaqCategory',
            'foreignKey' => 'category_id',
        ),
    );

    public function generateHierarchy($parent_id = null)
    {
        $this->recursive = -1;
        $this->FaqCategory->recursive = -1;
        $hierarchy = array();

        $categories = $this->FaqCategory->find('all', array(
                'conditions' => array('FaqCategory.parent_id' => $parent_id),
                'order' => array('FaqCategory.lft ASC'),
            ));

        foreach ($categories as $category) {
            $faqs = $this->find('all', array('conditions' => array('Faq.category_id' => $category['FaqCategory']['id'])));
            $children = $this->generateHierarchy($category['FaqCategory']['id']);

            $hierarchy[] = array(
                'name' => $category['FaqCategory']['name'],
                'faqs' => $faqs,
                'children' => $children
            );
        }

        return $hierarchy;
    }
}