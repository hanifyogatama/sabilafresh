<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        if (\Cart::isEmpty()) {
            return redirect('carts');
        }

        $this->updateTax();

        $items = \Cart::getContent();
        $this->data['items'] = $items;
        $this->data['totalWeight'] = $this->getTotalWeight() / 1000;

        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset(\Auth::user()->province_id) ? $this->getCities(\Auth::user()->province_id) : [];

        $this->data['user'] = \Auth::user();

        $this->load_theme('orders.checkout', $this->data);
    }

    private function getTotalWeight()
    {
        if (\Cart::isEmpty()) {
            return 0;
        }

        $totalWeight = 0;
        $items = \cart::getContent();

        foreach ($items as $item) {
            $totalWeight = ($item->quantity * $item->associatedModel->berat);
        }

        return $totalWeight;
    }

    private function updateTax()
    {
        \Cart::removeConditionsByType('tax');

        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'TAX 0%',
            'type' => 'tax',
            'target' => 'total',
            'value' => '0%',
        ));

        \Cart::condition($condition);
    }
}
