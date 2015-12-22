<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Price\Persistence;

use Generated\Shared\Transfer\PriceProductTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;
use Orm\Zed\Price\Persistence\Map\SpyPriceTypeTableMap;
use Orm\Zed\Price\Persistence\SpyPriceProductQuery;
use Orm\Zed\Price\Persistence\SpyPriceType;
use Orm\Zed\Price\Persistence\SpyPriceTypeQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Exception\PropelException;

class PriceQueryContainer extends AbstractQueryContainer
{

    const DATE_NOW = 'now';

    /**
     * @param string $name
     *
     * @return SpyPriceTypeQuery
     */
    public function queryPriceType($name)
    {
        return SpyPriceTypeQuery::create()->filterByName($name);
    }

    /**
     * @return SpyPriceTypeQuery
     */
    public function queryAllPriceTypes()
    {
        return SpyPriceTypeQuery::create();
    }

    /**
     * @param string $sku
     * @param SpyPriceType $priceType
     *
     * @throws PropelException
     *
     * @return Propel\SpyPriceProductQuery
     */
    public function queryPriceEntityForAbstractProduct($sku, SpyPriceType $priceType)
    {
        return SpyPriceProductQuery::create()
            ->filterByPriceType($priceType)
            ->useSpyProductAbstractQuery()
            ->filterBySku($sku)
            ->endUse();
    }

    /**
     * @param string $sku
     * @param SpyPriceType $priceType
     *
     * @throws PropelException
     *
     * @return Propel\SpyPriceProductQuery
     */
    public function queryPriceEntityForConcreteProduct($sku, SpyPriceType $priceType)
    {
        return SpyPriceProductQuery::create()
            ->filterByPriceType($priceType)
            ->useProductQuery()
            ->filterBySku($sku)
            ->endUse();
    }

    /**
     * @param SpyPriceProductQuery $query
     * @param int $idPriceProduct
     *
     * @return SpyPriceProductQuery
     */
    public function addFilter($query, $idPriceProduct)
    {
        return $query->filterByIdPriceProduct($idPriceProduct, Criteria::NOT_EQUAL);
    }

    /**
     * @param PriceProductTransfer $transferPriceProduct
     * @param SpyPriceType $priceType
     *
     * @throws PropelException
     *
     * @return Propel\SpyPriceProductQuery
     */
    public function querySpecificPriceForAbstractProduct(PriceProductTransfer $transferPriceProduct, SpyPriceType $priceType)
    {
        return SpyPriceProductQuery::create()
            ->filterByPrice($transferPriceProduct->getPrice())
            ->filterByPriceType($priceType)
            ->useSpyProductAbstractQuery()
            ->filterBySku($transferPriceProduct->getSkuProduct())
            ->endUse();
    }

    /**
     * @param PriceProductTransfer $transferPriceProduct
     * @param SpyPriceType $priceType
     *
     * @throws PropelException
     *
     * @return SpyPriceProductQuery
     */
    public function querySpecificPriceForConcreteProduct(PriceProductTransfer $transferPriceProduct, SpyPriceType $priceType)
    {
        return SpyPriceProductQuery::create()
            ->filterByPrice($transferPriceProduct->getPrice())
            ->filterByPriceType($priceType)
            ->useProductQuery()
            ->filterBySku($transferPriceProduct->getSkuProduct())
            ->endUse();
    }

    /**
     * @param int $idPriceProduct
     *
     * @return SpyPriceProductQuery
     */
    public function queryPriceProductEntity($idPriceProduct)
    {
        return SpyPriceProductQuery::create()
            ->filterByIdPriceProduct($idPriceProduct);
    }

    /**
     * @return SpyPriceProductQuery
     */
    public function queryPriceGrid()
    {
        return SpyPriceProductQuery::create()
            ->joinProduct()
            ->withColumn(SpyProductTableMap::COL_SKU, 'sku_product_concrete')
            ->joinSpyProductAbstract()
            ->withColumn(SpyProductAbstractTableMap::COL_SKU, 'sku_product_abstract')
            ->joinPriceType()
            ->withColumn(SpyPriceTypeTableMap::COL_NAME, 'price_type_name');
    }

    /**
     * @return SpyPriceTypeQuery
     */
    public function queryPriceTypeGrid()
    {
        return SpyPriceTypeQuery::create()
            ->withColumn(SpyPriceTypeTableMap::COL_NAME, 'name');
    }

    /**
     * @throws PropelException
     *
     * @return ModelCriteria
     */
    public function queryPriceTypeForm()
    {
        return SpyPriceTypeQuery::create()
            ->select([
                SpyPriceTypeTableMap::COL_NAME => 'value',
                SpyPriceTypeTableMap::COL_NAME => 'label',
            ])
            ->withColumn(SpyPriceTypeTableMap::COL_NAME, 'value')
            ->withColumn(SpyPriceTypeTableMap::COL_NAME, 'label');
    }

}