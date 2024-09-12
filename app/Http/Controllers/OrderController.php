<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Skill;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;


use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    private function demoOrder()
    {

        $c1 = new Customer;
        $c1->firstname = 'Thomas';
        $c1->lastname = 'Miller';
        $c1->email = 'thomas@mail.ru';
        $c1->phone = '+158 9432434';
        $c1->save();

        $c2 = new Customer;
        $c2->firstname = 'Jack';
        $c2->lastname = 'Stephenson';
        $c2->email = 'jack@steve.com';
        $c2->phone = '+8234923489';
        $c2->save();

        $o = new Order;
        $o->customer_id = $c1->id;
        $o->email = $c1->email;
        $o->comment = 'demoOrder';
        $o->total = mt_rand( 1000, 10000 );
        $o->save();

        $o = new Order;
        $o->customer_id = $c2->id;
        $o->email = $c2->email;
        $o->total = mt_rand( 1000, 10000 );
        $o->comment = 'Shipping required';
        $o->save();

        $sk1 = new Skill;
        $sk1->name = 'PHP';
        $sk1->save();

        $sk2 = new Skill;
        $sk2->name = 'JavaScript';
        $sk2->save();

        DB::table( 'customer_skill' )->insert( [
            [ 'customer_id' => $c1->id, 'skill_id'    => $sk1->id ],
            //[ 'customer_id' => $c2->id, 'skill_id'    => $sk2->id ]
        ] );

        //$c2->skills()->attach( $sk1 );
        //$c2->skills()->detach( $sk1 );
        //$c2->skills()->sync( $sk1 );
        $c2->skills()->attach( [ $sk1->id, $sk2->id ] );
    }

    public function index()
    {
        if( Order::get()->isEmpty() ) {
            $this->demoOrder();
        }

        $orders = Order::all();
        //$orders = Order::paginate( env('PER_PAGE') ?? 10 );
        return view('order.list', compact( 'orders' ));
    }

    public function show( Order $order )
    {
        return view('order.show', compact( 'order' ));
    }

    public function create()
    {
        $customers = Customer::all()->pluck( 'email', 'id' );
        return view('order.create', compact( 'customers' ));
    }

    public function store( StoreRequest $request )
    {
        /*$data = \request()->all();
        dd( $data );*/

        $data = $request->validated();
        
        Order::create( $data );

        return redirect()->route('order.list');
    }

    public function update( UpdateRequest $request, Order $order )
    {
        /*$data = \request()->all();
        dd( $data );*/

        $data = $request->validated();
        $order->update( $data );

        return redirect()->route('order.show', $order->id );
    }


    public function edit( Order $order )
    {
        $customers = Customer::all()->pluck( 'email', 'id' );        
        return view('order.edit', compact( 'order', 'customers' ));
    }

    public function destroy( Order $order )
    {
        $order->delete();
        return redirect()->route('order.list');
    }

    public function list()
    {
        $orders = Order::get();
        if( $orders->isEmpty() ) {
            $this->demoOrder();
            $orders = Order::get();
        }

        $skill = Skill::find(1);

        dd( $orders );
        dd( $skill->customers->toArray() );

        //


        //dd( $orders->first()->customer->fullname() );

        $customer = Customer::first();
        ///dd( $customer->orders->first()->email );
        dd( $customer->skills->implode( 'name', ', ' ));

        $orders = Order::whereBelongsTo( $customer )->get()->first()->getKey();
       // dd( $orders );
    }
}
