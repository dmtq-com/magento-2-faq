<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Block;

use Magento\Framework\Data\Collection;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use \DMTQ\FAQ\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;
use \DMTQ\FAQ\Model\ResourceModel\Category\CollectionFactory as FaqCategoryCollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;

class FAQ extends Template implements IdentityInterface
{
    /**
     * Cache tag value
     */
    public const CACHE_TAG = 'dmtq_faq_block';

    /**
     * @var FaqCollectionFactory
     */
    protected FaqCollectionFactory $_faqCollectionFactory;

    /**
     * @var FaqCategoryCollectionFactory
     */
    protected FaqCategoryCollectionFactory $_faqCategoryCollectionFactory;

    /**
     * @var FilterProvider
     */
    private FilterProvider $_filterProvider;

    /**
     * @param Context $context
     * @param FaqCollectionFactory $faqCollectionFactory
     * @param FaqCategoryCollectionFactory $faqCategoryCollectionFactory
     * @param FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Context                      $context,
        FaqCollectionFactory         $faqCollectionFactory,
        FaqCategoryCollectionFactory $faqCategoryCollectionFactory,
        FilterProvider               $filterProvider,
        array                        $data = []
    )
    {
        $this->_faqCollectionFactory = $faqCollectionFactory;
        $this->_faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context, $data);
        $this->setTabTitle();
    }

    /**
     * @return mixed
     */
    public function getCategories(): mixed
    {
        $collection = $this->_faqCategoryCollectionFactory->create();
        $collection->addFieldToFilter('is_active', true);
        $collection->addOrder('position', 'ASC');
        $collection->addOrder('category_id', 'DESC');
        return $collection;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getFaqs(): mixed
    {
        $collection = $this->_faqCollectionFactory->create();
        $collection->addFieldToFilter('is_active', true);
        $collection->addOrder('position', 'ASC');
        $collection->addOrder('faq_id', 'DESC');
        return $this->map($collection, function ($item) {
            return $this->_filterProvider->getPageFilter()->filter($item->getContent());
        });
    }

    /**
     * Apply callback function to each item in the collection
     *
     * @param Collection $collection
     * @param callable $callback
     * @return Collection
     */
    public function map(Collection $collection, callable $callback): Collection
    {
        foreach ($collection as $item) {
            $item->setContent($callback($item));
        }
        return $collection;
    }

    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle(): void
    {
        $this->setTitle(__('FAQ'));
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG];
    }

}

