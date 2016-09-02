<?php

namespace Test\Testimonials\Block\Adminhtml\Post\Edit;

/**
 * Adminhtml testimonials post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->setId('post_form');
        $this->setTitle(__('Post Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /** @var \Test\Testimonials\Model\Post $model */
        $model = $this->_coreRegistry->registry('testimonials_post');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
                ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post', 'enctype' => "multipart/form-data"]]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
                'base_fieldset', ['legend' => __('General'), 'class' => 'fieldset-wide']
        );

        if ($model->getPostId()) {
            $fieldset->addField('post_id', 'hidden', ['name' => 'post_id']);
        }

        $fieldset->addField(
                'name', 'text', [
            'name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true]
        );
        $fieldset->addField(
                'photo', 'image', [
            'title' => __('Photo'),
            'label' => __('Photo'),
            'name' => 'photo_url',
            'note' => 'Allow image type: jpg, jpeg, gif, png',
                ]
        );
//        $form = $this->_formFactory->create(['data' =>
//            ['id' =>
//                'edit_form', 'action' =>
//                $this->getData('action'), 'method' => 'post', 'enctype' => 'multipart/form-data']]);
//                'url_key', 'text', [
//            'name' => 'url_key',
//            'label' => __('URL Key'),
//            'title' => __('URL Key'),
//            'required' => true,
//            'class' => 'validate-xml-identifier'
//                ]
//        );

        $fieldset->addField(
                'is_active', 'select', [
            'label' => __('Status'),
            'title' => __('Status'),
            'name' => 'is_active',
            'required' => true,
            'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
                ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        $fieldset->addField(
                'text', 'editor', [
            'name' => 'text',
            'label' => __('Text'),
            'title' => __('text'),
            'style' => 'height:36em',
            'required' => true
                ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
