<section class="hero">
    <div class="container">
        <div class="row">
            {{--            <div class="col-lg-12 w-100 mb-5">--}}
            <div class="col-lg-12 w-100">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('client.home') }}">
                            <input type="text" placeholder="Nhập tên sản phẩm" name="name" value="{{ request('name') ?? '' }}" autocomplete="off">
                            <button type="submit" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container"></div>
</section>
