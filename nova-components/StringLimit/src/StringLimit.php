<?php

namespace Hackshadetechs\StringLimit;

use Laravel\Nova\Fields\Field;

class StringLimit extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'string-limit';

    public function maxLength($value)
    {
        return $this->withMeta([
            'maxLength' => $value
        ]);
    }
}
