<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    // protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'sku',
        'quantity',
    ];

    // protected $useAutoIncrement = false;

    // protected $returnType = 'array';
    // protected $useSoftDeletes = false;

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'id' => 'required|is_not_unique[orders.id]',
        'sku' => 'required|is_not_unique[products.sku]',
        'quantity' => 'required|numeric|max_length[16]|less_than_equal_to[products.stock]',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'You must provide an order ID.',
            'is_not_unique' => 'Order ID does not exist.',
        ],
        'sku' => [
            'required' => 'You must provide a product SKU.',
            'is_not_unique' => 'Product SKU does not exist.',
        ],
        'quantity' => [
            'required' => 'You must provide a quantity.',
            'numeric' => 'The quantity must be a number.',
            'max_length' => 'The quantity must be less than 16 characters.',
            'less_than_or_equal_to' => 'The quantity must be less than or equal to the stock.',
        ],
    ];
    // protected $skipValidation     = false;
}