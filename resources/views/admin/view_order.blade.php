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
        <div class="page-header bg-dark">
          <div class="container">
            <h1 class="mb-4 text-center text-light">All Orders</h1>
            <div class="">
              <table class="table table-dark table-striped table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                      <th>Customer Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Product Title</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Payment Status</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Print PDF</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    
                    @foreach ( $orders as $order )
                    <tr>
                      <td>{{ $order->name }}</td>   
                      <td>{{ $order->rec_address }}</td>   
                      <td>{{ $order->phone}}</td>   
                      <td>{{ $order->product->title }}</td>   
                      <td>{{ $order->product->price }}</td>   
                      <td><img src="/products/{{ $order->product->image }}" alt="" style="width: 120px;"></td>
                      <td>{{ $order->payment_status }}</td>
                      <td>
                        
                        @if ($order->status == 'in progress')
                        <span class="text-primary">{{ $order->status }}</span>
                        @elseif ($order->status == 'on the way')
                        <span class="text-warning">{{ $order->status }}</span> 
                        @else
                        <span class="text-success">{{ $order->status }}</span>  
                        @endif()
                        
                      </td> 
                      <td>
                        <a href="{{ url('on_the_way', $order->id)}}" class="btn btn-primary m-2">On the way</a>
                        <a href="{{ url('delivered', $order->id)}}" class="btn btn-success">Delivered</a>
                      </td>  
                        <td>
                        <a href="{{ url('print_pdf', $order->id)}}" class="btn btn-secondary">Print PDF</a>
                    </tr>
                    @endforeach

                  </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
      @include('admin.js')
  </body>
</html>
