<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqRepositoryInterface
{

    /**
     * Save Faq
     * @param \DMTQ\FAQ\Api\Data\FaqInterface $faq
     * @return \DMTQ\FAQ\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\DMTQ\FAQ\Api\Data\FaqInterface $faq);

    /**
     * Retrieve Faq
     * @param string $faqId
     * @return \DMTQ\FAQ\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($faqId);

    /**
     * Retrieve Faq matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DMTQ\FAQ\Api\Data\FaqSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Faq
     * @param \DMTQ\FAQ\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\DMTQ\FAQ\Api\Data\FaqInterface $faq);

    /**
     * Delete Faq by ID
     * @param string $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}

