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

namespace PrintPlanet\Sylius\Component\Taxonomy\Repository;

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Resource\Repository\RepositoryInterface;
use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonInterface;

interface TaxonRepositoryInterface extends RepositoryInterface
{
    public const TAXON_FILTER_TYPE_ALL = 0;

    public const TAXON_FILTER_TYPE_MENU = 1;

    public const TAXON_FILTER_TYPE_SITEMAP = 2;

    /**
     * @param string      $parentCode
     * @param string|null $locale
     * @param int|null    $flag
     *
     * @return array|TaxonInterface[]
     */
    public function findChildren(string $parentCode, ?string $locale = null, ?int $flag = 0): array;

    /**
     * @return array|TaxonInterface[]
     */
    public function findRootNodes(): array;

    public function findOneBySlug(string $slug, string $locale): ?TaxonInterface;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|TaxonInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $locale
     *
     * @return array|TaxonInterface[]
     */
    public function findAllByLocale(string $locale): array;

    /**
     * @param string      $phrase
     * @param string|null $locale
     *
     * @return array|TaxonInterface[]
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array;

    public function createListQueryBuilder(): QueryBuilder;
}
