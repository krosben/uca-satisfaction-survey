<?php

namespace App\Rules;

use Opis\Database\Database;
use Rakit\Validation\Rule;

class LoginRule extends Rule
{
    protected $message = 'The :attribute size must be same size of :email';

    protected $fillableParams = ['email'];

    /**
     * @var Database
     */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters($this->fillableParams);
        // getting parameters values
        $email = $this->getAttribute()->getValue($this->parameter('email'));

        return $this->verifyPassword($email, $value);
    }

    private function verifyPassword(string $email, string $password): bool
    {
        $hash = $this->db->from('users')
            ->where('email')
            ->is($email)
            ->column('password')
        ;

        return password_verify($password, $hash);
    }
}
