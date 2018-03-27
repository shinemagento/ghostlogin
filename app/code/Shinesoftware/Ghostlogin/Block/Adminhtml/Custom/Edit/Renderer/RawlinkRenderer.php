<?php

namespace Shinesoftware\Ghostlogin\Block\Adminhtml\Custom\Edit\Renderer;
use Magento\Framework\App\Config\ScopeConfigInterface;
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
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        StoreManagerInterface $storeManager,
        array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;

        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
    }

    public function getElementHtml()
    {
        $html = '';
        if(empty($this->getEscapedValue())){
            return null;
        }
        $delete = $this->scopeConfig->getValue ('ghostlogin/settings/deleteafter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $url = $this->storeManager->getStore()->getBaseUrl() . 'ghostlogin/index/login/uid/' . $this->getEscapedValue();

        $htmlId = $this->getHtmlId();

        $beforeElementHtml = $this->getBeforeElementHtml();
        if ($beforeElementHtml) {
            $html .= '<label class="addbefore" for="' . $htmlId . '">' . $beforeElementHtml . '</label>';
        }

        if($delete){
            $html .= "<p style='height: 37px;line-height: 33px;'>$url</p>
                      <small>".__('Warning! This link will be deleted after the use! Check your preference in the configuration panel.')."
                      </small>";
        }else{
            $html .= "<a style='height: 37px;line-height: 33px;' target='_blank' href='$url'>$url</a>";
        }


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