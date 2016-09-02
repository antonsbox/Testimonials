<?php

namespace Test\Testimonials\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Save extends \Magento\Backend\App\Action {

    protected $fileSystem;
    protected $uploaderFactory;
    protected $allowedExtensions = ['jpg', 'png', 'gif'];
    protected $fileId = 'photo_url';

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, Filesystem $fileSystem, UploaderFactory $uploaderFactory) {

        $this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('testimonials_post::save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $destinationPath = $this->getDestinationPath();
      
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
                    ->setAllowCreateFolders(true)
                    ->setAllowedExtensions($this->allowedExtensions)
                    ->addValidateCallback('validate', $this, 'validateFile');
            if (!($result = $uploader->save($destinationPath))) {
                throw new LocalizedException(
                __('File cannot be saved to path: $1', $destinationPath)
                );
            } else {

                $this->messageManager->addSuccess(__('You have uploaded your file to ' . $destinationPath . $result['file']));
            }


            // @todo
            // process the uploaded file
        } catch (\Exception $e) {
            $this->messageManager->addError(
                    __($e->getMessage())
            );
        }


        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data['photo_url'] = $result['file'];
            /** @var \Test\Testimonials\Post $model */
            $model = $this->_objectManager->create('Test\Testimonials\Model\Post');

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                    'testimonials_post_prepare_save', ['post' => $model, 'request' => $this->getRequest()]
            );

            try {

                $model->save();
                $this->messageManager->addSuccess(__('You saved your Testimonial.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving your Testimonial.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function validateFile($filePath) {
        // @todo
        // your custom validation code here
    }

    public function getDestinationPath() {
        return $this->fileSystem
                        ->getDirectoryWrite(DirectoryList::MEDIA)
                        ->getAbsolutePath('/');
    }



}
