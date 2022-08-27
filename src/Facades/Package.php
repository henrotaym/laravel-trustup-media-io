<?php
namespace Henrotaym\LaravelTrustupMediaIo\Facades;

use Henrotaym\LaravelTrustupMediaIo\Package as Underlying;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

class Package extends VersionablePackageFacade
{
    public static function getPackageClass(): string
    {
        return Underlying::class;
    }
}