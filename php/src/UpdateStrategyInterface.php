<?php

declare(strict_types=1);

namespace GildedRose;

interface UpdateStrategyInterface
{
    public function update(): void;
}