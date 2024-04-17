<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'faq_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \DMTQ\FAQ\Model\Faq::class,
            \DMTQ\FAQ\Model\ResourceModel\Faq::class
        );
    }
}

