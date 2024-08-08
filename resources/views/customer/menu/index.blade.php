@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 text-start">
                    <h4>List Menu</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($menus as $menu)
                <div class="col-md-3 mt-4">
                    <x-menu-card :menu="$menu" :role="auth()->user()->role" />
                </div>
                @empty
                <div class="alert alert-warning">
                    Menu empty
                </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-end">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
    <form id="delete-form" method="POST" action="" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection
