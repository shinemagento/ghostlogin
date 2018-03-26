<?php

namespace Shinesoftware\Ghostlogin\Controller\Index;

class Login extends \Magento\Framework\App\Action\Action
{

    protected $login;
    protected $resultPageFactory;
    protected $resultRedirect;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Shinesoftware\Ghostlogin\Model\Login $login,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->login = $login;
        $this->resultRedirect = $result;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirect->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

        $usertoken = $this->getRequest()->getParam('uid');
        $data = $this->login->checkToken($usertoken);

        if($data){
            if($data->getPath()){
                $this->messageManager->addSuccessMessage(__("Autologin was successful!"));
                $resultRedirect->setUrl($data->getPath());
            }else{
                $resultRedirect->setUrl('/customer/account/');
            }
        }else{
            $this->messageManager->addWarningMessage(__("This link is expired! Please login with your credentials!"));
            $resultRedirect->setUrl('/customer/account/');
        }

        return $resultRedirect;

    }
}