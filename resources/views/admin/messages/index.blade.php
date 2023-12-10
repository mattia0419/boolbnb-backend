@extends('layouts.app')

@section('content')
    
<div class="container">
    <h2 class="mt-3 mb-5">My Messages</h2>

    @php
        $messagesExist = false;
    @endphp

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Apartment</th>
        <th scope="col">Message</th>
        <th scope="col">From</th>
        <th scope="col">Received</th>
      </tr>
    </thead>
    <tbody>
    @foreach($messages as $message)
    @foreach($apartments as $apartment)
    @if($message->apartment_id == $apartment->id && $apartment->user_id == $user->id)
    @php
        $messagesExist = true;
    @endphp
      <tr>
        <td>
            <i>{{$apartment->title}}</i></td>
        <td>{{$message->text}}</td>
        <td>{{$message->email}}</td>
        <td>{{$message->created_at}}</td>
      </tr>
      @endif
      @endforeach
      @endforeach
    </tbody>
  </table>

    @if(!$messagesExist)
        <h4>No messages</h4>
    @endif
</div>

@endsection