<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($brands as $brand)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg brand-ui cursor-pointer" data-setbg="{{ asset($brand->avatar) }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
