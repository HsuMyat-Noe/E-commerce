<section class="shop_section layout_padding">
    <div class="container">
      @if (session()->has('message'))
      <div class="alert alert-success">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert" aria-hidden="true">X</button>
              {{ session()->get('message') }}
      </div>               
      @endif

      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="products/{{ $product->image }}" alt="">
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
              <a href="{{ url('product_details', $product->id) }}" class="btn btn-primary text-white m-3">Detail</a>

              <a href="{{ url('add_cart', $product->id) }}" class="btn btn-success text-white">Add to cart</a>

              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        @endforeach


      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>