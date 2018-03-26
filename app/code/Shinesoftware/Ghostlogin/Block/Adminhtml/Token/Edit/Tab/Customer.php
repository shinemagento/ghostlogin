<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Token\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class Customer extends \Magento\Backend\Block\Widget {

    protected $_template = 'token/customer_summary.phtml';
    protected $_coreRegistry;
    protected $_helper;
    protected $_customerFactory;

    public function __construct(Context $context,
                                Registry $registry,
                                \Magento\Customer\Model\CustomerFactory $customer,
                                array $data = []) {
        $this->_coreRegistry = $registry;
        $this->_customerFactory = $customer;
        parent::__construct($context, $data);
    }

    /**
     * Get the customer data from the database
     *
     * @return \Magento\Framework\DataObject
     */
    public function getCustomer() {
        $token = $this->_coreRegistry->registry("shinesoftware_ghostlogin_token");
        $customer = $this->_customerFactory->create ()->getCollection ()->addFilter ('entity_id', $token->getCustomerId ())->getFirstItem ();
        return $customer;
    }

}
