<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class UserResourceCollection
 * @package App\Http\Resources\User\UserResourceCollection
 */
class UserResourceCollection extends ResourceCollection
{
    /** @var null $wrap */
    public static $wrap = null;

    /**
     * @param $resource
     * @return string
     */
    public static function collection($resource): string
    {
        return UserResource::class;
    }
}
