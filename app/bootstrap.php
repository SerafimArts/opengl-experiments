<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

// -----------------------------------------------------------------------------
//  Make sure all Composer dependencies are installed correctly
// -----------------------------------------------------------------------------

use App\Library\GL;
use App\Library\GLFW3;
use FFI\Proxy\Registry;
use Local\Env\Env;

if (!is_file($composer = __DIR__ . '/../vendor/autoload.php')) {
    $message = <<<ERROR
    You need to set up the project dependencies using Composer:

        composer install

    You can learn all about Composer on https://getcomposer.org
    ERROR;


    fwrite(STDERR, $message);
    exit(1);
}

$result = require $composer;

// -----------------------------------------------------------------------------
//  Load Env Variables
// -----------------------------------------------------------------------------

Env::load(__DIR__ . '/../.env');

// -----------------------------------------------------------------------------
//  Make sure all headers is compiled
// -----------------------------------------------------------------------------

if (glob(__DIR__ . '/../resources/headers/*.h') === []) {
    $message = <<<ERROR
    You need to precompile C headers:

        php bin/precompile

    Please make sure all Composer's dev dependencies are properly installed.
    ERROR;


    fwrite(STDERR, $message);
    exit(1);
}

// -----------------------------------------------------------------------------
//  Load GLFW3 Library
// -----------------------------------------------------------------------------

Registry::register(
    new GLFW3(
        match (\PHP_OS_FAMILY) {
            'Windows' => __DIR__ . '/../resources/headers/glfw.win32.h',
            'Linux' => __DIR__ . '/../resources/headers/glfw.linux.h',
            default => throw new \LogicException('Unsupported OS'),
        },
        match (\PHP_OS_FAMILY) {
            'Windows' => match (\PHP_INT_SIZE) {
                8 => [__DIR__ . '/../bin/x64/glfw3.dll'],
                4 => [__DIR__ . '/../bin/x86/glfw3.dll'],
                default => throw new \LogicException('Unsupported OS bits'),
            },
            'Linux' => ['libglfw.so.3'],
            default => throw new \LogicException('Unsupported OS'),
        }
    )
);

// -----------------------------------------------------------------------------
//  Load OpenGL Library
// -----------------------------------------------------------------------------

Registry::register(
    new GL(
        match (\PHP_OS_FAMILY) {
            'Windows' => __DIR__ . '/../resources/headers/opengl.win32.h',
            'Linux' => __DIR__ . '/../resources/headers/opengl.linux.h',
            default => throw new \LogicException('Unsupported OS'),
        },
        match (PHP_OS_FAMILY) {
            'Windows' => ['opengl32.dll'],
            'Linux' => ['libGL.so.1', 'libGL.so'],
            default => throw new \LogicException('Unsupported OS'),
        },
    )
);

return $result;
