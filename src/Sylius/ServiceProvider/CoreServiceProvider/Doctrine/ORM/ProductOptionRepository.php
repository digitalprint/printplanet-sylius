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
use PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM\ProductOptionRepository as BaseProductOptionRepository;

class ProductOptionRepository extends BaseProductOptionRepository
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
    public function findAll(): array
    {
        $productOptions = parent::findAll();

        return $productOptions;
    }
}
