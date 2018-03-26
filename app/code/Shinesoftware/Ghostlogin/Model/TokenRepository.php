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

use Shinesoftware\Ghostlogin\Model\ResourceModel\Token as ResourceToken;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\SortOrder;
use Shinesoftware\Ghostlogin\Api\Data\TokenInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Shinesoftware\Ghostlogin\Api\Data\TokenSearchResultsInterfaceFactory;
use Shinesoftware\Ghostlogin\Model\ResourceModel\Token\CollectionFactory as TokenCollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Shinesoftware\Ghostlogin\Api\TokenRepositoryInterface;

class TokenRepository implements tokenRepositoryInterface
{

    protected $resource;

    private $storeManager;

    protected $dataTokenFactory;

    protected $searchResultsFactory;

    protected $tokenCollectionFactory;

    protected $tokenFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;


    /**
     * @param ResourceToken $resource
     * @param TokenFactory $tokenFactory
     * @param TokenInterfaceFactory $dataTokenFactory
     * @param TokenCollectionFactory $tokenCollectionFactory
     * @param TokenSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceToken $resource,
        TokenFactory $tokenFactory,
        TokenInterfaceFactory $dataTokenFactory,
        TokenCollectionFactory $tokenCollectionFactory,
        TokenSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->tokenFactory = $tokenFactory;
        $this->tokenCollectionFactory = $tokenCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTokenFactory = $dataTokenFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
    ) {
        /* if (empty($token->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $token->setStoreId($storeId);
        } */
        try {
            $token->getResource()->save($token);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the token: %1',
                $exception->getMessage()
            ));
        }
        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($tokenId)
    {
        $token = $this->tokenFactory->create();
        $token->getResource()->load($token, $tokenId);
        if (!$token->getId()) {
            throw new NoSuchEntityException(__('token with id "%1" does not exist.', $tokenId));
        }
        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tokenCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Shinesoftware\Ghostlogin\Api\Data\TokenInterface $token
    ) {
        try {
            $token->getResource()->delete($token);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the token: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($tokenId)
    {
        return $this->delete($this->getById($tokenId));
    }
}
