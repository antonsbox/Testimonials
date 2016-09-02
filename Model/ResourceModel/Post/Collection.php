<?php

namespace Test\Testimonials\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('Test\Testimonials\Model\Post', 'Test\Testimonials\Model\ResourceModel\Post');
    }

}
