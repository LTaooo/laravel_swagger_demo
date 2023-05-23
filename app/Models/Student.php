<?php
declare(strict_types=1);

namespace App\Models;

use App\Http\Dto\Response\StudentResponseDto;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends BaseModel
{
    protected $table = 'student';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    function toDto(?string $className = null): StudentResponseDto
    {
        if (isset($className)) {
            return new $className($this);
        }
        return new StudentResponseDto($this);
    }

    public function class(): HasOne
    {
        return $this->hasOne(StudentClass::class, 'id', 'class_id');
    }
}
