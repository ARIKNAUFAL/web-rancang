@extends('layoutAdmin.main')
@section('useDataTable', '1')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data For Table Lesson Lesson</h3>
                    </div>
                    <div class="box-header">
                        <a href="{{ route('admin.lesson.create') }}" class="btn btn-success btn-sm pull-left"><i
                                class="fa fa-plus"></i>
                            Add Data</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th>Name</th>
                                    <th>Thumbnail</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lessons as $lesson)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lesson->name }}</td>
                                        <td>
                                            <img src="{{ asset($lesson->thumbnail) }}" alt="Profile" width="90px">
                                        </td>
                                        <td>{{ $lesson->description }}</td>
                                        <td>{{ $lesson->link }}</td>
                                        <td>{{ $lesson->category->name ?? '-' }}</td>
                                        <td>
                                            
                                            <a href="{{ route('admin.lesson.show', $lesson->id) }}"
                                                class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                                Detail</a>
                                            <a href="{{ route('admin.lesson.roadmap', $lesson->category_id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>
                                                Roadmap</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
