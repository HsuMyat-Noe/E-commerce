<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
  <div class="hero_area">

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <table class="table table-striped table-dark table-bordered m-3">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Delivery Status</th>
            <th>Product Image</th>
        </tr>
      
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->product->title }}</td>
            <td>{{ $order->product->price }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <img src="products/{{ $order->product->image }}" alt="Product Image" style="width: 120px;">
            </td>  
        </tr> 
        @endforeach  
             
    </table>

  </div>
  <!-- end hero area -->

  <!-- info section -->
  @include('home.footer')
  <!-- end info section -->

  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>