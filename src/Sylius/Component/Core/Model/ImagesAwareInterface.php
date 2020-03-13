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

interface ImagesAwareInterface
{
    /**
     * @return Collection|ImageInterface[]
     */
    public function getImages(): Collection;

    /**
     * @param string $type
     *
     * @return Collection|ImageInterface[]
     */
    public function getImagesByType(string $type): Collection;

    public function hasImages(): bool;

    public function hasImage(ImageInterface $image): bool;

    public function addImage(ImageInterface $image): void;

    public function removeImage(ImageInterface $image): void;
}
