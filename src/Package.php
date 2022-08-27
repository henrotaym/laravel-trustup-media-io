<?php
namespace Henrotaym\LaravelTrustupMediaIo;

use Henrotaym\LaravelTrustupMediaIo\Contracts\PackageContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;

class Package extends VersionablePackage implements PackageContract
{
    public static function prefix(): string
    {
        return "versioning_package_template";
    }
}