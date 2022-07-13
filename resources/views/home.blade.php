@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<div class="card text-left">
  <img class="card-img-top" src="{{ asset('img/traking.svg') }}" alt="">
  <div class="card-body">
    <h4 class="card-title">{{ config('app.name','') }}</h4>
    <p class="card-text">{{ date('Y') }}</p>
  </div>
</div>
@endsection
