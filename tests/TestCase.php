<?php
namespace Henrotaym\LaravelTrustupMediaIo\Tests;

use Henrotaym\LaravelTrustupMediaIo\Package;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;
use Deegitalbe\ServerAuthorization\Providers\ServerAuthorizationServiceProvider;
use Henrotaym\LaravelApiClient\Providers\ClientServiceProvider;
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
            ServerAuthorizationServiceProvider::class,
            ClientServiceProvider::class,
            LaravelTrustupMediaIoServiceProvider::class
        ];
    }
}