@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Category
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
                        <form role="form" action="{{ URL::to('/save-category') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category description</label>
                                <textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Password"
                                    name="category_desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select class="form-control input-lg m-bot15" name="category_status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Save Category</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
