@extends('layoutAdmin.main')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit selected category : {{ $category->name }}</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ url('category/update', $category->id) }}" method="POST">
                            @csrf
                            <div style="margin-bottom: 20px;">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
