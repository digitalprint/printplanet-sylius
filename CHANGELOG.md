# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[unreleased]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.2.1-beta...master
[1.2.1-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.2.0-beta...v1.2.1-beta
[1.2.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.1.0-beta...v1.2.0-beta
[1.1.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.0.0-beta.1...v1.1.0-beta
[1.0.0-beta.1]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/compare/v1.0.0-beta...v1.0.0-beta.1
[1.0.0-beta]: https://gitlab.com/printplanet-team/pp-team/printplanet-sylius/-/tags/v1.0.0-beta
