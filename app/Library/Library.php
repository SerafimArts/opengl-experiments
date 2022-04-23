<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Library;

use FFI\Env\Runtime;
use FFI\Location\Locator;
use FFI\Proxy\Proxy;

/**
 * @property-read \FFI|object $ffi
 */
abstract class Library extends Proxy
{
    /**
     * @psalm-taint-sink file $header
     * @param non-empty-string $header
     * @param array<non-empty-string> $libraries
     */
    public function __construct(string $header, array $libraries = [])
    {
        Runtime::assertAvailable();

        $binary = Locator::resolve(...$libraries)
            ?? throw new \LogicException(\sprintf(
                'Could not resolve binary pathname (%s)',
                \implode(', ', $libraries),
            ));

        parent::__construct(\FFI::cdef(\file_get_contents($header), $binary));
    }
}