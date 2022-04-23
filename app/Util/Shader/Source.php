<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Util\Shader;

use Phplrt\Contracts\Source\ReadableInterface;

class Source
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
