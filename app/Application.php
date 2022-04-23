<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App;

use App\Library\GL;
use App\Library\GLFW3;
use App\Util\Counter;
use FFI\CData;
use FFI\Proxy\ApiInterface;
use FFI\Proxy\Registry;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class Application
{
    public const WIDTH  = 640;
    public const HEIGHT = 480;
    public const MSAA   = 16;
    public const VSYNC  = false;

    /**
     * @var GLFW3|\FFI|ApiInterface|object
     */
    public readonly GLFW3 $glfw;

    /**
     * @var GL|\FFI|ApiInterface|object
     */
    public readonly GL $gl;

    /**
     * @var CData
     */
    public readonly CData $window;

    /**
     * @var Counter
     */
    public readonly Counter $fps;

    /**
     * @param OutputInterface $output
     */
    public function __construct(
        private readonly OutputInterface $output = new ConsoleOutput(),
    ) {
        $this->fps = new Counter();

        $this->gl = Registry::get(GL::class);
        $this->glfw = Registry::get(GLFW3::class);

        $this->boot();
        $this->window = $this->create();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->glfw->glfwSetErrorCallback(static function (int $code, string $message): void {
            $this->output->writeln(\sprintf('<error>[0x%h] %s</error>', $code, $message));
        });

        $this->glfw->glfwInit();

        if ($msaa = env('APP_MSAA', self::MSAA)) {
            $this->glfw->glfwWindowHint(GLFW3::SAMPLES, $msaa);
        }

        $this->glfw->glfwWindowHint(GLFW3::CONTEXT_VERSION_MAJOR, 4);
        $this->glfw->glfwWindowHint(GLFW3::CONTEXT_VERSION_MINOR, 6);
        $this->glfw->glfwWindowHint(GLFW3::OPENGL_PROFILE, GLFW3::OPENGL_CORE_PROFILE);

        if (\PHP_OS_FAMILY === 'Darwin') {
            $this->glfw->glfwWindowHint(GLFW3::OPENGL_FORWARD_COMPAT, GLFW3::TRUE);
        }
    }

    /**
     * @return CData
     */
    private function create(): CData
    {
        $vsync = (bool)env('APP_VSYNC', self::VSYNC);
        $width = env('APP_WIDTH', self::WIDTH);
        $height = env('APP_HEIGHT', self::HEIGHT);

        $window = $this->glfw->glfwCreateWindow($width, $height, "PHP Rocks!", null, null);

        $this->glfw->glfwSetFramebufferSizeCallback($window, function (mixed $window, int $width, int $height): void {
            $this->gl->glViewport(0, 0, $width, $height);
        });

        $this->glfw->glfwMakeContextCurrent($window);
        $this->glfw->glfwSwapInterval((int)$vsync);

        $this->output->writeln('MSAA:     <comment>' . env('APP_MSAA', self::MSAA) . '</comment>');
        $this->output->writeln('VSync:    <comment>' . ($vsync ? 'true' : 'false') . '</comment>');
        $this->output->writeln('Version:  <comment>' . $this->gl->glGetString(GL::VERSION) . '</comment>');
        $this->output->writeln('Renderer: <comment>' . $this->gl->glGetString(GL::RENDERER) . '</comment>');

        return $window;
    }
}
