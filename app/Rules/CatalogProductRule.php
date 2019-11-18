<?php

namespace App\Rules;

use App\Domain\CatalogProduct\Queries\ExistsCatalogProductByNameQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CatalogProductRule
 * @package App\Rules
 */
class CatalogProductRule implements Rule
{
    use DispatchesJobs;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->dispatch(new ExistsCatalogProductByNameQuery($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The validation error message.';
    }
}
