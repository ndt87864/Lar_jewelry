@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh mục</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <!-- Hình ảnh có chiều cao cố định và căn giữa -->
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                             class="card-img-top" style="height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/products/no.jpg') }}" alt="Không có hình" 
                             class="card-img-top" style="height: 150px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column text-center">
                        <a href="{{ route('products.list', $category->name) }}" class="text-decoration-none">
                            <h5 class="card-title text-dark">{{ $category->name }}</h5>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
