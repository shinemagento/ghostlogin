<?php
/**
 * A Magento 2 module named Shinesoftware/Ghostlogin
 * Copyright (C) 2017 Michelangelo Turillo
 * 
 * This file is part of Shinesoftware/Ghostlogin.
 * 
 * Shinesoftware/Ghostlogin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Shinesoftware\Ghostlogin\Controller\Adminhtml\Token;

class Delete extends \Shinesoftware\Ghostlogin\Controller\Adminhtml\Token
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('token_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Shinesoftware\Ghostlogin\Model\Token');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Token.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['token_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Token to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
