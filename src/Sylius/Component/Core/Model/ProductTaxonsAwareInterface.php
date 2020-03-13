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

namespace PrintPlanet\Sylius\Component\Core\Model;

use Doctrine\Common\Collections\Collection;

interface ProductTaxonsAwareInterface
{
    /**
     * @return Collection|ProductTaxonInterface[]
     */
    public function getProductTaxons(): Collection;

    public function hasProductTaxon(ProductTaxonInterface $productTaxon): bool;

    public function addProductTaxon(ProductTaxonInterface $productTaxon): void;

    public function removeProductTaxon(ProductTaxonInterface $productTaxon): void;

    /**
     * @return Collection|TaxonInterface[]
     */
    public function getTaxons(): Collection;

    public function hasTaxon(TaxonInterface $taxon): bool;
}
