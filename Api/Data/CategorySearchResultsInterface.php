<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api\Data;

interface CategorySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Category list.
     * @return \DMTQ\FAQ\Api\Data\CategoryInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \DMTQ\FAQ\Api\Data\CategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

