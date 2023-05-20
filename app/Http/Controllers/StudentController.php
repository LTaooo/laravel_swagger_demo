<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Dto\Request\StudentListRequestDto;
use App\Http\Dto\Response\StudentResponseDto;
use App\Http\Dto\Response\StudentWithClassResponseDto;
use App\Http\Request\SwaggerRequest;
use App\Http\Schema\SuccessResponse;
use App\Models\Student;
use App\Schema\BaseResource;
use App\Schema\Component\ClassMethod;
use App\Schema\Get;
use App\Schema\PageResource;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Tag;

#[Tag(self::TAG)]
class StudentController
{
    public const TAG = 'student';

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '列表', tags: [self::TAG])]
    #[RequestBody(content: new StudentListRequestDto())]
    #[SuccessResponse(content: new PageResource(StudentResponseDto::class))]
    public function list(SwaggerRequest $request): array
    {
        $studentListRequest = $request->toDto(StudentListRequestDto::class);
        $list = Student::query()
            ->when($studentListRequest->class_id, fn ($query) => $query->where('class_id', $studentListRequest->class_id))
            ->when($studentListRequest->name, fn ($query) => $query->where('name', 'like', "%{$studentListRequest->name}%"))
            ->paginate($studentListRequest->limit);
        return PageResource::format(StudentWithClassResponseDto::collection($list));
    }

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '详情', tags: [self::TAG])]
    #[RequestBody(content: new JsonContent(properties: [
        new Property(property: 'id', title: '学生id', type: 'integer')
    ]))]
    #[SuccessResponse(content: new BaseResource(StudentWithClassResponseDto::class, false))]
    public function detail(): array
    {
        return BaseResource::format(Student::find(1)->toDto());
    }
}
