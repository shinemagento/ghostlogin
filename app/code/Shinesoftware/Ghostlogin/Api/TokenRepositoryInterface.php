<?php


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
     * @return \Shinesoftware\Ghostlogin\Api\Data\GhostloginearchResultsInterface
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
