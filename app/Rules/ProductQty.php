<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductQty implements ValidationRule
{
    private $manage_stock;

    public function __construct($manage_stock)
    {
        $this->manage_stock = $manage_stock;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->manage_stock == 1 && $value === null) {
            $fail(__('general.quantity_required'));
        }
    }
}
