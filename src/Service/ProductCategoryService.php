<?php

namespace App\Service;

use App\Entity\ProductCategory;
use App\Model\ProductCategory as ProductCategoryModel;
use App\Model\ProductCategoryListResponse;
use App\Repository\ProductCategoryRepository;

class ProductCategoryService
{
    public function __construct(private ProductCategoryRepository $productCategoryRepository)
    {
    }

    public function getCategories(): ProductCategoryListResponse
    {
        $categories = $this->productCategoryRepository->findAllSortedByTitle();
        $items = array_map(
            fn (ProductCategory $productCategory) => new ProductCategoryModel(
                $productCategory->getId(), $productCategory->getTitle(), $productCategory->getSlug()
            ),
            $categories
        );

        return new ProductCategoryListResponse($items);
    }
}
