<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Local\Env\Env;

if (!function_exists('env')) {
    /**
     * @param non-empty-string $name
     * @param mixed|null $default
     * @return mixed
     */
    function env(string $name, mixed $default = null): mixed
    {
        return Env::get($name, $default);
    }
}
