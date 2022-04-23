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
