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

use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;

interface ProductTaxonInterface extends ResourceInterface
{
    public function getProduct(): ?ProductInterface;

    public function setProduct(?ProductInterface $product): void;

    public function getTaxon(): ?TaxonInterface;

    public function setTaxon(?TaxonInterface $taxon): void;

    public function getPosition(): ?int;

    public function setPosition(?int $position): void;
}
