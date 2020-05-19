<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Taxonomy\Model;

use PrintPlanet\Sylius\Component\Resource\Model\UrlAwareInterface;

interface TaxonTranslationExtendedInterface extends UrlAwareInterface
{
    public function getViewLayout(): ?TaxonViewLayout;

    public function setLayout(?TaxonViewLayout $layout): void;

    public function isActive(): bool;

    public function setActive(bool $active): void;

    public function isVisibleInSiteMap(): bool;

    public function setVisibleInSiteMap(bool $visibleInSiteMap): void;

    public function isVisibleInMenu(): bool;

    public function setVisibleInMenu(bool $visibleInMenu): void;
}
