@extends('layoutAdmin.main')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add New Category</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ url('category/store') }}" method="POST">
                            @csrf
                            <div style="margin-bottom: 20px;">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
