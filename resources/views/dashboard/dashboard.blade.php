@extends('layouts.main')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 left-align">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Product</li>
                </ol>

                <!-- Display success or error messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row justify-content-start">
                    <!-- Menampilkan Produk -->
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <!-- Membungkus card dengan tag <a> untuk menjadikannya bisa diklik -->
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <div class="card">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top card-img-dashboard" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/150" class="card-img-top card-img-dashboard" alt="{{ $product->name }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-truncate">{{ $product->description }}</p>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endpush
