@extends('layouts.admin')

@section('title', 'Tags List')

@section('add')
<a href="{{ route('tags.create') }}" class="btn btn-outline-info">Add</a>
@endsection

@section('content')
<div class="row container">
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tags List</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Setting</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->description }}</td>
                        <td>{{ $tag->status }}</td>
                        <td>{{ $tag->created_at->diffForHumans(now())}}</td>
                        <td>{{ $tag->updated_at->diffForHumans(now()) }}</td>
                        <td>
                             <a href="{{ route('tags.edit', [$tag->id]) }}" class="btn btn-outline-primary">Edit <i class="far fa-edit"></i></a>
                            <a href="#" onclick = "confirmDelete(this,'{{ $tag->id }}')" class="btn btn-outline-danger">delete <i class="far fa-trash-alt"></i></a>
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
            axios.delete('/admin/tags/'+id)
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
