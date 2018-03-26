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

namespace Shinesoftware\Ghostlogin\Api\Data;

interface TokenInterface
{

    const COUNTER = 'counter';
    const TOKEN = 'token';
    const PATH = 'path';
    const TOKEN_ID = 'token_id';
    const CREATED_AT = 'created_at';
    const CUSTOMER_ID = 'customer_id';
    const STATUS = 'status';


    /**
     * Get token_id
     * @return string|null
     */
    public function getTokenId();

    /**
     * Set token_id
     * @param string $tokenId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setTokenId($tokenId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get token
     * @return string|null
     */
    public function getToken();

    /**
     * Set token
     * @param string $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setToken($token);

    /**
     * Get path
     * @return string|null
     */
    public function getPath();

    /**
     * Set path
     * @param string $path
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setPath($path);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setStatus($status);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get counter
     * @return string|null
     */
    public function getCounter();

    /**
     * Set counter
     * @param string $counter
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */
    public function setCounter($counter);
}
