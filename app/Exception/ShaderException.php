<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Exception;

use App\Util\Shader\Source;
use Phplrt\Contracts\Source\FileInterface;

class ShaderException extends \ParseError
{
    /**
     * @var non-empty-string
     */
    private const SHADER_MSG_PCRE = '/(\d*)\((\d+)\)\h*:\h*error\h*C(\d+)\h*:\h*([^\n]+)/ium';

    /**
     * @param string $message
     * @return array<array{int, int, int, string}>
     */
    private static function parse(string $message): array
    {
        \preg_match_all(self::SHADER_MSG_PCRE, $message, $matches, \PREG_SET_ORDER);

        $result = [];

        foreach ($matches as $group) {
            $result[] = [(int)$group[1], (int)$group[2], \hexdec($group[3]), \ucfirst($group[4])];
        }

        return $result;
    }

    /**
     * @param ShaderException $e
     * @param array<int, Source> $shaders
     * @return static
     */
    public static function decorate(ShaderException $e, array $shaders): self
    {
        if (($info = self::parse($e->getMessage())) === []) {
            return $e;
        }

        foreach ($info as [$source, $line, $code, $message]) {
            $e = new self($message, $code, $e);
            if ($shaders[$source]?->source instanceof FileInterface) {
                $e->file = $shaders[$source]->source->getPathname();
                $e->line = $line;
            }
        }

        return $e;
    }
}
