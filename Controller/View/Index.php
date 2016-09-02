<?php
namespace Test\Testimonials\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     *  Index, shows a list of recent testimonials posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $post_id = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));
        /** @var \Test\Testimonials\Helper\Post $post_helper */
        $post_helper = $this->_objectManager->get('Test\Testimonials\Helper\Post');
        $result_page = $post_helper->prepareResultPost($this, $post_id);
        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}