<?php
declare(strict_types=1);

namespace App\Models;

use App\Http\Dto\Base\BaseResponseDto;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static static find(int|string $key)
 * @method static static create(array $attributes = [])
 */
abstract class BaseModel extends Model
{
    protected $dateFormat = 'U';

    public $timestamps = true;
    abstract function toDto(?string $className = null): BaseResponseDto;
}
