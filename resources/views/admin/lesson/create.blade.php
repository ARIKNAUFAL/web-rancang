@extends('layoutAdmin.main')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Form Add Lesson</h3>
                        <a href="{{ route('admin.lesson.index') }}" class="btn btn-default btn-sm pull-right">
                            <i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('admin.lesson.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text text-danger mb-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text text-danger mb-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" class="form-control" name="link"
                                                placeholder="Enter link" value="{{ old('link') }}">
                                            @error('link')
                                                <span class="text text-danger mb-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" cols="20" rows="5">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text text-danger mb-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thumbnail</label>
                                            <input type="file" class="form-control" name="thumbnail"
                                                placeholder="Enter thumbnail" id="preview_gambar" accept=".jpg,.png,.jpeg">
                                            @error('thumbnail')
                                                <span class="text text-danger mb-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Preview Thumbnail</label><br>
                                            <img src="{{ asset('dist/image/lesson/default.png') }}" id="gambar_load"
                                                width="150" height="" alt="Photo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#preview_gambar').change(function() {
            bacaGambar(this);
        })
    </script>

    @if (old('category_id') != null)
        <script>
            $('#category_id').val('{{ old('category_id') }}');
        </script>
    @endif
@endsection
