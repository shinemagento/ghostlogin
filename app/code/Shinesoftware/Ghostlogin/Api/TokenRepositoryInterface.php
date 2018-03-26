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

namespace Shinesoftware\Ghostlogin\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TokenRepositoryInterface
{


    /**
     * Save token
     * @param \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
    );

    /**
     * Retrieve token
     * @param string $tokenId
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($tokenId);

    /**
     * Retrieve token matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete token
     * @param \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
    );

    /**
     * Delete token by ID
     * @param string $tokenId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tokenId);
}
