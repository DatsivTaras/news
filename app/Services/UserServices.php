<?php

namespace App\Services;

use App\Models\File;
use App\Models\Image;

use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;


/**
 * Class FlightServices
 */
class UserServices
{

    private $userRepository;

    private $authorServices;

    private $roleRepository;

    public function __construct(
        UserRepository $userRepository,
        AuthorServices  $authorServices,
        RoleRepository  $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->authorServices = $authorServices;
    }

    public function saveUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);
        $user->assignRole($data['role']);
       
        $data['user_id'] = $user->id;
        $this->authorServices->saveAuthors($data);
    }
}
?>
