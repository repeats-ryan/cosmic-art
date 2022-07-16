<?php 

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'status',
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
        'user_id' => 'required|is_not_unique[users.id]',
        'status' => 'required|in_list[cart,pending,processing,delivering,completed,cancelled]',
    ];
    protected $validationMessages = [
        'user_id' => [
            'required' => 'You must provide a user id.',
            'is_not_unique' => 'User ID does not exist.',
        ],
        'status' => [
            'required' => 'You must provide a status.',
            'in_list' => 'The status must be cart, pending, processing, delivering, completed, or cancelled.',
        ],
    ];
    // protected $skipValidation     = false;
}