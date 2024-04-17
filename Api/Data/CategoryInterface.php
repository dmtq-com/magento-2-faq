<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DMTQ\FAQ\Api\Data;

interface CategoryInterface
{

    const NAME = 'name';
    const CATEGORY_ID = 'category_id';

    /**
     * Get category_id
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category_id
     * @param string $categoryId
     * @return \DMTQ\FAQ\Category\Api\Data\CategoryInterface
     */
    public function setCategoryId($categoryId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \DMTQ\FAQ\Category\Api\Data\CategoryInterface
     */
    public function setName($name);
}

