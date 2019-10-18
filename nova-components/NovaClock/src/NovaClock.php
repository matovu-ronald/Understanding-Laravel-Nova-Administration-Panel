<?php

namespace Hackshadetechs\NovaClock;

use Laravel\Nova\Card;

class NovaClock extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public function blink($blink = true)
    {
        return $this->withMeta([
            'blink' => $blink
        ]);
    }

    public function withSeconds($withSeconds = true)
    {
        return $this->withMeta([
            'withSeconds' => $withSeconds
        ]);
    }

    public function twelveHour($twelveHour = true)
    {
        return $this->withMeta([
            'twelveHour' => $twelveHour
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'NovaClock';
    }
}
