<?php

namespace Test\Testimonials\Controller;

class Router implements \Magento\Framework\App\RouterInterface {
    /*
     * @var \Magento\Framework\App\ActionFactory
     */

    protected $actionFactory;

    /*
     * Post factory
     * @var \Test\Testimonials\Model\PostFactory
     */

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Test\Testimonials\Model\PostFactory $postFactory
     */
    public function __construct(
    \Magento\Framework\App\ActionFactory $actionFactory, \Test\Testimonials\Model\PostFactory $postFactory
    ) {
        $this->actionFactory = $actionFactory;
        $this->_postFactory = $postFactory;
    }

    /**
     * Validate and Match testimonials  and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request) {
//        throw new \Magento\Framework\Exception\LocalizedException(
//        __('$request->getPathInfo()  ' . $request->getPathInfo())
//        );
//        $url_key = trim($request->getPathInfo(), '/testimonials/');
        $url_key = str_replace('/testimonials/', '', $request->getPathInfo());
        $url_key = rtrim($url_key, '/');

//        throw new \Magento\Framework\Exception\LocalizedException(
//        __('$url_key  ' . $url_key)
//        );


        /** @var \Test\Testimonials\Model\Post $post */
        $post = $this->_postFactory->create();
        $post_id = $post->checkUrlKey($url_key);


        if (!$post_id) {
            return null;
        }

        $request->setModuleName('testimonials')->setControllerName('view')->setActionName('index')->setParam('post_id', $post_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }

}
