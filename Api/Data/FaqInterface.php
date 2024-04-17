<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api\Data;

interface FaqInterface
{

    const CONTENT = 'content';
    const FAQ_ID = 'faq_id';

    /**
     * Get faq_id
     * @return string|null
     */
    public function getFaqId();

    /**
     * Set faq_id
     * @param string $faqId
     * @return \DMTQ\FAQ\Faq\Api\Data\FaqInterface
     */
    public function setFaqId($faqId);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \DMTQ\FAQ\Faq\Api\Data\FaqInterface
     */
    public function setContent($content);
}

