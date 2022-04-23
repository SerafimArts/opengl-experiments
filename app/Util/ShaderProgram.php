<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Util;

use App\Library\GL;
use App\Util\Shader\Compiled;
use App\Util\Shader\Source;
use App\Util\Shader\Status;
use FFI\Proxy\Registry;

final class ShaderProgram
{
    /**
     * @var GL
     */
    private readonly GL $gl;

    /**
     * @var int
     */
    public readonly int $id;

    /**
     * @var array<Source>
     */
    public readonly array $shaders;

    /**
     * @var array<non-empty-string, int>
     */
    private array $uniforms = [];

    /**
     * @param list<Source> $sources
     * @param GL|null $gl
     */
    public function __construct(
        iterable $sources,
        ?GL $gl = null,
    ) {
        $this->gl = $gl ?? Registry::get(GL::class);
        $this->shaders = [...$sources];

        $this->id = $this->link(
            $this->compile($this->shaders)
        );
    }

    /**
     * @param Source $shader
     * @return $this
     */
    public function with(Source $shader): self
    {
        return new self([...$this->shaders, $shader], $this->gl);
    }

    /**
     * @return void
     */
    public function use(): void
    {
        $this->gl->glUseProgram($this->id);
    }


    /**
     * @param string $name
     * @param float ...$values
     * @return $this
     */
    public function floatUniform(string $name, float ...$values): self
    {
        match (\count($values)) {
            1 => $this->gl->glUniform1f($this->getUniform($name), $values[0]),
            2 => $this->gl->glUniform2f($this->getUniform($name), $values[0], $values[1]),
            3 => $this->gl->glUniform3f($this->getUniform($name), $values[0], $values[1], $values[2]),
            4 => $this->gl->glUniform4f($this->getUniform($name), $values[0], $values[1], $values[2], $values[3]),
        };

        return $this;
    }

    /**
     * @param string $name
     * @return int
     */
    public function getUniform(string $name): int
    {
        return $this->uniforms[$name] ??= $this->gl->glGetUniformLocation($this->id, $name);
    }

    /**
     * @param string $name
     * @param int ...$values
     * @return $this
     */
    public function intUniform(string $name, int ...$values): self
    {
        match (\count($values)) {
            1 => $this->gl->glUniform1i($this->getUniform($name), $values[0]),
            2 => $this->gl->glUniform2i($this->getUniform($name), $values[0], $values[1]),
            3 => $this->gl->glUniform3i($this->getUniform($name), $values[0], $values[1], $values[2]),
            4 => $this->gl->glUniform4i($this->getUniform($name), $values[0], $values[1], $values[2], $values[3]),
        };

        return $this;
    }

    /**
     * @param string $name
     * @param int ...$values
     * @return $this
     */
    public function uintUniform(string $name, int ...$values): self
    {
        match (\count($values)) {
            1 => $this->gl->glUniform1ui($this->getUniform($name), $values[0]),
            2 => $this->gl->glUniform2ui($this->getUniform($name), $values[0], $values[1]),
            3 => $this->gl->glUniform3ui($this->getUniform($name), $values[0], $values[1], $values[2]),
            4 => $this->gl->glUniform4ui($this->getUniform($name), $values[0], $values[1], $values[2], $values[3]),
        };

        return $this;
    }

    /**
     * @param array<Compiled> $compiled
     * @return int
     */
    private function link(array $compiled): int
    {
        $program = $this->gl->glCreateProgram();

        foreach ($compiled as $shader) {
            $this->gl->glAttachShader($program, $shader->id);
        }

        $this->gl->glLinkProgram($program);

        (Status::LINK)($this->gl, $program);

        return $program;
    }

    /**
     * @param list<Source> $shaders
     * @return list<Compiled>
     */
    private function compile(array $shaders): array
    {
        $groups = $result = [];

        foreach ($shaders as $shader) {
            $groups[$shader->type->value][] = $shader;
        }

        foreach ($groups as $type => $shaders) {
            $result[] = new Compiled($this->gl, $type, $shaders);
        }

        return $result;
    }
}
