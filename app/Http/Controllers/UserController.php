<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GetUsersRequest;
use App\Http\Resources\User\UserResourceCollection;
use App\Jobs\DeleteUserJob;
use App\Services\ReadUserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

/**
 * Class UserController
 * @package App\Http\Controllers\UserController
 */
class UserController extends Controller
{
    /**
     * @param GetUsersRequest $usersRequest
     * @param ReadUserService $readUserService
     * @return UserResourceCollection
     */
    public function list(GetUsersRequest $usersRequest, ReadUserService $readUserService): UserResourceCollection
    {
        return new UserResourceCollection($readUserService->getUsers($usersRequest->getUsersListValueObject()));
    }

    /**
     * @param CreateUserRequest $request
     * @return Response
     */
    public function create(CreateUserRequest $request): Response
    {
        Artisan::call('app:create-user', $request->validated());

        return response('', ResponseCodes::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        DeleteUserJob::dispatch($id);

        return response()->noContent();
    }
}
