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

  <!-- product details start -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="box">
            <a href="">
              <div class="d-flex justify-content-center align-items-center p-3">
                <img src="/products/{{ $product->image }}" alt="" style="width: 400px">
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->title }}
                </h6>
                <h6>
                  Price
                  <span>
                    {{ $product->price }}
                  </span>
                </h6>
              </div>
              <div class="detail-box">
                <h6>
                  Category
                  <span>
                    {{ $product->category }}
                  </span>
                </h6>
                <h6>
                  Available Item
                  <span>
                    {{ $product->quatity }}
                  </span>
                </h6>
              </div>
              <div class="detail-box">
                  <p>
                    {{ $product->description }}
                  </p>
              </div>

              <a href="{{ url('add_cart', $product->id) }}" class="btn btn-success text-white">Add to cart</a>

              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end product details -->


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