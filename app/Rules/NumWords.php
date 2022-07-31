<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NumWords implements Rule
{
    private $attribute;
    private $expected;
    public string $customMessage;
    
    public function __construct(int $expected, ?string $customMessage = '')
    {
        $this->expected = $expected;
        $this->customMessage = $customMessage;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        $trimmed = trim($value);
        $numWords = count(explode(' ', $trimmed));
        return $numWords === $this->expected;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->customMessage) return $this->customMessage;

        return 'The '.$this->attribute.' field must have exactly '.$this->expected.'  words';
    }
}
