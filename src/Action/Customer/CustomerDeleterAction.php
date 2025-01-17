<?php

namespace App\Action\Customer;

use App\Domain\Customer\Service\CustomerDeleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CustomerDeleterAction
{
    private CustomerDeleter $companyDeleter;

    private JsonRenderer $renderer;

    public function __construct(CustomerDeleter $customerDeleter, JsonRenderer $renderer)
    {
        $this->companyDeleter = $customerDeleter;
        $this->renderer = $renderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $customerId = (int)$args['customer_id'];

        // Invoke the domain (service class)
        $this->companyDeleter->deleteCustomer($customerId);

        // Render the json response
        return $this->renderer->json($response);
    }
}
