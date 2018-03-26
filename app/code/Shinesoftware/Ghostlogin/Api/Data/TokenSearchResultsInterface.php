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

interface TokenSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get token list.
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface[]
     */
    public function getItems();

    /**
     * Set created_at list.
     * @param \Shinesoftware\Ghostlogin\Api\Data\TokenInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
