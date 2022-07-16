<?php

namespace App\Models;

use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Model;
use GdImage;

class Product extends Model 
{
    protected $table = 'products';
    protected $primaryKey = 'sku';

    protected $allowedFields = [
        'sku',
        'category',
        'name',
        'image',
        'description',
        'price',
        'stock',
    ];

    protected $useAutoIncrement = false;

    // protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'sku' => 'max_length[64]',
        'category' => 'required|is_not_unique[categories.id]',
        'name' => 'required|max_length[256]',
        'image' => 'permit_empty|string',
        'description' => 'permit_empty|string',
        'price' => 'required|integer|max_length[16]',
        'stock' => 'required|integer|max_length[16]',
    ];
    protected $validationMessages = [
        'sku' => [
            'max_length' => 'The SKU must be no longer than 64 characters.',
        ],
        'category' => [
            'required' => 'You must provide a category.',
            'is_not_unique' => 'The category ID does not exist.',
        ],
        'name' => [
            'required' => 'You must provide a name.',
            'max_length' => 'The name must be less than 256 characters.',
        ],
        'price' => [
            'required' => 'You must provide a price.',
            'numeric' => 'The price must be a number.',
            'max_length' => 'The price must be less than 16 characters.',
        ],
        'stock' => [
            'required' => 'You must provide a stock.',
            'integer' => 'The stock must be an integer.',
            'max_length' => 'The stock must be less than 16 characters.',
        ],
    ];
    // protected $skipValidation     = false;

    public static $insertValidation = [
        'sku' => [
            'label' => 'SKU',
            'rules' => 'required|string|is_unique[products.sku]|max_length[64]',
            'errors' => [
                'required' => 'SKU is required.',
                'is_unique' => 'This SKU is already taken.',
                'max_length' => 'The SKU must be no longer than 64 characters.',
            ],
        ]
    ];
    public static $updateValidation = [
        'sku' => [
            'label' => 'SKU',
            'rules' => 'required|string|is_not_unique[products.sku]|max_length[64]',
            'errors' => [
                'required' => 'SKU is required.',
                'is_not_unique' => 'This SKU is does not exist.',
                'max_length' => 'The SKU must be no longer than 64 characters.',
            ],
        ]
    ];

    public static function getImagePath(string $sku) : string
    {
        return '/assets/img/product/' . $sku . '.jpg';
    }

    public function storeImage(string $sku, UploadedFile|null $image) {
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $newName = $sku . '.jpg';
            $image->move(ROOTPATH . 'public/assets/img/product/', $newName);
        }
    }
}