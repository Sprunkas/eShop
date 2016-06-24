<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdersController extends Controller
{
    public function getOrdersList()
    {
        return view('template.orders_list')->with('orders', Order::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->get());
    }

    public function getNewOrder()
    {
        return view('template.order_new');
    }

    public function postNewOrder(Request $request)
    {  
        $this->validate($request, [
            'title' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required|integer',
            'price.*' => 'required|numeric',
        ]);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'total' => $request->input('total'),
        ]);

        $orderID = $order->id;

        for($i = 0; $i < count($request->input('item')); $i++) {
            Item::create([
                'order_id' => $orderID,
                'position' => 1,
                'item' => $request->input('item.'.$i),
                'quantity' => $request->input('quantity.'.$i),
                'price' => $request->input('price.'.$i),
                'sum' => $request->input('sum.'.$i),
            ]);
        }

        return redirect()->route('order.list')->with('info', 'Užsakymas sėkmingai pridėtas');
    }

    public function postDeleteOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return redirect()->route('home');
        }

        Order::where('id', $id)->delete();

        return redirect()->route('order.list')->with('info', 'Užsakymas sėkmingai ištrintas');
    }

    public function postDeleteItem($id)
    {
        try {
            $item = Item::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return redirect()->route('home');
        }

        Item::where('id', $id)->delete();

        return redirect()->back();
    }

    public function getEditOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return redirect()->route('home');
        }

        $order = Order::where('id', $id)->first();

        if(Auth::user()->id != $order->user_id)
        {
            return redirect()->route('home');
        }

        $fresh_order = Order::where('id', $id)->first();
        $order = Order::join('items', 'orders.id', '=', 'items.order_id')->where('order_id', $id)->first();
        $orders = Order::join('items', 'orders.id', '=', 'items.order_id')->where('order_id', $id)->orderBy('position', 'ASC')->get();

        return view('template.order_edit')->with([
            'fresh_order' => $fresh_order,
            'order' => $order,
            'orders' => $orders,
        ]);
    }

    public function postEditOrder($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required|integer',
            'price.*' => 'required|numeric',
        ]);

        $order = Order::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'total' => $request->input('total'),
        ]);

        for($i = 0; $i < count($request->input('itemid')); $i++) {
            Item::where('id', $request->input('itemid.'.$i))->update([
                'position' => $i + 1,
                'item' => $request->input('item.'.$i),
                'quantity' => $request->input('quantity.'.$i),
                'price' => $request->input('price.'.$i),
                'sum' => $request->input('sum.'.$i),
            ]);
        }

        return redirect()->route('order.list')->with('info', 'Užsakymas sėkmingai atnaujintas');
    }
}
