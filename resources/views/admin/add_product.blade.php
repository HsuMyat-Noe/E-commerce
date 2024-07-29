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

      <div class="page-content bg-dark">
        <div class="page-header bg-dark">
          <div class="container-fluid">

            @if (session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{ session()->get('message') }}
            </div>
                
            @endif

            <h1 class="text-light text-center h-4 mt-4">Add Product</h1>

            <div class="container p-5 w-75">
                <form action="{{ url('upload_product' )}}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                      <label for="title" class="form-label">Product Title</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="col-12 mt-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                    </div>

                    <div class="col-md-4 mt-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="number" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>

                    <div class="col-md-4 mt-3">
                      <label for="category" class="form-label">Product Category</label>
                      <select id="category" class="form-control form-select" name="category">
                        <option selected>Select Option</option>

                        @foreach ($categories as $category)
                        <option value="{{ $category->category_name }}">
                            {{ $category->category_name }}
                        </option>  
                        @endforeach
                       
                      </select>
                    </div>

                    <div class="col-12 mt-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    
                    <div class="col-12 mt-4">
                      <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                    
                  </form>
            </div>


          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
