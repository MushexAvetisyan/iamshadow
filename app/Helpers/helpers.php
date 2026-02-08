<?php

use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;


/**
 * @param string $type
 * @return int
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
function m_per_page($type = 'per_page'): int
{
    if (session()->has($type)) {
        return session()->get($type);
    }

    return $perPage = 8;
}


