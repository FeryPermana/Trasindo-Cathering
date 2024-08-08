@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 text-start">
                    <h4>List Menu</h4>
                </div>
                <div class="col-md-8 text-end">
                    <a href="{{ route('merchant.menu.create') }}" class="btn btn-primary">Tambah Menu</a>
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
                    Data empty please input your menu
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

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const url = `{{ url('/merchant/delete-menu') }}/${id}`;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be delete this menu!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form');
                            form.action = url;
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
