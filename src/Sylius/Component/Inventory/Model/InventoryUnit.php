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

namespace PrintPlanet\Sylius\Component\Inventory\Model;

class InventoryUnit implements InventoryUnitInterface
{
    /** @var mixed */
    protected $id;

    /** @var StockableInterface */
    protected $stockable;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getStockable(): ?StockableInterface
    {
        return $this->stockable;
    }

    public function setStockable(StockableInterface $stockable): void
    {
        $this->stockable = $stockable;
    }
}
