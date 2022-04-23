<?php

/**
 * This file is part of opengl-experiments package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Util;

final class Counter
{
    /**
     * @var float
     */
    private float $value = .0;

    /**
     * @var float
     */
    public float $delta = .0;

    /**
     * @var float
     */
    private float $time = .0;

    /**
     * FPSCounter constructor.
     */
    public function __construct()
    {
        $this->time = \microtime(true);
    }

    /**
     * @param float $interval
     * @return float|null
     */
    public function shouldUpdate(float $interval): ?float
    {
        $delta = $this->update();

        if ($this->value > $interval) {
            $this->value = 0;
            return $delta;
        }

        return null;
    }

    /**
     * @return float
     */
    public function update(): float
    {
        $now = \microtime(true);

        $this->value += ($this->delta = $now - $this->time);
        $this->time = $now;

        return $this->delta;
    }
}
