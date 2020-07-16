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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Templating\Helper;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Core\Model\ImageInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductImageInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;
use Symfony\Component\Templating\Helper\Helper;

class ProductVariantImagesHelper extends Helper
{
    /**
     * Returns Product Variant Images and if there are none, Product
     * Images, sorted or filtered by type.
     * Multiple Types can be used to sort filter images accordingly.
     * Each type can be a regular expression.
     * If the sort option is used then the images for which the types
     * were not matched, come at the end of the Collection.
     *
     * ⚠️ Warning: This method returns a Collection disassociated from the
     * ProductVariant; this means it can be used as read only.
     *
     * ⚠️ Warning: This method assumes that there is a unique image type
     * for each image. If non unique image types are used, then it will
     * result to missing images.
     *
     * @param ProductVariantInterface $productVariant
     * @param bool $filter Whether to filter the results or just sort them.
     * @param string ...$types Regex to filter/sort Image types.
     * @return Collection
     */
    public function getImages(ProductVariantInterface $productVariant, bool $filter, string ...$types): Collection
    {
        $result = new ArrayCollection();

        $images = $productVariant->getImages();

        if (0 === $images->count()) {
            $images = $productVariant->getProduct()->getImages();
        }

        $imageTypes = $images->map(static function (ProductImageInterface $image) {
            return $image->getType();
        });

        $imageTypes = $this->pregMatchAndSort($imageTypes->toArray(), $filter, ... $types);

        foreach ($imageTypes as $imageType) {
            $result->add(
                $images->filter(static function(ImageInterface $image) use ($imageType) {
                    return $image->getType() === $imageType;
                })->first()
            );
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'sylius_sort_images';
    }

    /**
     * Sorts $haystack based on $needles.
     *
     * @param array $haystack
     * @param bool $filter Whether to filter the results or just sort them.
     * @param string ...$needles Regex to match against $haystack.
     * @return array
     */
    protected function pregMatchAndSort(array $haystack, bool $filter, string ...$needles): array
    {
        $result = [];

        natsort($haystack);

        foreach ($needles as $type) {

            $tmp = array_filter($haystack, static function ($value) use ($type) {
                return null !== $value && 1 === preg_match("/{$type}/", $value);
            });

            $result += $tmp;
        }

        if (!$filter) {
            $result += array_diff($haystack, $result);
        }

        return $result;
    }
}
