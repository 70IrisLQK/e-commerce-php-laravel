@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Brand
                </header>
                <div class="panel-body">
                    @foreach ($listBrands as $key => $item)
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <div class="position-center">
                            <form role="form" action="{{ url('/edit-brand', $item->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="brand_name" value="{{ $item->brand_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand description</label>
                                    <textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Password"
                                        name="brand_description">{{ $item->brand_description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-info">Update Brand</button>
                            </form>
                    @endforeach
                </div>

        </div>
        </section>
    </div>
    </div>
@endsection
