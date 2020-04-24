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

namespace PrintPlanet\Sylius\ServiceProvider\TaxonomyServiceProvider\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonInterface;
use PrintPlanet\Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class TaxonRepository extends EntityRepository implements TaxonRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findChildren(string $parentCode, ?string $locale = null, ?int $flag = self::TAXON_FILTER_TYPE_ALL): array
    {
        $queryBuilder = $this->createTranslationBasedQueryBuilder($locale)
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('parent.code = :parentCode')
            ->setParameter('parentCode', $parentCode)
            ->addOrderBy('o.position');

        if (self::TAXON_FILTER_TYPE_MENU & $flag) {
            $queryBuilder
                ->andWhere('translation.visibleInMenu = :visibleInMenu')
                ->setParameter('visibleInMenu', true);
        }

        if (self::TAXON_FILTER_TYPE_SITEMAP & $flag) {
            $queryBuilder
                ->andWhere('translation.visibleInSitemap = :visibleInSitemap')
                ->setParameter('visibleInSitemap', true);
        }

        if (self::TAXON_FILTER_TYPE_ACTIVE & $flag) {
            $queryBuilder
                ->andWhere('translation.visibleInSitemap = :active')
                ->setParameter('active', true);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySlug(string $slug, string $locale): ?TaxonInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.slug = :slug')
            ->andWhere('translation.locale = :locale')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findRootNodes(): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.parent IS NULL')
            ->addOrderBy('o.position')
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByLocale(?string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')->leftJoin('o.translations', 'translation');
    }

    private function createTranslationBasedQueryBuilder(?string $locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation');

        if (null !== $locale) {
            $queryBuilder
                ->andWhere('translation.locale = :locale')
                ->setParameter('locale', $locale);
        }

        return $queryBuilder;
    }
}
