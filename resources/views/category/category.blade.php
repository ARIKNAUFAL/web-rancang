@extends('layoutAdmin.main')
@section('useDataTable', '1')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('success') }}
                </div>
                @endif
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data For Table User</h3>
                    </div>
                    <div class="box-header">
                        <a href="{{url('category/create')}}" class="btn btn-success btn-sm pull-left" style="margin-right: 5px;"><i
                                class="fa fa-user"></i>
                            Add Category</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
    @forelse ($category as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>
                <a href="{{ url('category/edit/'.$data->id) }}" class="btn btn-primary">Edit</a>
                <!-- Delete Button -->
                <form action="{{ url('category/delete/'.$data->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">No categories found.</td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
