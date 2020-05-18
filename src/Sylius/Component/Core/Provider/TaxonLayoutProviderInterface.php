<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PrintPlanet\Sylius\Component\Core\Provider;

use PrintPlanet\Sylius\Component\Core\Model\TaxonInterface;
use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonViewLayout;

interface TaxonLayoutProviderInterface
{
    public static function getViewLayout(TaxonInterface $taxon): ?TaxonViewLayout;
}
