<?php
namespace Iverve\CrudOperation\Controller\Adminhtml\Contacts;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('contact_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create('Iverve\CrudOperation\Model\Contacts');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('The info has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['contact_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a info to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
