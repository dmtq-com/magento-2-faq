<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use DMTQ\FAQ\Api\Data\FaqInterface;
use DMTQ\FAQ\Api\Data\FaqInterfaceFactory;
use DMTQ\FAQ\Api\Data\FaqSearchResultsInterfaceFactory;
use DMTQ\FAQ\Api\FaqRepositoryInterface;
use DMTQ\FAQ\Model\ResourceModel\Faq as ResourceFaq;
use DMTQ\FAQ\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;

class FaqRepository implements FaqRepositoryInterface
{

    /**
     * @var ResourceFaq
     */
    protected $resource;

    /**
     * @var FaqInterfaceFactory
     */
    protected $faqFactory;

    /**
     * @var FaqCollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var Faq
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceFaq $resource
     * @param FaqInterfaceFactory $faqFactory
     * @param FaqCollectionFactory $faqCollectionFactory
     * @param FaqSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceFaq $resource,
        FaqInterfaceFactory $faqFactory,
        FaqCollectionFactory $faqCollectionFactory,
        FaqSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->faqFactory = $faqFactory;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(FaqInterface $faq)
    {
        try {
            $this->resource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the faq: %1',
                $exception->getMessage()
            ));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function get($faqId)
    {
        $faq = $this->faqFactory->create();
        $this->resource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Faq with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->faqCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(FaqInterface $faq)
    {
        try {
            $faqModel = $this->faqFactory->create();
            $this->resource->load($faqModel, $faq->getFaqId());
            $this->resource->delete($faqModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Faq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($faqId)
    {
        return $this->delete($this->get($faqId));
    }
}

