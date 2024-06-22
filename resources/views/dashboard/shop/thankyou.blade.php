@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="container mx-auto py-5">
        <a href="{{ route('order.index', auth()->user()->name) }}" class="block flex mx-auto justify-center  w-[80%]  "><img
                src="{{ asset('images/thankyou.png') }}" alt="Thankyou Image"
                class="block  w-[50%] h-[50%] object-cover object-center">
        </a>
        <p class="text-center text-xl">Thankyou.. Your Order Has Been Confirmed.. <a
                href="{{ route('order.index', auth()->user()->name) }}" class="inline-block text-blue-500 underline">Check
                Now</a></p>
        <p class="text-center text-xl">User Order ID <i class="text-yellow-500 font-bold"> <a
                    href="{{ route('order.index', auth()->user()->name) }}">{{ session()->get('user_order_id') }}</a></i>
        </p>

    </div>
@endsection
