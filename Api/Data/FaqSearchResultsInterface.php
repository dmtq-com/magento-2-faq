<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api\Data;

interface FaqSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Faq list.
     * @return \DMTQ\FAQ\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * Set content list.
     * @param \DMTQ\FAQ\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

