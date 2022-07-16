<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model 
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'description',
    ];

    protected $useAutoIncrement = true;

    //protected $returnType = 'array';
    //protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'permit_empty|is_unique[categories.id]|is_natural_no_zero|max_length[16]',
        'name' => 'required|is_unique[categories.name]|max_length[256]',
        'description' => 'permit_empty|string',
    ];
    protected $validationMessages = [
        'id' => [
            'is_unique' => 'Category ID must be unique.',
            'is_natural_no_zero' => 'Category ID must be a positive integer.',
            'max_length' => 'Category ID must be less than 16 characters.',
        ],
        'name' => [
            'required' => 'You must provide a name.',
            'is_unique' => 'This category already exists.',
            'max_length' => 'The name must be less than 256 characters.',
        ],
    ];
    // protected $skipValidation     = false;
}