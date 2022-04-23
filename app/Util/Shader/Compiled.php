<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Util\Shader;


use App\Exception\ShaderException;
use App\Library\GL;
use FFI\CData;
use FFI\Scalar\Type as CType;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal App\Kernel\Shader
 */
final class Compiled
{
    /**
     * @var CData
     */
    private readonly CData $memory;

    /**
     * @var int
     */
    public readonly int $id;

    /**
     * @param GL $gl
     * @param int $type
     * @param non-empty-list<Source> $shaders
     */
    public function __construct(
        private readonly GL $gl,
        int $type,
        public readonly array $shaders,
    ) {
        $memory = $this->shadersToArray($this->shaders);

        $this->id = $gl->glCreateShader($type);
        $gl->glShaderSource($this->id, \count($shaders), \FFI::addr($memory[0]), null);
        $gl->glCompileShader($this->id);

        try {
            $compilation = Status::COMPILE;
            $compilation->validateOrFail($this->gl, $this->id);
        } catch (ShaderException $e) {
            throw ShaderException::decorate($e, $this->shaders);
        }
    }

    /**
     * @param non-empty-list<Source> $shaders
     * @return CData
     */
    private function shadersToArray(array $shaders): CData
    {
        $result = [];

        foreach ($shaders as $shader) {
            $result[] = $shader->source->getContents();
        }

        return CType::stringArray($result);
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->gl->glDeleteShader($this->id);
    }
}
