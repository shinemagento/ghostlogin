<?php


namespace Shinesoftware\Ghostlogin\Model\ResourceModel;

class Token extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('shinesoftware_ghostlogin_token', 'id');
    }

}
