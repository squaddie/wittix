<?php

namespace App\ValueObjects;

/**
 * Class ListUsersValueObject
 * @package App\ValueObjects\ListUsersValueObject
 */
class ListUsersValueObject
{
    /** @var string $first_name */
    private string $first_name;
    /** @var string $user_name */
    private string $user_name;
    /** @var int $user_id */
    private int $user_id;

    /**
     * @param string[] $data
     */
    public function __construct(array $data, int $user_id)
    {
        $this->first_name = $data['first_name'] ?? '';
        $this->user_name = $data['user_name'] ?? '';
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function hasFirstName(): string
    {
        return !empty($this->first_name);
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @return string
     */
    public function hasUserName(): string
    {
        return !empty($this->user_name);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
