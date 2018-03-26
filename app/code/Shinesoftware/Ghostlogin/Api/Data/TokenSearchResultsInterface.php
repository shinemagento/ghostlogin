<?php


namespace Shinesoftware\Ghostlogin\Api\Data;

interface TokenSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get token list.
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface[]
     */
    
    public function getItems();

    /**
     * Set token list.
     * @param \Shinesoftware\Ghostlogin\Api\Data\TokenInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
