<?php
namespace Database\Seeders;

use App\Repositories\AuthorsRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class GenerateAdminAccounts extends Seeder
{
    private $authorsRepository;
    private $userRepository;

    public function __construct(
        AuthorsRepository $authorsRepository,
        UserRepository $userRepository
    )
    {
        $this->authorsRepository = $authorsRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'name' => 'Admin',
                'email' => '123admin@admin.com',
                'password' => Hash::make('11111111'),
                'email_verified_at' => Carbon::now(),
                'author' => [
                    'surname' => 'Admin',
                    'name' => 'Admin',
                    'slug' => 'Admin',
                    'patronymic' => 'Admin',
                    'biography' => 'Admin',
                    'user_id' => '',
                ]
            ],
        ];

        foreach ($usersData as $userData) {
            if (!$this->userRepository->getOne($userData['email'], 'email')) {
                $author = $userData['author'];
                unset($userData['author']);
                $user = $this->userRepository->create($userData);
                $userData['author']['user_id'] = $user->id;
                $this->authorsRepository->create($author);
                if ($user) {
                    $user->assignRole('Admin');
                }
            }
        }
    }
}
