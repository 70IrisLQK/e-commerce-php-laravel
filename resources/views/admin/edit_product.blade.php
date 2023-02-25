@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Product
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($listProducts as $product)
                            <form role="form" action="{{ URL::to('/edit-product/' . $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="product_name" value="{{ $product->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product price</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="product_price"
                                        value="{{ $product->product_price }}>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product image</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="product_image" value={{ $product->product_image }}>
                                    <img class="img-product"
                                        src="{{ URL::asset('uploads/product/' . $product->product_image) }}"
                                        alt="{{ $product->product_image }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product description</label>
                                    <textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Password"
                                        name="product_description">{{ $product->product_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product content</label>
                                    <textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Password"
                                        name="product_content">{{ $product->product_content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category</label>
                                    <select class="form-control input-lg m-bot15" name="category">
                                        @foreach ($listCategories as $category)
                                            @if ($category->id == $product->category_id)
                                                <option selected value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand</label>
                                    <select class="form-control input-lg m-bot15" name="brand">
                                        @foreach ($listBrands as $brand)
                                            @if ($brand->id == $product->brand_id)
                                                <option selected value="{{ $product->id }}">{{ $brand->brand_name }}
                                                </option>
                                            @else
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Save Product</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
