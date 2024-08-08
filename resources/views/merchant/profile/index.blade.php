@extends('layouts.app')

@section('content')
<x-profile-card :user="$data" :company="$data->merchant" :role="auth()->user()->role" />
@endsection
