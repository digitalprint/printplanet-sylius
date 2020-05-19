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

namespace PrintPlanet\Sylius\Component\Taxonomy\Model;

use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\SlugAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface TaxonTranslationInterface extends SlugAwareInterface, ResourceInterface, TranslationInterface, TaxonTranslationExtendedInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    /**
     * @deprecated this method is also defined in \PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonTranslationExtendedInterface::getViewLayout
     */
    public function getViewLayout(): ?TaxonViewLayout;

    /**
     * @deprecated this method is also defined in \PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonTranslationExtendedInterface::setLayout
     */
    public function setLayout(?TaxonViewLayout $layout): void;
}
