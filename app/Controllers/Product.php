<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function getIndex()
    {
        $categories = model('Category')->orderBy('name', 'ASC')->findAll();
        $products = model('Product')->findall();

        $data = [
            'categories' => $categories,
            'products' => $products
        ];

        return view('products', $data);
    }

    public function getCategory(int $id)
    {
        $categories = model('Category')->orderBy('name', 'ASC')->findAll();
        $products = model('Product')->where('category', $id)->findAll();
        
        $data = [
            'categories' => $categories,
            'products' => $products
        ];

        return view('products', $data);
    }
}
