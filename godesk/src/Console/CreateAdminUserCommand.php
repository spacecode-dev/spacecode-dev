<?php

namespace SpaceCode\GoDesk\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\Models\User;

/**
 * Class CreateAdminUserCommand
 * @package SpaceCode\GoDesk\Console
 */
class CreateAdminUserCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:create-admin';

    /**
     * @var string
     */
    protected $description = 'Create Admin User';

    public function handle()
    {
        /**
         * Email
         */
        $email = $this->ask('What is your email?');
        $emailValidator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users|max:255|min:3'
        ]);
        if ($emailValidator->fails()) {
            $this->warn($emailValidator->errors()->toArray()['email'][0]);

            $email = $this->ask('What is your email?');
            $emailValidator = Validator::make(['email' => $email], [
                'email' => 'required|email|unique:users|max:255|min:3'
            ]);
            $this->interrupted($emailValidator);
        }

        /**
         * First Name
         */
        $firstName = $this->ask('What is your first name?');
        $firstNameValidator = Validator::make(['name' => $firstName], [
            'name' => 'required|max:255|min:3'
        ]);
        if ($firstNameValidator->fails()) {
            $this->warn($firstNameValidator->errors()->toArray()['name'][0]);

            $firstName = $this->ask('What is your first name?');
            $firstNameValidator = Validator::make(['name' => $firstName], [
                'name' => 'required|max:255|min:3'
            ]);
            $this->interrupted($firstNameValidator);
        }

        /**
         * Last Name
         */
        $lastName = $this->ask('What is your last name?');
        $lastNameValidator = Validator::make(['name' => $lastName], [
            'name' => 'required|max:255|min:3'
        ]);
        if ($lastNameValidator->fails()) {
            $this->warn($lastNameValidator->errors()->toArray()['name'][0]);

            $lastName = $this->ask('What is your last name?');
            $lastNameValidator = Validator::make(['name' => $lastName], [
                'name' => 'required|max:255|min:3'
            ]);
            $this->interrupted($lastNameValidator);
        }

        /**
         * Password
         */
        $password = $this->secret('Create a password');
        $passwordValidator = Validator::make(['password' => $password], [
            'password' => 'required|min:3'
        ]);
        if ($passwordValidator->fails()) {
            $this->warn($passwordValidator->errors()->toArray()['password'][0]);

            $password = $this->ask('Create a password');
            $passwordValidator = Validator::make(['password' => $password], [
                'password' => 'required|min:3'
            ]);
            $this->interrupted($passwordValidator);
        }

        $language = $this->choice('What is your native language?', ['English', 'Russian', 'Ukrainian'], 'English');

        $name = $firstName . ' ' . $lastName;
        $lang = 'en';
        if($language === 'Russian') {
            $lang = 'ru';
        } else if ($language === 'Ukrainian') {
            $lang = 'uk';
        }

        $user = User::create(
            ['name' => $name, 'lang' => $lang, 'email' => $email, 'password' => bcrypt($password)]
        );
        $user->assignRole('admin');

        $loginURL = url('admin');
        $this->comment(str_repeat('*', Str::length(strip_tags($loginURL)) + 20));
        $empty = str_repeat(' ', Str::length(strip_tags($loginURL)) - 17);
        $this->comment("*     User created successfully     {$empty}*");
        $this->comment("*     Login - {$loginURL}     *");
        $this->comment(str_repeat('*', Str::length(strip_tags($loginURL)) + 20));
    }

    /**
     * @param $validation
     */
    protected function interrupted($validation)
    {
        if ($validation->fails()) {
            $this->error('Command execution interrupted');
            return;
        }
    }
}
