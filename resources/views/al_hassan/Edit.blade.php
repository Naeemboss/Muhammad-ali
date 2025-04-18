<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Laravel 11 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple Laravel 11 CRUD Operation</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('al_hassan.index') }}" class="btn btn-dark">Back</a>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-3">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Edit Product</h3>
                        </div>
                        <form action="{{ route('al_hassan.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="name" class="form-label h4">Name</label>
                                    <input value="{{ old('name', $product->name) }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name" id="name">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sku" class="form-label h4">SKU</label>
                                    <input value="{{ old('sku', $product->sku) }}" type="text" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="SKU" name="sku" id="sku">
                                    @error('sku')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label h4">Description</label>
                                    <textarea name="description" class="form-control" cols="15" rows="5" id="description">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label h4">Email</label>
                                    <input value="{{ old('email', $product->email) }}" type="email" class="@error('email') is-invalid @enderror form-control form-control-lg" placeholder="Email" name="email" id="email">
                                    @error('email')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label h4">Address</label>
                                    <input value="{{ old('address', $product->address) }}" type="text" class="@error('address') is-invalid @enderror form-control form-control-lg" placeholder="Address" name="address" id="address">
                                    @error('address')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label h4">Price</label>
                                    <input value="{{ old('price', $product->price) }}" type="number" step="0.01" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price" id="price">
                                    @error('price')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label h4">Password</label>
                                    <input type="password" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="password" name="password" id="password">
                                    @error('password')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label h4">Image</label>
                                    <input type="file" class="form-control form-control-lg" name="image" id="img">

                                    @if (!empty($product->image))
                                        <?php $imageUrl = asset('upload/category/' . $product->image); ?>
                                        <img class="w-50 my-3" src="{{ $imageUrl }}" alt="Product Image">
                                    @else
                                        No image available
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
