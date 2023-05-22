<?php
declare(strict_types=1);

namespace App\Contract;

use Illuminate\Contracts\Validation\Rule;

interface RequestValidateInterface
{
    /**
     * @return array<string, array<string|Rule>>
     */
    public function rules(): array;

    /**
     * @return array<string, string>
     */
    public function messages(): array;
}
