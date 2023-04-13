<?php

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Product\Repository;

use PrintPlanet\Sylius\Component\Product\Model\ProductVariantAssociationTypeInterface;
use PrintPlanet\Sylius\Component\Resource\Repository\RepositoryInterface;

interface ProductVariantAssociationTypeRepositoryInterface extends RepositoryInterface
{
    public function findOneByCode(string $code): ?ProductVariantAssociationTypeInterface;
}
