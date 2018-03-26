<?php


namespace Shinesoftware\Ghostlogin\Model\ResourceModel\Token;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Shinesoftware\Ghostlogin\Model\Token',
            'Shinesoftware\Ghostlogin\Model\ResourceModel\Token'
        );
    }

}
