<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSelectedProducts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function passes($attribute, $value)
    {
        $selectedProducts = array_filter($value); // Filter agar hanya produk yang terpilih yang diambil
        
        $productCounts = array_count_values($selectedProducts);
    
        foreach ($productCounts as $productId => $count) {
            if ($count > 1) {
                return false;
            }
        }
    
        return true;
    }
    
    
    public function message()
    {
        return 'Produk yang dipilih harus unik.';
    }
    
    
}
