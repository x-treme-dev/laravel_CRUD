@extends('order.base')

@section('title')Детали заказа №ORD-{{ $order->id }}@endsection

@section('content')
	 @include( 'order._info', [ 'order' => $order ] )
@endsection