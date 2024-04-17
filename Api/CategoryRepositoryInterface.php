<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryRepositoryInterface
{

    /**
     * Save Category
     * @param \DMTQ\FAQ\Api\Data\CategoryInterface $category
     * @return \DMTQ\FAQ\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \DMTQ\FAQ\Api\Data\CategoryInterface $category
    );

    /**
     * Retrieve Category
     * @param string $categoryId
     * @return \DMTQ\FAQ\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($categoryId);

    /**
     * Retrieve Category matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DMTQ\FAQ\Api\Data\CategorySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Category
     * @param \DMTQ\FAQ\Api\Data\CategoryInterface $category
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \DMTQ\FAQ\Api\Data\CategoryInterface $category
    );

    /**
     * Delete Category by ID
     * @param string $categoryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($categoryId);
}

