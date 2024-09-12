
	<div class="order-total">{{ round( $order->total, 2 ) }}</div>
	<a class="order-email"><a href='mailto:{{ $order->email }}'>{{ $order->email }}</a>
	@if( $order->comment )
		<p>{{ $order->comment }}</p>
	@endif
	
	<small class="order-date">Дата создания: {{ date('d.m.Y H:i', strtotime( $order->created_at )); }}</small>
	
	@if( $order->updated_at != $order->created_at )
		<small class="order-date">ОБновлен: {{ date('d.m.Y H:i', strtotime( $order->updated_at )) }}</small>
	@endif

	<p class='customer'>Покупатель <br>
		<strong> {{ $order->customer->fullName() }} 
			<small>({{ $order->customer->skillsList() }})</small>
			</strong>
	</p>

	<br>
	<a class='action-link' title='Редактировать заказ' 
		href='{{ route('order.edit', $order->id ) }}'>Правка</a>
	<form action="{{ route('order.destroy', $order->id ) }}" method='post'>
		@csrf
		@method('delete')
		<input class='action-link' type="submit" value="Удалить">
	</form>