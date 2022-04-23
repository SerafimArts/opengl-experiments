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
use Phplrt\Contracts\Source\ReadableInterface;

class Shader
{
    /**
     * @param Type $type
     * @param ReadableInterface $source
     */
    public function __construct(
        public readonly Type $type,
        public readonly ReadableInterface $source,
    ) {
    }
}
