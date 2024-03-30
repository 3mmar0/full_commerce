<x-front-layout title="{{ $product->slug }}">
    <x-slot name="breadcrumb">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $product->slug }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products') }}"> Products</a></li>
                            <li>single Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ $product->image_url }}" id="current" alt="#">
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <form action="{{ route('cart.store') }}" method="POST" class="product-info">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                            <h2 class="title">{{ $product->name }}</h2>
                            <p class="category"><i class="lni lni-tag"></i> {{ $product->category->name }}</p>
                            <h3 class="price">{{ Currency::format($product->price) }}
                                @if ($product->compare_price)
                                    <span>{{ Currency::format($product->compare_price) }}</span>
                                @endif
                            </h3>
                            <p class="info-text line-clamp-3">{{ $product->disc }}</p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group quantity">
                                        <label for="color">Quantity</label>
                                        <select class="form-control" name="quantity">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group quantity">

                                        <label for="color" style="opacity: 0">add</label>
                                        <div class="button cart-button">
                                            <button type="submit" class="btn" style="width: 100%;">Add to
                                                Cart</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-body custom-responsive-margin">
                                <h4>Details</h4>
                                <p>{{ $product->disc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Item Details -->

    @push('scripts')
        <script type="text/javascript">
            const current = document.getElementById("current");
            const opacity = 0.6;
            const imgs = document.querySelectorAll(".img");
            imgs.forEach(img => {
                img.addEventListener("click", (e) => {
                    //reset opacity
                    imgs.forEach(img => {
                        img.style.opacity = 1;
                    });
                    current.src = e.target.src;
                    //adding class
                    //current.classList.add("fade-in");
                    //opacity
                    e.target.style.opacity = opacity;
                });
            });
        </script>
    @endpush
</x-front-layout>
