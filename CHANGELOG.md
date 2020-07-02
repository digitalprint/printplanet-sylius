# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.5.0-beta] - 2020-07-02

### Added

- Feature #17 Add Meta Title field to Product Translation. See merge request !17.

## [1.4.0-beta] - 2020-05-19

### Added

- Feature #12 Add extended Interfaces to existing interfaces to represent missing PrintPlanet features.
  See merge request !14.
- Feature #15 Remove active property from product variant but use an attribute instead.
  See merge request !15.

## [1.3.4-beta] - 2020-05-06

### Fixed

- Fix !13 `ProductAndAttributeBasedProductVariantResolver` to handle array type attribute values.

## [1.3.3-beta] - 2020-04-29

### Fixed

- Fix Typo `visibleInSiteMap` & wrong `active` field in `TaxonRepository`.

## [1.3.2-beta] - 2020-04-27

### Fixed

- Fix !12 TaxonViewLayout, data parameter can't be null.

## [1.3.1-beta] - 2020-04-27

### Fixed

- Fix !11 TaxonViewLayout::fromJson() error when parameter $layout null is.

## [1.3.0-beta] - 2020-04-24

### Added

- Feature #11 add ProductAndAttributeBasedProductVariantResolver & Tests.
- Feature #10 Add boolean `Active` field in `TaxonTranslation`.
    - Active Field in `TaxonTranslation`.
    - Getter & Setter in the `Taxon` for easier usage.
    - constant `TAXON_FILTER_TYPE_ACTIVE` in the `TaxonRepositoryInterface`.
    - filter by active in `TaxonRepository::findChildren()`.
    - active field in ORM XML Mapping.

### Changed

- Support bitmask at `TaxonRepository::findChildren() $flag` parameter (156a721d). 
- Remove unnecessary duplicate `"doctrine/orm": "^2.5",` in `"require-dev"` in `composer.json` files (abf3fe36).
- Remove unnecessary bin-dir from component `composer.json` (ed0f5411).
- Add default value to `$visibleInSiteMap` & `$visibleInMenu` in TaxonTranslation (d4eb2538).

### Fixed

- Require `ext-json` in composer.json (367a5a47)

## [1.2.1-beta] - 2020-04-21

### Changed

- composer.json to support `symfony/templating` ^v2.7
- CHANGELOG added missing feature to v1.0.0-beta.1

## [1.2.0-beta] - 2020-04-21

### Added

- feature #9 ShopperContext
    - Channel/Context
        - ChannelContextInterface
        - ChannelNotFoundException
    - Core/Context
        - ShopperContext
        - ShopperContextInterface
    - Currency/Context
        - CurrencyContextInterface
        - CurrencyNotFoundException
    - Customer/Context
        - CustomerContextInterface
    - Customer/Model
        - Customer
        - CustomerAwareInterface
        - CustomerGroupInterface
        - CustomerInterface
    - Locale/Context
        - LocaleContextInterface
        - LocaleNotFoundException

## [1.1.0-beta] - 2020-04-20

### Added

- feature #6 PriceHelper & ProductVariantsPricesHelper to get easier product variant prices
- `symfony/templating` dependency in composer.json.

### Changed

- Composer.json remove duplicate entry in require-dev of `doctrine/orm`.

### Fixed

- Typo in CHANGELOG.

## [1.0.0-beta.1] - 2020-04-20

### Added

- feature #7 Add findOneByUrl() in TaxonRepository

### Fixed

- Fix #8 Check if addXmlMappingPath is set before checking if it's callable.

## [1.0.0-beta] - 2020-04-16

### Added

- All the necessary files to connect to the PrintPlanet Sylius tables and map its entities.
- The changelog.

[unreleased]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.5.0-beta...master
[1.5.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.4.0-beta...v1.5.0-beta
[1.4.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.3.4-beta...v1.4.0-beta
[1.3.4-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.3.3-beta...v1.3.4-beta
[1.3.3-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.3.2-beta...v1.3.3-beta
[1.3.2-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.3.1-beta...v1.3.2-beta
[1.3.1-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.3.0-beta...v1.3.1-beta
[1.3.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.2.1-beta...v1.3.0-beta
[1.2.1-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.2.0-beta...v1.2.1-beta
[1.2.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.1.0-beta...v1.2.0-beta
[1.1.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.0.0-beta.1...v1.1.0-beta
[1.0.0-beta.1]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.0.0-beta...v1.0.0-beta.1
[1.0.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/tags/v1.0.0-beta
