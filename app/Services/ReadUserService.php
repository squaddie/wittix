<?php

namespace App\Services;

use App\Models\User;
use App\ValueObjects\ListUsersValueObject;
use Illuminate\Support\Collection;

/**
 * Class ReadUserService
 * @package App\Services\ReadUserService
 */
class ReadUserService
{
    /** @var User $userModel */
    private User $userModel;

    /**
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param ListUsersValueObject $listUsersValueObject
     * @return Collection
     */
    public function getUsers(ListUsersValueObject $listUsersValueObject): Collection
    {
        $model = $this->userModel
            ->query()
            ->where('id', '!=', $listUsersValueObject->getUserId());

        if ($listUsersValueObject->hasUserName()) {
            $model = $model->where('user_name', 'like', "%{$listUsersValueObject->getUserName()}%");
        }

        if ($listUsersValueObject->hasFirstName()) {
            $model = $model->where('first_name', 'like', "%{$listUsersValueObject->getFirstName()}%");
        }

        return $model->latest()->get();
    }
}
