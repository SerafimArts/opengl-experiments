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
    case DELETE = 0x8B80 /**{@see GL::DELETE_STATUS}*/;
    case COMPILE = 0x8B81 /**{@see GL::COMPILE_STATUS}*/;
    case LINK = 0x8B82 /**{@see GL::LINK_STATUS}*/;
    case VALIDATE = 0x8B83 /**{@see GL::VALIDATE_STATUS}*/;

    /**
     * @param GL $gl
     * @param int $id
     * @return void
     */
    public function validateOrFail(GL $gl, int $id): void
    {
        if ($error = $this->validateOrGetException($gl, $id)) {
            throw $error;
        }
    }

    /**
     * @param GL $gl
     * @param int $id
     * @return ShaderException|null
     */
    public function validateOrGetException(GL $gl, int $id): ?ShaderException
    {
        $isValid = $this->validate($gl, $id);

        if ($isValid) {
            return null;
        }

        $message = \FFI::new('char[512]');

        $gl->glGetShaderInfoLog($id, 512, null, $message);

        return new ShaderException(\FFI::string($message));
    }

    /**
     * @param GL $gl
     * @param int $id
     * @return bool
     */
    public function validate(GL $gl, int $id): bool
    {
        $success = Type::int(1);

        $gl->glGetShaderiv($id, $this->value, \FFI::addr($success));

        return $success->cdata !== 0;
    }

    /**
     * @param GL $gl
     * @param int $id
     * @return void
     */
    public function __invoke(GL $gl, int $id): void
    {
        $this->validateOrFail($gl, $id);
    }
}
