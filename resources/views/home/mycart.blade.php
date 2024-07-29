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

  </div>
  <!-- end hero area -->

   <!-- cart start -->
    <div class="container my-4">

      @if (session()->has('message'))
      <div class="alert alert-success">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert" aria-hidden="true">X</button>
              {{ session()->get('message') }}
      </div>               
      @endif
      
      <div class="row d-flex flex-column gap-3 justify-content-center align-items-center">

        <div class="col-8">
          <table class="table table-light table-striped table-bordered text-center">
            <?php
              $total_price = 0;
            ?>
              <tr>
                  <th>Product Title</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Action</th>
              </tr>
    
              @foreach ($carts as $cart)
              <tr>
                  <td>{{ $cart->product->title }}</td>
                  <td>{{ $cart->product->price }}</td>
                  <td><img src="/products/{{ $cart->product->image }}" alt="" style="width: 120px"></td>
                  <td>
                    <a onclick="return confirm('Are your sure to delete this?')" href="" class="btn btn-danger">
                      Remove
                    </a>
                  </td>
              </tr>  
              <?php
                $total_price += $cart->product->price;
              ?>                   
              @endforeach   
          </table> 
        </div>

        <div class="p-4 text-center">
          <h3>Total Price : <span class="text-success">${{ $total_price }}</span></h3>
        </div>
        <form action="{{ url('comfirm_order') }}" method="POST" class="col-4">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Receiver Name</label>
            <input type="text" class="form-control" id="name" name="rec_name" value="{{ Auth::user()->name }}">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Receiver Address</label>
            <textarea class="form-control" id="address" name="rec_address" rows="3">
              {{ Auth::user()->address }}
            </textarea>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Receiver Phone</label>
            <input type="number" class="form-control" id="rec_phone" name="rec_phone"
              value="{{ Auth::user()->phone }}">
          </div>
  
          <button type="submit" class="btn btn-primary">Cash On Delivery</button>
          <a href="{{ url('stripe', $total_price) }}" class="btn btn-success">Pay Using Card</a>
        </form>
      </div>


  

    </div>
   <!-- cart end -->


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