<?php

namespace App\Http\Requests;

use App\ValueObjects\ListUsersValueObject;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Class GetUsersRequest
 * @package App\Http\Requests\GetUsersRequest
 */
class GetUsersRequest extends Request
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => ['nullable', 'string'],
            'first_name' => ['nullable', 'string'],
        ];
    }

    /**
     * @return ListUsersValueObject
     */
    public function getUsersListValueObject(): ListUsersValueObject
    {
        return new ListUsersValueObject($this->validated(), $this->user()->id);
    }
}
