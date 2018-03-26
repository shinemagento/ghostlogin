<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Token\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs {

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;

        parent::__construct($context, $jsonEncoder, $authSession, $data);
        $this->setId('token_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Token Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab(
            'token_info', [
                'label' => __('General Info'),
                'title' => __('General Info'),
                'content' => $this->getLayout()->createBlock(
                    'Shinesoftware\Ghostlogin\Block\Adminhtml\Token\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );

        if($this->_coreRegistry->registry('shinesoftware_ghostlogin_token')->getId()){ // it is showed only in edit mode
            $this->addTab(
                'customer_info', [
                    'label' => __('Customer'),
                    'title' => __('Customer'),
                    'content' => $this->getLayout()->createBlock(
                        'Shinesoftware\Ghostlogin\Block\Adminhtml\Token\Edit\Tab\Customer'
                    )->toHtml(),
                    'active' => false
                ]
            );
        }


        return parent::_beforeToHtml();
    }

}
