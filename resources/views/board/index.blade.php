@extends('layouts.helloapp')

@section('title','Index')

@section('menubar')
    @parent
    ホストページ
@endsection


@section('content')
    
    <table>
    <tr><th>Message</th><th>Name</th></tr>
    @foreach ($items as $item)
        <tr>
            <td>{{$item->message}}</td>
            <td>{{$item->person['name']}}</td>
        </tr>
    @endforeach
    </table>

    <a href="/board/add">ADD</a>
    <a href="/person">HOME</a>

@endsection

@section('footer')
copyright 2020 tuyano
@endsection





