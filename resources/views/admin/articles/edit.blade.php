@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')

@if (session()->has('alert-type'))
<div class="alert {{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
    {{ session()->get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
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
            <form action="{{ route('articles.update', [$article->id]) }}" method="POST"
            enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="name" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title) }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Tag Name</label>
                        <select class="form-control" id="tag_id" name="tag_id">
                            <option>-- Select --</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" selected="{{ $article->tag_id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" rows="3" placeholder="Enter ..." name="short_description">{{ old('short_description', $article->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Full Description</label>
                        <textarea class="form-control @error('full_description') is-invalid @enderror" rows="3" placeholder="Enter ..." name="full_description">{{ old('full_description', $article->full_description) }}</textarea>
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
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="Active" @if (old('status', $article->status) == 'Active') checked @endif checked>
                          <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="Draft" @if (old('status', $article->status) == 'Draft') checked @endif>
                          <label class="form-check-label">Draft</label>
                        </div>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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
