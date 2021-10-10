@extends('layouts.admin')

@section('title', 'Articles List')

@section('add')
<a href="{{ route('articles.create') }}" class="btn btn-outline-info">Add</a>
@endsection

@section('content')
<div class="row container">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">

          <div class="card-tools">
            <form action="{{ route('articles.index') }}">
                <div class="d-flex align-items-center">
                    <div class="form-group mr-2">
                        <input class="form-control" type="text" name="title" placeholder="Articles Name" value="{{ request('title') }}">
                    </div>
                    <div class="form-group mr-2">
                        <select class="form-control" name="tag_id" id="tag_id">
                            <option value="" style="color: #495057;">-- Select tag --</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <button type="submit" class="btn btn-outline-secondary">Filtter</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">clear</a>
                    </div>
                </div>
            </form>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>tag Name</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Full Description</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->tag->name }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->short_description }}</td>
                        <td>{{ $article->full_description }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>
                            <a href="{{ route('articles.edit', [$article->id]) }}" class="btn btn-outline-primary">Edit <i class="far fa-edit"></i></a>
                           <a href="#" onclick = "confirmDelete(this,'{{ $article->id }}')" class="btn btn-outline-danger">delete <i class="far fa-trash-alt"></i></a>
                       </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/axios.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(app, id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    deleteCity(app, id);
                }
              })
        }
        function deleteCity(app, id){
            axios.delete('/admin/articles/'+id)
            .then(function (response) {
                // handle success
                console.log(response);
                app.closest('tr').remove();
                showDeleted(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }

        function showDeleted(data){
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                showConfirmButton:false,
                timer: 2000,
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  console.log('I was closed by the timer')
                }
              })
        }
    </script>


@endsection


