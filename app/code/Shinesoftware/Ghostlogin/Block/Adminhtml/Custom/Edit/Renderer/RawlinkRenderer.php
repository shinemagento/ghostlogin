<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Custom\Edit\Renderer;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Escaper;
use Magento\Store\Model\StoreManagerInterface;

/**
 * CustomFormField Customformfield field renderer
 */
class RawlinkRenderer extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $storeManager;

    public function __construct(
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        StoreManagerInterface $storeManager,
        array $data = [])
    {
        $this->storeManager = $storeManager;

        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
    }

    public function getElementHtml()
    {
        $html = '';
        if(empty($this->getEscapedValue())){
            return null;
        }

        $url = $this->storeManager->getStore()->getBaseUrl() . 'ghostlogin/index/login/uid/' . $this->getEscapedValue();

        $htmlId = $this->getHtmlId();

        $beforeElementHtml = $this->getBeforeElementHtml();
        if ($beforeElementHtml) {
            $html .= '<label class="addbefore" for="' . $htmlId . '">' . $beforeElementHtml . '</label>';
        }

        $html .= "<a style='height: 37px;line-height: 33px;' target='_blank' href='$url'>$url</a>";

        $afterElementJs = $this->getAfterElementJs();
        if ($afterElementJs) {
            $html .= $afterElementJs;
        }

        $afterElementHtml = $this->getAfterElementHtml();
        if ($afterElementHtml) {
            $html .= '<label class="addafter" for="' . $htmlId . '">' . $afterElementHtml . '</label>';
        }

        return $html;
    }

}