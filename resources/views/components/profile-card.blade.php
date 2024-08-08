<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center py-3">
                <img src="{{ asset('assets/image/avatar.png') }}" alt="Avatar" class="img-fluid rounded-circle mt-3" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
                <hr>
                <div class="text-left">
                    <p>Company Name : {{ $company->company_name ?? '-' }}</p>
                    <p>Address : {{ $company->address ?? '-' }}</p>
                    <p>Contact : {{ $company->contact ?? '-' }}</p>
                    @if ($role == "merchant")
                        <h5>Description</h5>
                        <p>{{ $company->description ?? '-' }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header"><h4>Lengkapi profile anda</h4></div>
            <div class="card-body">
                <form action="{{ $role === 'merchant' ? route('merchant.profile.update', $user->id) : route('customer.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">PIC Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}">
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $company->address ?? '') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="number" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $company->contact ?? '') }}">
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if ($role == "merchant")
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', $company->description ?? '') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary text-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
