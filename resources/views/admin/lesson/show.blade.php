@extends('layoutAdmin.main')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail Lesson</h3>
                        <a href="{{ route('admin.lesson.index') }}" class="btn btn-default btn-sm pull-right">
                            <i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header" style="background-color: #6044a4;">
                                    </div>
                                    <div class="box-footer">
                                        <table class="table table-hover">
                                            <div>
                                                <tr>
                                                    <th>Name</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $lesson->name }}</td>
                                                </tr>
                                            </div>
                                            <div>
                                                <tr>
                                                    <th>Link</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $lesson->link }}</td>
                                                </tr>
                                            </div>
                                            <div>
                                                <tr>
                                                    <th>Category</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $lesson->category->name ?? '-' }}</td>

                                                </tr>
                                            </div>
                                            <div>
                                                <tr>
                                                    <th>Description</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $lesson->description }}</td>
                                                </tr>
                                            </div>
                                            <div>
                                                <tr>
                                                    <th>Thumbnail</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($lesson->thumbnail) }}" alt="Profile"
                                                            width="100%">
                                                    </td>
                                                </tr>
                                            </div>
                                        </table>
                                        <div>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.lesson.edit', $lesson->id) }}"
                                                        class="btn btn-primary btn-block"><i class="fa fa-edit"></i>
                                                        Edit</a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger btn btn-primary btn-block"
                                                        data-toggle="modal" data-target="#delete"><i
                                                            class="fa fa-trash"></i>
                                                        Delete</button>
                                                    @if ($lesson->category_id != null)
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger btn btn-primary btn-block"
                                                            data-toggle="modal" data-target="#delete-category"><i
                                                                class="fa fa-trash"></i>
                                                            Delete Category</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Delete -->
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.lesson.destroy', $lesson->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Data</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete this data ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="delete-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.lesson.removeCategory', $lesson->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Data</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to remove {{ $lesson->name }} from {{ $lesson->category->name ?? '' }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
