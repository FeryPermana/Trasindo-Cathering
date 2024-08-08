@extends('layouts.app')

@section('content')
<x-profile-card :user="$data" :company="$data->customer" :role="auth()->user()->role" />
@endsection
