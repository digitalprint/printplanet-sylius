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

namespace PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM;

use PrintPlanet\Sylius\Component\Product\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Product\Repository\ProductRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name = :name')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, string $locale, ?int $limit = null): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $slug
     * @param string $locale
     * @return ProductInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySlug(string $slug, string $locale): ?ProductInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.slug = :slug')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
