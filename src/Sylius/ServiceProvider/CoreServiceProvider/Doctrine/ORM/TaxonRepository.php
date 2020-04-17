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

use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonInterface;
use PrintPlanet\Sylius\ServiceProvider\TaxonomyServiceProvider\Doctrine\ORM\TaxonRepository as BaseTaxonRepository;

class TaxonRepository extends BaseTaxonRepository
{
    /**
     * @param string $url
     * @param string $locale
     * @return TaxonInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUrl(string $url, string $locale): ?TaxonInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.url = :url')
            ->andWhere('translation.locale = :locale')
            ->setParameter('url', $url)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
