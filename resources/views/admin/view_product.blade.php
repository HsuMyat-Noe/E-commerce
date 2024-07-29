<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>

    @include('admin.header')

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
        @include('admin.slide')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header  bg-dark">
          <div class="container-fluid">

            <div class="container w-100">
              @if (session()->has('message'))
              <div class="alert alert-success">
                  <button type="button" class="close" aria-label="Close" data-dismiss="alert" aria-hidden="true">X</button>
                      {{ session()->get('message') }}
              </div>               
              @endif
  
                <div class="d-flex gap-3 mt-2">
                  <form action="{{ url('search_product') }}" method="POST" class="col-md-6">
                    @csrf
                    <div class="input-group">
                      <input type="text" class="form-control bg-white text-dark" name="search">
                      <button class="btn btn-primary">Search</button>
                    </div>
                  </form>
    
                    <div class="col-md-6">
                        {{ $products->links() }}
                    </div>
                </div>
  
                <table class="table table-dark table-striped table-bordered m-2">
                    <tr>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quatity</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
    
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{!! Str::limit( $product->description, 50) !!}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quatity }}</td>
                        <td><img src="products/{{ $product->image}}" alt="product_image" style="width: 100px; height:100px"></td>
                        <td>
                          <a href="{{ url('edit_product', $product->id) }}" class="btn btn-success">Edit</a>
  
                          <a onclick="return confirm('Are your sure to delete this?')" href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">
                            Delete
                          </a>
                        </td>
                    </tr>                     
                    @endforeach   
                </table> 
            </div>
         
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
