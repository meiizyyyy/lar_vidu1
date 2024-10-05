<h2 class="mt-5 mb-2 justify-content-center d-flex">Sản Phẩm Mới Nhất</h2>
<div class="container-fluid">
    <div id="newArrivalsCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($newArrivals->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $product)
                            <div class="col-sm-6 col-md-3 mb-4">
                                <a href="{{ route('products.show', $product->product_id) }}" class="product-card h-100 d-block">
                                    <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img" alt="{{ $product->name }}">
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2">
                                            <h5 class="mb-0">{{ $product->name }}</h5>
                                        </div>
                                        <hr class="mt-2">
                                        <div class="d-flex justify-content-between pb-2">
                                            <div class="d-flex flex-column">
                                                <span class="text-muted">Còn lại</span>
                                                <h5 class="mb-0">{{ $product->stock }}</h5>
                                            </div>
                                            <div class="d-flex flex-column text-right">
                                                <small class="text-muted">Danh mục</small>
                                                <h6 class="mb-0">{{ $product->category->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mid flex-grow-1">
                                            <div class="d-flex flex-column">
                                                <h3 class="mb-0 text-danger">{{ number_format($product->price, 0) }}đ</h3>
                                            </div>
                                            <div class="d-flex flex-column text-right">
                                                <small class="text-muted mb-1">Đánh giá</small>
                                                <h6 class="mb-0">{{ $product->rating ?? 'N/A' }}</h6>
                                            </div>
                                        </div>
                                        <div class="card__btn mx-3 mt-4 mb-2">
                                            <button type="button" class="btn btn-danger btn-block add-to-cart"
                                                data-product-id="{{ $product->product_id }}">
                                                <small>THÊM VÀO GIỎ</small>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#newArrivalsCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#newArrivalsCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
