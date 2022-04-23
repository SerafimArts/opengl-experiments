<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Kernel;

use App\Kernel\Shader\Type;

abstract class Shader
{
    /**
     * @param Type $type
     * @param string $source
     */
    public function __construct(
        public readonly Type $type,
        public readonly string $source,
    ) {
    }

    /**
     * @psalm-taint-sink file $file
     * @param non-empty-string $file
     * @return static
     */
    abstract public static function fromPathname(string $file): static;
}