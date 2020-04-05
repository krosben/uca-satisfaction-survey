<?php

namespace App\Rules;

use Rakit\Validation\Rule;

class EqualSizeRule extends Rule
{
    protected $message = 'The :attribute size must be same size of :field';

    protected $fillableParams = ['field'];

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters($this->fillableParams);
        // getting parameters
        $field = $this->parameter('field');
        $anotherValue = $this->getAttribute()->getValue($field);

        return count($anotherValue) === count($value);
    }
}
