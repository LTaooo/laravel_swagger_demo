<?php
declare(strict_types=1);

namespace App\Models;

use App\Http\Dto\Base\BaseResponseDto;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static static find(int|string $key)
 */
abstract class BaseModel extends Model
{
    protected $dateFormat = 'U';

    public $timestamps = false;
    abstract function toDto(?string $className = null): BaseResponseDto;
}
