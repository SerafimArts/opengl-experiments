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
use App\Library\GL;

/**
 * Note: Using GL::XXX_SHADER class constants is not possible due to
 *       {@see https://github.com/php/php-src/issues/8418} error.
 */
enum Type: int
{
    case FRAGMENT = 0x8B30 /*GL::FRAGMENT_SHADER*/;
    case VERTEX = 0x8B31 /*GL::VERTEX_SHADER*/;
    case GEOMETRY = 0x8DD9 /*GL::GEOMETRY_SHADER*/;
    case TESS_EVALUATION = 0x8E87 /*GL::TESS_EVALUATION_SHADER*/;
    case TESS_CONTROL = 0x8E88 /*GL::TESS_CONTROL_SHADER*/;
    case COMPUTE = 0x91B9 /*GL::COMPUTE_SHADER*/;
}