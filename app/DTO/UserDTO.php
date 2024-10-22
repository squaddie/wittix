<?php

namespace App\DTO;

/**
 * Class UserDTO
 * @package App\DTO\UserDTO
 */
class UserDTO
{
    /** @var string $first_name */
    private string $first_name;
    /** @var string $last_name */
    private string $last_name;
    /** @var string $user_name */
    private string $user_name;

    /**
     * @param string[] $data
     */
    public function __construct(array $data)
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->user_name = $data['user_name'] ?? '';
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
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'user_name' => $this->getUserName(),
        ];
    }
}
