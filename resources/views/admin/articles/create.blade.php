@extends('layouts.admin')

@section('title', 'Create Article')

@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">New Article</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('articles.store') }}" method="POST"
            enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="name" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Tag Name</label>
                        <select class="form-control @error('tag_id') is-invalid @enderror" id="tag_id" name="tag_id">
                            <option>-- Select --</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tag_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" rows="3" placeholder="Enter ..." name="short_description">{{ old('short_description') }}</textarea>
                        @error('short_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Full Description</label>
                        <textarea class="form-control @error('full_description') is-invalid @enderror" rows="3" placeholder="Enter ..." name="full_description">{{ old('full_description') }}</textarea>
                        @error('full_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="exampleInputFile" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
