<?php

namespace Test\Testimonials\Block\Widget;

use Test\Testimonials\Api\Data\PostInterface;
use Test\Testimonials\Model\ResourceModel\Post\Collection as PostCollection;

class Testimonials extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface {

    protected $_postCollectionFactory;

    protected function _construct() {
        parent::_construct();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $postCollectionFactory = $objectManager->create('\Test\Testimonials\Model\ResourceModel\Post\CollectionFactory');
        $this->_postCollectionFactory = $postCollectionFactory;
        $this->setTemplate('widget/Testimonials.phtml');
    }

    /**
     * @return  \Test\Testimonials\Model\ResourceModel\Post\Collection
     */
    public function getPosts() {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                    ->create()
                    ->addFilter('is_active', 1)
                    ->addOrder(
                    PostInterface::CREATION_TIME, PostCollection::SORT_ORDER_DESC
            );
            $this->setData('posts', $posts);
        }
        return $this->getData('posts');
    }

}
