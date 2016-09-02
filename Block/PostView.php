<?php
namespace Test\Testimonials\Block;

class PostView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Test\Testimonials\Model\Post $post
     * @param \Test\Testimonials\Model\PostFactory $postFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\Testimonials\Model\Post $post,
        \Test\Testimonials\Model\PostFactory $postFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        
        $this->_post = $post;
        $this->_postFactory = $postFactory;
    }

    /**
     * @return \Test\Testimonials\Model\Post
     */
    public function getPost()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('post')) {
            if ($this->getPostId()) {
                /** @var \Test\Testimonials\Model\Post $page */
                $post = $this->_postFactory->create();
            } else {
                $post = $this->_post;
            }
            $this->setData('post', $post);
        }
        return $this->getData('post');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Test\Testimonials\Model\Post::CACHE_TAG . '_' . $this->getPost()->getId()];
    }

}