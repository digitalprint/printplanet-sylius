<?php

namespace PrintPlanet\Sylius\Component\Product\Model;

use DateTime;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableTrait;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableTrait;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

class ProductVariantAssociationType implements ProductVariantAssociationTypeInterface
{
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

    /** @var mixed */
    protected $id;

    /** @var string|null */
    protected $code;

    /** @var string|null */
    protected $name;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->createdAt = new DateTime();

        $this->updatedAt = new DateTime();
    }

    public function __toString(): string
    {
        return (string)$this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * @return ProductVariantAssociationTypeTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var ProductVariantAssociationTypeTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): ProductVariantAssociationTypeTranslationInterface
    {
        return new ProductVariantAssociationTypeTranslation();
    }
}
