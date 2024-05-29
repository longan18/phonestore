<div class="col-6 col-md-4 col-lg-3 item-shop-product">
    <div class="featured__item">
        <div class="featured__item__pic">
            <img src="{{ asset('images/img-product-600x600.jpg') }}" alt="">
            @if($product['new_product'])
                <div class="flag-new-product">
                    <b>Sản phẩm mới</b>
                </div>
            @endif
            <ul class="featured__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="featured__item__text">
            <h6><a href="#">{{ $product['name'] }}</a></h6>
            <div class="d-flex justify-content-between">
                <div class="currency-text">29,590,000<sup>đ</sup></div>
                <div class="sell-text">30,590,000<sup>đ</sup></div>
            </div>
        </div>
    </div>
</div>
