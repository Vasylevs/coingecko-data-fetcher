<?php

declare(strict_types=1);

namespace Bot\Factory;

use Bot\DTO\ApiConfigDto;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiConfigFactory
{
    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function create(): ApiConfigDto
    {
        $configArray = $this->container->getParameter(ApiConfigDto::API_CONFIG_KAY);

        if (empty($configArray)) {
            throw new \InvalidArgumentException('Api config can`t be empty');
        }

        return new ApiConfigDto(
            baseUri: $configArray[ApiConfigDto::BASE_URI_KAY],
            apiKay: !empty($configArray[ApiConfigDto::API_REQUEST_KAY])
                ? $configArray[ApiConfigDto::API_REQUEST_KAY]
                : null
        );
    }
}
