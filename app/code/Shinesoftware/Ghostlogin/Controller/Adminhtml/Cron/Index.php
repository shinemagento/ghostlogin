<?php

namespace Shinesoftware\Ghostlogin\Controller\Adminhtml\Cron;

class Index extends \Magento\Backend\App\Action {
    protected $_publicActions = ['index'];
    const ADMIN_RESOURCE = 'Shinesoftware_Ghostlogin::top_level';

    protected $coreRegistry;
    protected $checklinks;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Shinesoftware\Ghostlogin\Cron\Checklinks $checklinks

    ) {
        $this->coreRegistry = $coreRegistry;
        $this->checklinks = $checklinks;

        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $this->checklinks->execute();
        $this->messageManager->addSuccessMessage(__("Ghost links have been updated!"));

        $this->_redirect('adminhtml/system_config/edit/section/ghostlogin/');
        return;

    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Shinesoftware_Ghostlogin::cron');
    }
}
