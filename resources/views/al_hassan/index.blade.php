<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Laravel 11 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   
   <style>
        
        .table {
            border: 2px solid #000; /* Change color and width as needed */
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000; /* Solid border for table cells */
        }
    </style>

</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple Laravel 11 CRUD Operation</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('al_hassan.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Description</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Price</th>
                                <th>Password</th> <!-- Added Password Header -->
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>

                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if (!empty($product->image))
                                                <?php $imageUrl = asset('upload/category/' . $product->image); ?>
                                                <img width="50" src="{{ $imageUrl }}" alt="Product Image">
                                            @else
                                                No image available
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->email }}</td>
                                        <td>{{ $product->address }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>${{$product->password}}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('al_hassan.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                            <a href="#" onclick="event.preventDefault(); deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                                            <form id="delete-alhassan-form{{ $product->id }}" action="{{ route('al_hassan.destroy', $product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" class="text-center">No products found.</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        document.getElementById('delete-alhassan-form' + productId).submit();
    }
}
</script>
