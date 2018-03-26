<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Token;

use Magento\Backend\Block\Widget\Form\Container as FormContainer;

class Edit extends FormContainer {

    protected function _construct() {

        $this->_objectId = 'token_id';
        $this->_blockGroup = 'shinesoftware_ghostlogin';
        $this->_controller = 'adminhtml_token';

        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Token'));

        $this->buttonList->add(
            'save-and-continue', [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ], -100
        );

        $this->buttonList->update('delete', 'label', __('Delete Token'));
    }

}
