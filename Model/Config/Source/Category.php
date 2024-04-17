<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DMTQ\FAQ\Model\Config\Source;

use DMTQ\FAQ\Model\ResourceModel\Category\CollectionFactory;

/**
 * Class Page
 */
class Category implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $collections = $this->collectionFactory->create();
            foreach ($collections as $item) {
                $this->options[] = [
                    'value' => $item->getId(),
                    'label' => $item->getName()
                ];
            }
        }
        return $this->options;
    }
}
