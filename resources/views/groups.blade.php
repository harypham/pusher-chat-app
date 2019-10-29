@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="row">
                <div class="col-8">
                    <create-group :users="{{ $users }}" :iduser="{{ $idUser }}"></create-group>
                </div>
                <hr>
                <div class="col-8">
                    <group-chat></group-chat>
                </div>
            </div>
    </div>
@endsection
