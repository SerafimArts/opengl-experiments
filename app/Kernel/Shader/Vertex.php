<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Kernel\Shader;

use App\Kernel\Shader;

final class Vertex extends Shader
{
    /**
     * @param string $source
     */
    public function __construct(string $source)
    {
        parent::__construct(Type::VERTEX, $source);
    }

    /**
     * {@inheritDoc}
     */
    public static function fromPathname(string $file): static
    {
        return new self(\file_get_contents($file));
    }
}