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

namespace PrintPlanet\Sylius\Component\Core\Provider;

use PrintPlanet\Sylius\Component\Core\Model\TaxonInterface;
use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonViewLayout;

class TaxonLayoutProvider
{
    public static function getViewLayout(TaxonInterface $taxon): ?TaxonViewLayout
    {
        return $taxon->getTranslation()->getViewLayout() ?? static::getViewLayout($taxon->getParent());
    }
}
