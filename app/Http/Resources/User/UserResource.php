<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources\User\UserResource
 *
 * @property int $id
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 */
class UserResource extends JsonResource
{
    /** @var null $wrap */
    public static $wrap = null;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }
}
