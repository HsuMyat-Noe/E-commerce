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

            <h1 class="text-light text-center h-4 mt-4">Update Category</h1>

            <div class="d-flex justify-content-center align-items-center m-5">
                <form action="{{ url('update_category', $category->id) }}" method="POST">
                    @csrf
                    <div class="">
                        <input type="text" name="category" value="{{ $category->category_name }}" style="width:400px; padding:10px">
                        <input type="submit" value="Update Category" class="btn border border-primary text-primary bg-transparent p-2">
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
