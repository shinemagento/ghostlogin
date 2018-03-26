<?php

namespace Shinesoftware\Ghostlogin\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Customer
 *
 * get all the Customer from the database
 * 
 */
class Customer implements OptionSourceInterface
{
    /**
     * @var \Shinesoftware\Shineisp\Model\CustomerFactory
     */
    protected $_customerFactory;

    /**
     * Customer constructor.
     * @param \Magento\Customer\Model\CustomerFactory $customer
     */
    public function __construct(\Magento\Customer\Model\CustomerFactory $customer)
    {
        $this->_customerFactory = $customer;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $records = array();

        $Customers = $this->_customerFactory->create();
        $dataCollection = $Customers->getCollection()->setOrder ('lastname', 'asc');
        foreach ($dataCollection as $data){
            $records[] = [
                'label' => $data->getLastname() . " " . $data->getFirstname(),
                'value' => $data->getId(),
            ];
        }

        return $records;
    }
}