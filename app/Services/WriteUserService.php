<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class WriteUserService
 * @package App\Services\WriteUserService
 */
class WriteUserService
{
    private const USER_NAME_PATTERN = '%s_%d';

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
     * @param UserDTO $userDTO
     * @return bool
     */
    public function create(UserDTO $userDTO): bool
    {
        try {
            $lastAvailableUser = $this->userModel->fetchLastUser();

            if (is_null($lastAvailableUser)) {
                $suffix = 1;
            } else {
                $suffix = $lastAvailableUser->getUniqueSuffix();
            }

            $data = $userDTO->toArray();
            $data['user_name'] = $this->generateUserName($userDTO, $suffix);
            $data['password'] = $this->generateHashedPassword();

            file_put_contents(public_path('user.txt'), $data['user_name']);

            $this->userModel->insert($data);

            return true;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return false;
        }
    }

    /**
     * @param UserDTO $userDTO
     * @param int $uniqueSuffix
     * @return string
     */
    private function generateUserName(UserDTO $userDTO, int $uniqueSuffix): string
    {
        return sprintf(self::USER_NAME_PATTERN, $this->getSlug($userDTO), $uniqueSuffix);
    }

    /**
     * @return string
     */
    private function generateHashedPassword(): string
    {
        $pass = Str::password();

        file_put_contents(public_path('pass.txt'), $pass);

        return Hash::make($pass);
    }

    /**
     * @param UserDTO $userDTO
     * @return string
     */
    private function getSlug(UserDTO $userDTO): string
    {
        return Str::slug(implode('_', [$userDTO->getFirstName(), $userDTO->getLastName()]));
    }
}
