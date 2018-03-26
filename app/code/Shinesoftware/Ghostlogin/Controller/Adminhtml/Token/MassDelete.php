<?php

namespace Shinesoftware\Ghostlogin\Controller\Adminhtml\Token;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var \Shinesoftware\Ghostlogin\Model\ResourceModel\Token\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Shinesoftware\Ghostlogin\Api\TokenRepositoryInterface
     */
    protected $tokenRepository;

    /**
     * massStatus constructor.
     * @param Context $context
     * @param Filter $filter
     * @param \Shinesoftware\Ghostlogin\Api\TokenRepositoryInterface $tokenRepositoryInterface
     * @param \Shinesoftware\Ghostlogin\Model\ResourceModel\Token\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Shinesoftware\Ghostlogin\Api\TokenRepositoryInterface $tokenRepositoryInterface,
        \Shinesoftware\Ghostlogin\Model\ResourceModel\Token\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->tokenRepository = $tokenRepositoryInterface;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 element(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }


}
