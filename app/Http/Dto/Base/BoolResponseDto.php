<?php
declare(strict_types=1);

namespace App\Http\Dto\Base;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '成功或失败', description: '')]
class BoolResponseDto extends BaseResponseDto
{
    #[Property(property: 'success', title: '成功或失败', type: 'boolean', example: true)]
    public bool $success;

    /**
     * @param bool $success
     */
    public function __construct(bool $success)
    {
        $this->success = $success;
        parent::__construct(['success' => $success]);
    }
}
