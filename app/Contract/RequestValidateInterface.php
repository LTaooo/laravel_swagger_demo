<?php
declare(strict_types=1);

namespace App\Contract;

interface RequestValidateInterface
{
    public function rules(): array;

    public function messages(): array;
}
