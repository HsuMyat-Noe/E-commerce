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

            <h1 class="text-light text-center h-4 mt-4">Add Category</h1>

            <div class="d-flex justify-content-center align-items-center m-5">
                <form action="{{ url('add_category') }}" method="POST">
                    @csrf
                    <div class="">
                        <input type="text" name="category" id="" placeholder="Write Category Name" style="width:400px; padding:10px">
                        <input type="submit" value="Add Category" class="btn border border-primary text-primary bg-transparent p-2">
                    </div>
                </form>
            </div>

            <table class="table table-dark table-striped">
                <thead class="thead-light">
                    <tr>
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    
                    @foreach ( $categories as $category )
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="{{ url('edit_category', $category->id) }}" class="btn     btn-success">Edit</a>
                            <a onclick="return confirm('Are your sure to delete this?')" href="{{ url('delete_category', $category->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                  </tbody>
            </table>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
