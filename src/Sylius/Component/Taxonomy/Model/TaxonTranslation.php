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

use PrintPlanet\Sylius\Component\Resource\Model\AbstractTranslation;
use PrintPlanet\Sylius\Component\Core\Model\TaxonInterface;

class TaxonTranslation extends AbstractTranslation implements TaxonTranslationInterface
{
    /** @var mixed */
    protected $id;

    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $slug;

    /** @var string|null */
    protected $description;

    /** @var TaxonInterface */
    protected $taxon;

    /** @var string|null */
    protected $layout;

    /** @var string|null */
    protected $url;

    /** @var bool */
    protected $visibleInSiteMap;

    /** @var bool */
    protected $visibleInMenu;

    public function __toString(): string
    {
        return (string) $this->getName();
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return TaxonViewLayout|null
     */
    public function getViewLayout(): ?TaxonViewLayout
    {
        return TaxonViewLayout::fromJson($this->layout);
    }

    /**
     * @param TaxonViewLayout|null $layout
     */
    public function setLayout(?TaxonViewLayout $layout): void
    {
        $this->layout = $layout ? json_encode($layout) : null;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isVisibleInSiteMap(): bool
    {
        return $this->visibleInSiteMap;
    }

    /**
     * @param bool $visibleInSiteMap
     */
    public function setVisibleInSiteMap(bool $visibleInSiteMap): void
    {
        $this->visibleInSiteMap = $visibleInSiteMap;
    }

    /**
     * @return bool
     */
    public function isVisibleInMenu(): bool
    {
        return $this->visibleInMenu;
    }

    /**
     * @param bool $visibleInMenu
     */
    public function setVisibleInMenu(bool $visibleInMenu): void
    {
        $this->visibleInMenu = $visibleInMenu;
    }
}
