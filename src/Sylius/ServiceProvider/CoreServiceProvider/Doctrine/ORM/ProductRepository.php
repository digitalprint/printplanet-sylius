<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This file incorporates work covered by the following copyright and  
 * permission notice:
 * 
 *   This file is part of the Sylius package.
 *
 *   (c) Paweł Jędrzejewski
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Doctrine\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Core\Model\ChannelInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Core\Model\TaxonInterface;
use PrintPlanet\Sylius\Component\Core\Repository\ProductRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM\ProductRepository as BaseProductRepository;

class ProductRepository extends BaseProductRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManager $entityManager, Mapping\ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);
    }

    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(string $locale, $taxonId = null): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale);

        if (null !== $taxonId) {
            $queryBuilder
                ->innerJoin('o.productTaxons', 'productTaxon')
                ->andWhere('productTaxon.taxon = :taxonId')
                ->setParameter('taxonId', $taxonId);
        }

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function createShopListQueryBuilder(
        ChannelInterface $channel,
        TaxonInterface $taxon,
        string $locale,
        array $sorting = [],
        bool $includeAllDescendants = false
    ): QueryBuilder {
        $queryBuilder = $this->createQueryBuilder('o')
            ->distinct()
            ->addSelect('translation')
            ->addSelect('productTaxon')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->innerJoin('o.productTaxons', 'productTaxon');

        if ($includeAllDescendants) {
            $queryBuilder
                ->innerJoin('productTaxon.taxon', 'taxon')
                ->andWhere('taxon.left >= :taxonLeft')
                ->andWhere('taxon.right <= :taxonRight')
                ->andWhere('taxon.root = :taxonRoot')
                ->setParameter('taxonLeft', $taxon->getLeft())
                ->setParameter('taxonRight', $taxon->getRight())
                ->setParameter('taxonRoot', $taxon->getRoot());
        } else {
            $queryBuilder
                ->andWhere('productTaxon.taxon = :taxon')
                ->setParameter('taxon', $taxon);
        }

        $queryBuilder
            ->andWhere(':channel MEMBER OF o.channels')
            ->andWhere('o.enabled = true')
            ->setParameter('locale', $locale)
            ->setParameter('channel', $channel);

        // Grid hack, we do not need to join these if we don't sort by price
        if (isset($sorting['price'])) {
            // Another hack, the subquery to get the first position variant
            $subQuery = $this->createQueryBuilder('m')
                ->select('min(v.position)')
                ->innerJoin('m.variants', 'v')
                ->andWhere('m.id = :product_id');

            $queryBuilder
                ->addSelect('variant')
                ->addSelect('channelPricing')
                ->innerJoin('o.variants', 'variant')
                ->innerJoin('variant.channelPricings', 'channelPricing')
                ->andWhere('channelPricing.channelCode = :channelCode')
                ->andWhere(
                    $queryBuilder->expr()->in(
                        'variant.position',
                        str_replace(':product_id', 'o.id', $subQuery->getDQL())
                    )
                )
                ->setParameter('channelCode', $channel->getCode());
        }

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByCode(string $code): ?ProductInterface
    {
        return $this->createQueryBuilder('o')
            ->where('o.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
