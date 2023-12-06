@extends('layouts.app')

@section('content')
    
<div class="container">
    <h2 class="mt-3 mb-5">Your messages</h2>

    @php
        $messagesExist = false;
    @endphp

    @foreach($messages as $message)
        @foreach($apartments as $apartment)
            @if($message->apartment_id == $apartment->id && $apartment->user_id == $user->id)
                @php
                    $messagesExist = true;
                @endphp
                <h4>{{$apartment->title}}</h4>
                <span>Email: {{$message->email}}</span>
                <p>Message: {{$message->text}}</p>
            @endif
        @endforeach
    @endforeach

    @if(!$messagesExist)
        <h4>No messages</h4>
    @endif
</div>

@endsection