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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Doctrine;

use Doctrine\ORM\EntityRepository;
use PP\Exception\ClassNotFoundException;

class RepositoryFactory
{
    /**
     * @param string $repositoryClassName  class name of the Repository to be created
     * @param string $classNameForMetadata class name for the Class Metadata to be injected in the Repository
     *
     * @return EntityRepository
     *
     * @throws ClassNotFoundException
     * @throws \Exception
     */
    public static function create(string $repositoryClassName, string $classNameForMetadata): EntityRepository
    {
        if (! class_exists($repositoryClassName)) {
            throw new ClassNotFoundException(null, 0, null, $repositoryClassName);
        }

        if (! class_exists($classNameForMetadata)) {
            throw new ClassNotFoundException(null, 0, null, $classNameForMetadata);
        }

        $em = \PP_Db::getEntityManager();
        $metadata = $em->getClassMetadata($classNameForMetadata);

        return new $repositoryClassName($em, $metadata);
    }
}
