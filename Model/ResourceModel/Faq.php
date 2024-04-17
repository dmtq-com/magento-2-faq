<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('dmtq_faq_faq', 'faq_id');
    }
}

