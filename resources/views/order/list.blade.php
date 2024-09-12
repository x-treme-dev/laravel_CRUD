@extends('order.base')

@section('title')Список заказов@endsection

@section('content')
	
	<p>
		<a href="{{ route('order.create') }}">Добавить заказ</a>
	</p>

	<ol class="orders-list">
	@foreach( $orders as $order )
		<li class="order-item">
			<a title='Просмотреть заказ' href='{{ route('order.show', $order->id ) }}'
					 class="order-number">#ORD-{{ sprintf( '%05d', $order->id ) }}</a>
					 
			@include('order._info')
			
		</li>
	@endforeach
	</ol>

	<div class="pagination">
		{{-- {{ $orders->links() }} --}}
	</div>

	
@endsection