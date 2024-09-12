@extends('order.base')

@section('title')Добавить заказ@endsection

@section('content')


	@if ($errors->any())
	    <div class="alert alert-danger">
	    	Проверьте правильность заполнения!
	        {{-- <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul> --}}
	    </div>
	@endif


	<form action="{{ route('order.update', $order->id ) }}" method='post'>
		@csrf
		@method('patch')
		<label for="total">
			Сумма:
			<input type="number" name="total" id="total" value='{{ old( 'total' ) ?? round( $order->total ) }}'>
			@error('total')
				<div class='form-error'>{{ $message }}</div>
			@enderror
		</label>

		<label for="email">
			Email:
			<input type="email" name="email" id="email" value='{{ old( 'email' ) ?? $order->email }}'>

			@error('email')
				<div class='form-error'>{{ $message }}</div>
			@enderror
		</label>

		<label for="customer">
			Покупатель:
			<select name="customer_id" id="customer">
				@foreach( $customers as $customer_id => $email )
					<option 
						@if( $order->customer_id == $customer_id )
							selected
						@endif
						value="{{ $customer_id }}">{{ $email }}</option>
				@endforeach
			</select>
		</label>


		<label for="comment">
			Комментарий
			<textarea name="comment" id="comment">{{ old( 'comment' ) ?? $order->comment }}</textarea>
		</label>

		<input type="submit" value="Обновить заказ">
	</form>

@endsection 