<?php

namespace Test\Testimonials\Block\Widget;

class ContactInformations extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface {


    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/contact_informations.phtml');
    }

}
