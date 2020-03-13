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

namespace PrintPlanet\Sylius\Component\Resource\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;

interface RepositoryInterface extends ObjectRepository
{
    public const ORDER_ASCENDING = 'ASC';
    public const ORDER_DESCENDING = 'DESC';

    public function createPaginator(array $criteria = [], array $sorting = []): iterable;

    public function add(ResourceInterface $resource): void;

    public function remove(ResourceInterface $resource): void;
}
