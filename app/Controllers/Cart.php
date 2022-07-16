<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public static function getModel($user_id, $notCart = false)
    {
        $orderModel = new \App\Models\Order();

        if (! $notCart && $orderModel->where('user_id', $user_id)->where('status', 'cart')->countAllResults() === 0) {
            $orderModel->insert([
                'user_id' => $user_id,
                'status' => 'cart',
            ]);
        }

        return $orderModel->where('user_id', $user_id)->where(('status' . ($notCart ? '!=' : '=')), 'cart')->orderBy('id', 'DESC');
    }

    public static function getItems($user_id, $notCart = false): array|null
    {
        $order = static::getModel($user_id, $notCart)->first();

        $orderDetailModel = new \App\Models\OrderDetail();
        return $orderDetailModel->where('id', $order['id'])->join('products', 'products.sku = order_details.sku')->findAll();
    }

    private static function addItem($user_id, $sku)
    {
        $order = static::getModel($user_id)->first();

        $orderDetailModel = new \App\Models\OrderDetail();

        $data = [
            'id' => $order['id'],
            'sku' => $sku,
            'quantity' => 1,
        ];
        $orderDetailModel->insert($data);

        return $orderDetailModel->errors();
    }

    private static function removeItem($user_id, $sku)
    {
        $order = static::getModel($user_id)->first();

        $orderDetailModel = new \App\Models\OrderDetail();
        $orderDetailModel->where('id', $order['id'])->where('sku', $sku)->delete();

        return $orderDetailModel->errors();
    }

    private static function order($user_id)
    {
        $order = static::getModel($user_id)->first();
        $order['status'] = 'pending';

        $orderModel = new \App\Models\Order();
        $orderModel->update($order['id'], $order);

        return $orderModel->errors();
    }

    public function getIndex()
    {
        $user = \App\Controllers\User::getUser();

        if (!$user) {
            return redirect()->to('/user/signin');
        }

        $data = [
            'items' => $this::getItems($user['id']),
            'history' => $this::getModel($user['id'], true)->findAll(),
        ];

        return view('cart', $data);
    }

    public function getAdd()
    {
        $user = \App\Controllers\User::getUser();

        if (!$user) {
            return redirect()->to('/user/signin');
        }

        $sku = $this->request->getGet('sku');;

        $productModel = new \App\Models\Product();
        $product = $productModel->find($sku);

        if ($product) {
            static::addItem($user['id'], $sku);
        }

        return redirect()->back();
    }

    public function getRemove()
    {
        $user = \App\Controllers\User::getUser();

        if (!$user) {
            return redirect()->to('/user/signin');
        }

        $sku = $this->request->getGet('sku');;

        static::removeItem($user['id'], $sku);

        return redirect()->back();
    }

    public function getOrder()
    {
        $user = \App\Controllers\User::getUser();

        if (!$user) {
            return redirect()->to('/user/signin');
        }

        static::order($user['id']);

        return redirect()->back();
    }
}
