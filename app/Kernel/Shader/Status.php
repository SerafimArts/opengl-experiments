<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Kernel\Shader;

use App\Exception\ShaderException;
use App\Library\GL;
use FFI\Scalar\Type;

/**
 * Note: Using GL::XXX_STATUS class constants is not possible due to
 *       {@see https://github.com/php/php-src/issues/8418} error.
 */
enum Status: int
{
    case DELETE = 0x8B80 /*GL::DELETE_STATUS*/;
    case COMPILE = 0x8B81 /*GL::COMPILE_STATUS*/;
    case LINK = 0x8B82 /*GL::LINK_STATUS*/;
    case VALIDATE = 0x8B83 /*GL::VALIDATE_STATUS*/;

    /**
     * @param GL $gl
     * @param int $shader
     * @return void
     */
    public function validateOrFail(GL $gl, int $shader): void
    {
        $success = Type::int();

        $gl->glGetShaderiv($shader, $this->value, \FFI::addr($success));

        if (!$success->cdata) {
            $message = \FFI::new('char[512]');

            $gl->glGetShaderInfoLog($shader, 512, null, $message);

            throw new ShaderException(\FFI::string($message));
        }
    }
}