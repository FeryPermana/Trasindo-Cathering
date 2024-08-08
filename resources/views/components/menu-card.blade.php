<div class="card" style="width: 18rem;">
    <img src="{{ $menu->photo }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $menu->name }}</h5>
        <span>Rp. {{ $menu->formattedPrice() }}</span>
        <p class="card-text">{{ $menu->description }}</p>
        @if ($role === 'merchant')
        <div class="d-flex gap-3">
            <a href="{{ route('merchant.menu.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
            <button class="btn btn-danger delete-btn" data-id="{{ $menu->id }}">Delete</button>
        </div>
        @else
            <div class="d-flex justify-content-between gap-3">
                <input type="number" class="form-control" placeholder="1">
                <a href="" class="btn btn-warning">Order</a>
            </div>
        @endif
    </div>
</div>
