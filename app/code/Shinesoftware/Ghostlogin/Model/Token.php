<?php
/**
 * A Magento 2 module named Shinesoftware/Ghostlogin
 * Copyright (C) 2017 Michelangelo Turillo
 * 
 * This file is part of Shinesoftware/Ghostlogin.
 * 
 * Shinesoftware/Ghostlogin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

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
    public function getTokenId()
    {
        return $this->getData(self::TOKEN_ID);
    }

    /**
     * Set token_id
     * @param string $tokenId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setTokenId($tokenId)
    {
        return $this->setData(self::TOKEN_ID, $tokenId);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get token
     * @return string
     */
    public function getToken()
    {
        return $this->getData(self::TOKEN);
    }

    /**
     * Set token
     * @param string $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setToken($token)
    {
        return $this->setData(self::TOKEN, $token);
    }

    /**
     * Get path
     * @return string
     */
    public function getPath()
    {
        return $this->getData(self::PATH);
    }

    /**
     * Set path
     * @param string $path
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setPath($path)
    {
        return $this->setData(self::PATH, $path);
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get counter
     * @return string
     */
    public function getCounter()
    {
        return $this->getData(self::COUNTER);
    }

    /**
     * Set counter
     * @param string $counter
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCounter($counter)
    {
        return $this->setData(self::COUNTER, $counter);
    }
}
