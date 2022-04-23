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
use FFI\CData;
use FFI\Proxy\Registry;
use FFI\Scalar\Type as CType;

final class Program
{
    /**
     * @var list<Shader>
     */
    private array $shaders = [];

    /**
     * @var GL
     */
    private readonly GL $gl;

    /**
     * @param list<Shader> $shaders
     * @param GL|null $gl
     */
    public function __construct(iterable $shaders, ?GL $gl = null)
    {
        $this->gl = $gl ?? Registry::get(GL::class);

        foreach ($shaders as $shader) {
            $this->shaders[] = $shader;
        }

        $this->compile();
    }

    /**
     * @param Shader $shader
     * @return $this
     */
    public function with(Shader $shader): self
    {
        return new self([...$this->shaders, $shader], $this->gl);
    }

    /**
     * @return array<positive-int, array<string>>
     */
    private function getShaderGroups(): array
    {
        $groups = [];

        foreach ($this->shaders as $shader) {
            $groups[$shader->type->value][] = $shader->source;
        }

        return $groups;
    }

    /**
     * @param array<positive-int, array<string>> $groups
     * @return array<positive-int, CData>
     */
    private function packShaderGroups(array $groups): array
    {
        $result = [];

        foreach ($groups as $type => $group) {
            $result[$type] = CType::stringArray($group);
        }

        return $result;
    }

    private function compileShaderGroups(array $packed): array
    {

    }

    private function compile(): void
    {
        $groups = $this->getShaderGroups();
        $packed = $this->packShaderGroups($groups);
    }
}