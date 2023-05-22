<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Dto\Request\IdRequestDto;
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
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Tag;

#[Tag(self::TAG, description: '学生管理')]
class StudentController
{
    public const TAG = 'student';

    /**
     * @param SwaggerRequest $request
     * @return array<string, mixed>
     */
    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '列表', tags: [self::TAG])]
    #[RequestBody(content: new StudentListRequestDto())]
    #[SuccessResponse(content: new PageResource(StudentResponseDto::class))]
    public function list(SwaggerRequest $request): array
    {
        $studentListRequest = $request->toDto(StudentListRequestDto::class);
        $list = Student::query()
            ->when($studentListRequest->class_id, fn($query) => $query->where('class_id', $studentListRequest->class_id))
            ->when($studentListRequest->name, fn($query) => $query->where('name', 'like', "%$studentListRequest->name%"))
            ->paginate($studentListRequest->limit);
        return PageResource::format(StudentResponseDto::collection($list));
    }

    /**
     * @param SwaggerRequest $request
     * @return array<string, mixed>
     */
    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '详情', tags: [self::TAG])]
    #[RequestBody(content: new IdRequestDto())]
    #[SuccessResponse(content: new BaseResource(StudentWithClassResponseDto::class, false))]
    public function detail(SwaggerRequest $request): array
    {
        $id = $request->toDto(IdRequestDto::class);
        return BaseResource::format(Student::find($id->id)->toDto());
    }

}
