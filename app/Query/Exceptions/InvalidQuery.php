<?php

namespace App\Query\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class InvalidQuery extends HttpException
{
}
