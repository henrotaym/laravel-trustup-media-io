<?php
namespace Henrotaym\LaravelTrustupMediaIo\Credentials\Media;

use Henrotaym\LaravelTrustupMediaIo\Facades\Package;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\ServerAuthorization\Credential\AuthorizedServerCredential;

class MediaCredential extends AuthorizedServerCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $request->setBaseUrl(Package::getConfig('media_url') . 'api/media');
    }
}