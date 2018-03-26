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

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $login;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Shinesoftware\Ghostlogin\Model\Login $login
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->login = $login;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue('token_data');
        if ($data) {
            $id = !empty($data['token_id']) ? $data['token_id'] : null;

            $model = $this->_objectManager->create('Shinesoftware\Ghostlogin\Model\Token')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Token no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            if (empty($id)) {
                $data['token'] = $this->login->generateToken();
                $data['created_at'] = date('m/d/Y h:i:s', time());
                $data['counter'] = 0;
                $data['status'] = true;
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Token.'));
                $this->dataPersistor->clear('shinesoftware_ghostlogin_token');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['token_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Token.'));
            }

            $this->dataPersistor->set('shinesoftware_ghostlogin_token', $data);
            return $resultRedirect->setPath('*/*/edit', ['token_id' => $this->getRequest()->getParam('token_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
