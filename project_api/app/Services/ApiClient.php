<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 13:14
 */

namespace App\Services;

use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use Http\Message\UriFactory;

class ApiClient
{
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * @var UriFactory
     */
    private $uriFactory;

    public function __construct(
        RequestFactory $requestFactory,
        StreamFactory $streamFactory,
        UriFactory $uriFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->uriFactory = $uriFactory;
    }
}