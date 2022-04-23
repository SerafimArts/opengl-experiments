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
use Phplrt\Source\File;

final class Fragment extends Source
{
    /**
     * @param ReadableInterface $source
     */
    public function __construct(ReadableInterface $source)
    {
        parent::__construct(Type::FRAGMENT, $source);
    }

    /**
     * @psalm-taint-sink file $file
     * @param non-empty-string $file
     * @return static
     */
    public static function fromPathname(string $file): static
    {
        return new self(File::fromPathname($file));
    }
}
