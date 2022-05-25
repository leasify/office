<?php

namespace AnourValar\Office\Drivers;

interface MixInterface
{
    /**
     * Set title for an active sheet
     *
     * @param string $title
     * @return self
     */
    public function setSheetTitle(string $title): self;

    /**
     * Get title of an active sheet
     *
     * @return string
     */
    public function getSheetTitle(): string;

    /**
     * Merge (union) a sheet from another instanceof of driver
     *
     * @param \AnourValar\Office\Drivers\MixInterface $driver
     * @return self
     */
    public function mergeDriver(\AnourValar\Office\Drivers\MixInterface $driver): self;

    /**
     * Change current sheet
     *
     * @param string $sheetName
     * @return void
     */
    public function changeSheet(string $sheetName): void;
}
