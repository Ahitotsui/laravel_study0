@extends('layouts.helloapp')

@section('title','Add')

@section('menubar')
    @parent
    新規作成ページ
@endsection

@section('content')
    <form action="/hello/add" method="post">
    <table>
        @csrf

        <tr>
            <th>name: </th>
            <td>
                <!-- validation追加してみた -->
                @error('name')
                <p>Error!!{{$message}}</p>
                @enderror
                <input type="text" name="name">
            </td>
        </tr>
        
        <tr>
            <th>email: </th>
            <td>
                <!-- validation追加してみた -->
                @error('mail')
                <p>Error!!{{$message}}</p>
                @enderror
                <input type="text" name="mail">
            </td>
        </tr>
        
        <tr>
            <th>age: </th>
            <td>
                <!-- validation追加してみた -->
                @error('age')
                <p>Error!!{{$message}}</p>
                @enderror
                <input type="text" name="age">
            </td>
        </tr>

        <tr><th></th><td><input type="submit" value="send"></td></tr>
    </table>
    </form>

    <br/><a href="/hello/">HOME</a>
@endsection

@section('footer')
copyright 2020 tuyano
@endsection