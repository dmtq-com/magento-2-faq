<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use DMTQ\FAQ\Api\CategoryRepositoryInterface;
use DMTQ\FAQ\Api\Data\CategoryInterface;
use DMTQ\FAQ\Api\Data\CategoryInterfaceFactory;
use DMTQ\FAQ\Api\Data\CategorySearchResultsInterfaceFactory;
use DMTQ\FAQ\Model\ResourceModel\Category as ResourceCategory;
use DMTQ\FAQ\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @var ResourceCategory
     */
    protected $resource;

    /**
     * @var CategoryInterfaceFactory
     */
    protected $categoryFactory;

    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var Category
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceCategory $resource
     * @param CategoryInterfaceFactory $categoryFactory
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param CategorySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCategory $resource,
        CategoryInterfaceFactory $categoryFactory,
        CategoryCollectionFactory $categoryCollectionFactory,
        CategorySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->categoryFactory = $categoryFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CategoryInterface $category)
    {
        try {
            $this->resource->save($category);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the category: %1',
                $exception->getMessage()
            ));
        }
        return $category;
    }

    /**
     * @inheritDoc
     */
    public function get($categoryId)
    {
        $category = $this->categoryFactory->create();
        $this->resource->load($category, $categoryId);
        if (!$category->getId()) {
            throw new NoSuchEntityException(__('Category with id "%1" does not exist.', $categoryId));
        }
        return $category;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->categoryCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CategoryInterface $category)
    {
        try {
            $categoryModel = $this->categoryFactory->create();
            $this->resource->load($categoryModel, $category->getCategoryId());
            $this->resource->delete($categoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Category: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($categoryId)
    {
        return $this->delete($this->get($categoryId));
    }
}

