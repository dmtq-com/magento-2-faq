<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Model;

use Magento\Framework\Model\AbstractModel;
use DMTQ\FAQ\Api\Data\FaqInterface;

class Faq extends AbstractModel implements FaqInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\DMTQ\FAQ\Model\ResourceModel\Faq::class);
    }

    /**
     * @inheritDoc
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}

