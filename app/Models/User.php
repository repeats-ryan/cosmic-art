<?php 

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at',
    ];

    protected $useAutoIncrement = true;

    // protected $returnType = 'array';
    // protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'id' => 'permit_empty|is_natural_no_zero|max_length[32]',
        'name' => 'required|string|max_length[256]',
        'email' => 'required|valid_email|is_unique[users.email]|max_length[256]',
        'password' => 'required|string|max_length[256]',
        'role' => 'permit_empty|in_list[admin,merchant,customer]',
    ];
    protected $validationMessages = [
        'id' => [
            'is_natural_no_zero' => 'ID must be a positive integer.',
            'max_length' => 'ID must be less than 32 characters.',
        ],
        'name' => [
            'required' => 'You must provide a name.',
            'max_length' => 'The name must be less than 256 characters.',
        ],
        'email' => [
            'required' => 'You must provide an email address.',
            'valid_email' => 'The email address must be valid.',
            'is_unique' => 'The email address has already registered.',
            'max_length' => 'The email address must be less than 256 characters.',
        ],
        'password' => [
            'required' => 'You must provide a password.',
            'max_length' => 'The password must be less than 256 characters.',
        ],
        'role' => [
            'in_list' => 'The role must be either admin, merchant or customer.',
        ],
    ];
    // protected $skipValidation     = false;

    public static $passwordValidation = [
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'You must provide a password.',
                'min_length' => 'The password must be at least 8 characters.',
            ],
        ],
        'passconf' => [
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'You must confirm your password.',
                'matches' => 'The password confirmation does not match.',
            ],
        ],
    ];

    public static $loginValidation = [
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_not_unique[users.email]',
            'errors' => [
                'required' => 'You must provide an email address.',
                'valid_email' => 'The email address must be valid.',
                'is_not_unique' => 'The email address is not registered.',
            ],
        ],
    ];
}

?>
