@extends('layouts.helloapp')

@section('title','Seach')

@section('menubar')
    @parent
    検索ページ
@endsection

@section('content')
    @if ($items != null)
        @foreach($items as $item)
            <table width="500px">
                <tr>
                    <th width="50px">id: </th><td width="100px">{{$item->id}}</td>
                    <th width="50px">name: </th><td width="200px">{{$item->name}}</td>
                </tr>
            </table>
        @endforeach
    @endif
    <br/><a href="/hello/">HOME</a>
@endsection

@section('footer')
copyright 2020 tuyano
@endsection