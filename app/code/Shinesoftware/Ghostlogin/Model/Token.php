<?php


namespace Shinesoftware\Ghostlogin\Model;

use Shinesoftware\Ghostlogin\Api\Data\TokenInterface;

class Token extends \Magento\Framework\Model\AbstractModel implements TokenInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Shinesoftware\Ghostlogin\Model\ResourceModel\Token');
    }

    /**
     * Get token_id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set token_id
     * @param string $tokenId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setId($tokenId)
    {
        return $this->setData(self::ID, $tokenId);
    }

    /**
     * Get creation date
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set creation date
     * @param string $created_at
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * Get token string
     * @return string
     */
    public function getToken()
    {
        return $this->getData(self::TOKEN);
    }

    /**
     * Set Token string
     * @param string $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setToken($token)
    {
        return $this->setData(self::TOKEN, $token);
    }

    /**
     * Get customer id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer Id
     * @param string $customer_id
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * Get path string
     * @return string
     */
    public function getPath()
    {
        return $this->getData(self::PATH);
    }

    /**
     * Set custom path
     * @param string $path
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setPath($path)
    {
        return $this->setData(self::PATH, $path);
    }

    /**
     * Get token status
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set token status
     * @param string $path
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
    /**
     * Get counter
     * @return integer
     */
    public function getCounter()
    {
        return $this->getData(self::COUNTER);
    }

    /**
     * Set counter
     * @param integer $counter
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCounter($counter)
    {
        return $this->setData(self::COUNTER, $counter);
    }


}
