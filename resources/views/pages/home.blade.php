@extends('app')

@section('content')
    <x-flexible-hero :page="$post"/>
    <div>
        <x-flexible-content-blocks :page="$post" />
    </div>
@endsection