<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Dto\Base\BoolResponseDto;
use App\Http\Dto\Base\IdRequestDto;
use App\Http\Dto\Request\StudentAddDto;
use App\Http\Dto\Request\StudentListRequestDto;
use App\Http\Dto\Request\StudentUpdateDto;
use App\Http\Dto\Response\StudentResponseDto;
use App\Http\Dto\Response\StudentWithClassResponseDto;
use App\Http\Request\SwaggerRequest;
use App\Http\Schema\SuccessResponse;
use App\Models\Student;
use App\Schema\BaseResource;
use App\Schema\Component\ClassMethod;
use App\Schema\Get;
use App\Schema\PageResource;
use App\Schema\RequestBody;
use OpenApi\Attributes\Tag;
use ReflectionException;

#[Tag(self::TAG, description: '学生管理')]
class StudentController
{
    public const TAG = 'student';

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '列表', tags: [self::TAG])]
    #[RequestBody(dtoClass: StudentListRequestDto::class)]
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
     * @throws ReflectionException
     */
    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '详情', tags: [self::TAG])]
    #[RequestBody(dtoClass: IdRequestDto::class)]
    #[SuccessResponse(content: new BaseResource(StudentWithClassResponseDto::class))]
    public function detail(SwaggerRequest $request): array
    {
        /** @var IdRequestDto $id */
        $id = $request->autoToDto();
        return BaseResource::format(Student::find($id->id)->toDto(StudentWithClassResponseDto::class));
    }

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '添加', tags: [self::TAG])]
    #[RequestBody(dtoClass: StudentAddDto::class)]
    #[SuccessResponse(content: new BaseResource(StudentResponseDto::class))]
    public function add(SwaggerRequest $request): array
    {
        $studentDto = $request->toDto(StudentAddDto::class);
        $student = Student::create($studentDto->toArray());
        return BaseResource::format($student->toDto());
    }

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '修改', tags: [self::TAG])]
    #[RequestBody(dtoClass: StudentUpdateDto::class)]
    #[SuccessResponse(content: new BaseResource(BoolResponseDto::class))]
    public function update(SwaggerRequest $request): array
    {
        $studentDto = $request->toDto(StudentUpdateDto::class);
        $result = Student::find($studentDto->id)->fill($studentDto->toArray())->save();
        return BaseResource::format(new BoolResponseDto($result));
    }

    #[Get(classMethod: new ClassMethod(self::class, __FUNCTION__), description: '删除', tags: [self::TAG])]
    #[RequestBody(dtoClass: IdRequestDto::class)]
    #[SuccessResponse(content: new BaseResource(BoolResponseDto::class))]
    public function delete(SwaggerRequest $request): array
    {
        $idDto = $request->toDto(IdRequestDto::class);
        $result = Student::find($idDto->id)->delete();
        return BaseResource::format(new BoolResponseDto($result));
    }

}
