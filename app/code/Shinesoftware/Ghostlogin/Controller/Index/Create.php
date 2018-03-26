<?php

namespace Shinesoftware\Ghostlogin\Controller\Index;

class Create extends \Magento\Framework\App\Action\Action
{

    protected $login;
    protected $resultPageFactory;
    protected $storeManager;
    protected $resultRedirect;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Shinesoftware\Ghostlogin\Model\Login $login,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->login = $login;
        $this->storeManager = $storeManager;
        $this->resultRedirect = $result;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirect->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/');

        $uid = $this->getRequest()->getParam('uid');
        $path = $this->getRequest()->getParam('path');

        $token = $this->login->createToken($uid, "/$path");
        if($token){
            $storeId = $this->storeManager->getDefaultStoreView()->getStoreId();
            $url = $this->storeManager->getStore($storeId)->getUrl("ghostlogin/index/login", array('uid' => $token->getToken()));

            $this->messageManager->addSuccessMessage(sprintf(__("The ghost link %s has been created!"), $url));
            $resultRedirect->setUrl('/customer/account/');
        }else{
            $this->messageManager->addErrorMessage(__("The ghost link has been not created because the user has been not found!"));
        }

        return $resultRedirect;

    }
}