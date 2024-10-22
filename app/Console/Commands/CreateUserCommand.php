<?php

namespace App\Console\Commands;

use App\DTO\UserDTO;
use App\Services\WriteUserService;
use Illuminate\Console\Command;

/**
 * Class CreateUserCommand
 * @package App\Console\Commands\CreateUserCommand
 */
class CreateUserCommand extends Command
{
    /** @var string */
    protected $signature = 'app:create-user {first_name} {last_name}';
    /** @var string */
    protected $description = 'Command description';

    /**
     * @param WriteUserService $user
     * @return void
     */
    public function handle(WriteUserService $user): void
    {
        $user->create(new UserDTO($this->arguments()));
    }
}
