<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Iverve\CrudOperation\Controller\Index;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * Show Contact Us page
     *
     * @return void
     */
    protected $_objectManager;
    
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\ObjectManagerInterface $objectManager) 
    {
        $this->_objectManager = $objectManager;
        parent::__construct($context);    
    }

    public function execute()
    { 
        //exit('hi');
        $post = $this->getRequest()->getPostValue();
        $currenttime = date('Y-m-d H:i:s');
        $model = $this->_objectManager->create('Iverve\CrudOperation\Model\Contacts');
        $model->setData('fname', $post['fname']);
        $model->setData('lname', $post['lname']);
        $model->setData('email', $post['email']);
        $model->setData('contact', $post['contact']);
        $model->setData('bod', $currenttime);
        /*$model->setData('gender', $post['gender']);*/
        $model->setData('featured_image', $post['featured_image']);
        /*$model->setData('hobbies', $post['hobbies']);*/
        $model->setData('is_active', 1);
        $model->save();
        $this->_redirect('*/*/');
        $this->messageManager->addSuccess(__('Your contact has beeen submitted successfully.'));    
    }
}
