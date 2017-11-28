<?php

/*
 * This file is part of the Symfony package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Exception;

/**
 * The HTTP request contains headers with conflicting information.
 */
class ConflictingHeadersException extends \UnexpectedValueException implements RequestExceptionInterface
{
}