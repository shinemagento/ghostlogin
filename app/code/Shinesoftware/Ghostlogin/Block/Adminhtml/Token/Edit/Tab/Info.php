<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Token\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;

class Info extends Generic {

    protected $_coreRegistry;
    protected $_productFactory;
    protected $_tokenFactory;
    protected $_customerFactory;

    /**
     * Info constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Shinesoftware\Ghostlogin\Model\TokenFactory $tokenFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Shinesoftware\Ghostlogin\Model\TokenFactory $tokenFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_customerFactory = $customerFactory;
        $this->_productFactory = $productFactory;
        $this->_tokenFactory = $tokenFactory;

        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareForm() {
        $data = $this->_coreRegistry->registry("shinesoftware_ghostlogin_token");
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('token_');
        $form->setFieldNameSuffix('token_data');


        $fieldset = $form->addFieldset(
            'base_fieldset', ['legend' => __('General Info')]
        );

        $fieldset->addType('rawlink', '\Shinesoftware\Ghostlogin\Block\Adminhtml\Custom\Edit\Renderer\RawlinkRenderer');

        if (isset($data["token_id"]) && !empty($data["token_id"])) {
            $fieldset->addField('token_id', 'hidden', ['name' => 'token_id']);
        }


        $fieldset->addField(
            'path', 'text', [
                'name' => 'path',
                'label' => __('Landing Page'),
                'note' => __('Write here the landing page link. If empty the user will be redirect to the user dashboard. Eg: /mystoreproductpage.html'),
                'required' => false
            ]
        );

        $fieldset->addField(
            'customer_id', 'select', [
                'name' => 'customer_id',
                'label' => __('Customer'),
                'required' => true,
                'options' => $this->getCustomers()
            ]
        );


        $fieldset->addField(
            'status', 'select', [
                'name' => 'status',
                'label' => __('Status'),
                'options' => array('1' => 'Active', '0' => 'Expired')
            ]
        );


        $fieldset->addField(
            'token', 'rawlink', [
                'name' => 'token',
                'label' => __('Ghost Link'),
            ]
        );

        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Get the customer options array
     *
     * @return array
     */
    private function getCustomers(){
        $option = array();
        $collection = $this->_customerFactory->create ()->getCollection ()->setOrder ('lastname', 'ASC');
        foreach ($collection as $item) {
            $option[$item["entity_id"]] = $item["lastname"] . " " . $item["firstname"];
        }
        return $option;
    }

}
