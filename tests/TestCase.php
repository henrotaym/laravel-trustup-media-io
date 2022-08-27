<?php
namespace Henrotaym\LaravelTrustupMediaIo\Tests;

use Henrotaym\LaravelTrustupMediaIo\Package;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;
use Henrotaym\LaravelTrustupMediaIo\Providers\LaravelTrustupMediaIoServiceProvider;

class TestCase extends VersionablePackageTestCase
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }
    
    public function getServiceProviders(): array
    {
        return [
            LaravelTrustupMediaIoServiceProvider::class
        ];
    }
}