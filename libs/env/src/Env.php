<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Local\Env;

use Dotenv\Dotenv;

final class Env
{
    /**
     * @var Env|null
     */
    private static ?self $instance = null;

    /**
     * @param array<non-empty-string, int|bool|string> $variables
     */
    private function __construct(
        private readonly array $variables,
    ) {
    }

    /**
     * @param iterable<non-empty-string, mixed> $variables
     * @return array<non-empty-string, scalar>
     */
    private static function map(iterable $variables): array
    {
        $result = [];

        foreach ($variables as $key => $value) {
            if (!\is_scalar($value)) {
                continue;
            }

            if (!\is_string($value)) {
                $result[$key] = $value;
                continue;
            }

            $result[$key] = match (\strtolower($value)) {
                'true', '(true)' => true,
                'false', '(false)' => false,
                'empty', '(empty)' => '',
                'null', '(null)' => null,
                default => (static fn() => \preg_match('/\A([\'"])(.*)\1\z/', $value, $matches) && $matches !== []
                    ? $matches[2] : $value
                )()
            };
        }

        return $result;
    }

    /**
     * @return static
     */
    private static function getInstance(): self
    {
        return self::$instance ??= self::createFromGlobals();
    }

    /**
     * @return static
     */
    private static function createFromGlobals(): self
    {
        return new self(self::map([...$_SERVER, ...$_ENV]));
    }

    /**
     * @psalm-taint-sink file $pathname
     * @param non-empty-string $pathname
     * @return void
     */
    public static function load(string $pathname): void
    {
        if (\is_file($pathname)) {
            $dotenv = Dotenv::createUnsafeImmutable(\dirname($pathname), \basename($pathname));
            $dotenv->load();
        }

        self::$instance = self::createFromGlobals();
    }

    /**
     * @param non-empty-string $name
     * @param mixed|null $default
     * @return mixed
     */
    public static function get(string $name, mixed $default = null): mixed
    {
        $instance = self::getInstance();

        if (isset($instance->variables[$name]) || \array_key_exists($name, $instance->variables)) {
            return $instance->variables[$name];
        }

        return $default;
    }
}

