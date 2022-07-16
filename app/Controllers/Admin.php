<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public static $navigation = [
        //'' => ['home', 'Dashboard'],
        'order' => ['file', 'Orders'],
        'product' => ['shopping-cart', 'Products'],
        'category' => ['layers', 'Categories'],
        'customer' => ['users', 'Customers'],
    ];

    public function getIndex()
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        return redirect()->to('/admin/order');
    }

    public function getCategory(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $errors = session()->getFlashdata('errors');

        $categoryModel = new \App\Models\Category();

        switch ($action) {
            case '':

                $categories = $categoryModel->findAll();
                $data = [
                    'categories' => $categories
                ];

                return view('admin/categories', $data);

            case 'add':

                $data = [
                    'edit' => false,
                    'errors' => $errors,
                ];
                return view('admin/category', $data);

            case 'edit':

                $category = $categoryModel->find($this->request->getGet('id'));

                $data = [
                    'edit' => $category,
                    'errors' => $errors,
                ];
                return view('admin/category', $data);

            case 'delete':

                if ($id = $this->request->getGet('id')) {
                    if (! $categoryModel->delete($id)) {
                        return var_dump($categoryModel->errors());
                    }
                }

                return redirect()->to('/admin/category');
            
            default:
                return redirect()->to('/admin/category');
        }
    }
    public function postCategory(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $categoryModel = new \App\Models\Category();

        switch ($action) {
            case 'add':

                $categoryModel->insert([
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                ]);

                if ($errors = $categoryModel->errors()) {
                    return redirect()->to('/admin/category')->with('errors', $errors);
                }

                return redirect()->to('/admin/category');

            case 'edit':

                $id = $this->request->getPost('id');

                $categoryModel->update($id, [
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                ]);

                if ($errors = $categoryModel->errors()) {
                    return redirect()->to('/admin/category/edit?id=' . $id)->with('errors', $errors);
                }

                return redirect()->to('/admin/category');
        }
    }

    public function getProduct(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $errors = session()->getFlashdata('errors');
        
        $productModel = new \App\Models\Product();

        switch ($action) {
            case '':

                $products = $productModel->findall();

                $data = [
                    'products' => $products
                ];

                return view('admin/products', $data);

            case 'add':

                $data = [
                    'edit' => false,
                    'errors' => $errors,
                ];

                return view('admin/product', $data);

            case 'edit':

                $product = $productModel->find($this->request->getGet('sku'));

                $data = [
                    'edit' => $product,
                    'errors' => $errors,
                ];

                return view('admin/product', $data);

            case 'delete':

                if ($sku = $this->request->getGet('sku')) {
                    if (! $productModel->delete($sku)) {
                        return var_dump($productModel->errors());
                    }
                }

                return redirect()->to('/admin/product');

            default:
                return redirect()->to('/admin/product');
        }
    }
    public function postProduct(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $productModel = new \App\Models\Product();

        switch ($action) {
            case 'add':
                
                $sku = $this->request->getPost('sku');
                $productModel->storeImage($sku, $this->request->getFile('images'));

                if (! $this->validate(\App\Models\Product::$insertValidation)) {
                    return redirect()->to('/admin/product/add')->with('errors', $this->validator->getErrors());
                }
                
                $post = $this->request->getPost();
                $post['stock'] ??= 0;

                $productModel->insert($post);

                if ($errors = $productModel->errors()) {
                    return redirect()->to('/admin/product/add')->with('errors', $errors);
                }

                return redirect()->to('/admin/product');

            case 'edit':

                $sku = $this->request->getPost('sku');
                $productModel->storeImage($sku, $this->request->getFile('images'));

                if (! $this->validate(\App\Models\Product::$updateValidation)) {
                    return redirect()->to('/admin/product/edit?sku=' . $sku)->with('errors', $this->validator->getErrors());
                }

                $post = $this->request->getPost();
                $post['stock'] ??= 0;

                $productModel->update($sku, $post);

                if ($errors = $productModel->errors()) {
                    return redirect()->to('/admin/product/edit?sku=' . $sku)->with('errors', $errors);
                }

                return redirect()->to('/admin/product');
        }
    }

    public function getOrder(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $orderModel = new \App\Models\Order();
        $orderDetailModel = new \App\Models\OrderDetail();

        switch ($action) {
            case '':
                $orders = $orderModel->where('status !=', 'cart')->where('status !=', 'cancelled')->findAll();

                $data = [
                    'orders' => $orders
                ];

                return view('admin/orders', $data);

            case 'detail':
                $order = $orderModel->find($this->request->getGet('id'));

                $userModel = new \App\Models\User();
                $user = $userModel->find($order['user_id']);

                $orderDetails = $orderDetailModel->where('id', $this->request->getGet('id'))->join('products', 'products.sku = order_details.sku')->findAll();

                $data = [
                    'order' => $order,
                    'user' => $user,
                    'details' => $orderDetails,
                ];

                return view('admin/order', $data);

            case 'increment':
                $order = $orderModel->find($this->request->getGet('id'));

                $order['status'] = static::incrementMessage($order['status']);

                $orderModel->update($order['id'], $order);


                return redirect()->to('/admin/order/detail?id=' . $order['id']);

            default:
                return redirect()->to('/admin/order');
        }
    }

    public function getCustomer(string $action = '')
    {
        if ($notAdmin = $this::checkPrivilege()) return $notAdmin;

        $userModel = new \App\Models\User();
        
        switch ($action) {
            case '':

                $customers = $userModel->where('role', 'customer')->findAll();
                $data = [
                    'customers' => $customers
                ];
                return view('admin/customers', $data);

            default:
                return redirect()->to('/admin/customer');
        }
    }

    public static function incrementMessage($status)
    {
        if ($status == 'pending') {
            return 'delivering';
        } elseif ($status == 'delivering') {
            return 'completed';
        } else {
            return false;
        }
    }

    private static function checkPrivilege()
    {
        // Return redirect to root if not admin
        return ($user = \App\Controllers\User::getUser()) && $user['role'] !== 'customer' ? false : redirect()->to('/');
    }
}
