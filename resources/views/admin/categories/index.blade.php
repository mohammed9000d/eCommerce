@extends('layouts.admin')

@section('title', 'Categories List')

@section('content')
<div class="row">
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
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">Add</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Setting</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                      <tr>
                          <td>{{ $category->id }}</td>
                          <td>{{ $category->name }}</td>
                          <td>{{ $category->slug }}</td>
                          <td>{{ $category->description }}</td>
                          <td>{{ $category->status }}</td>
                          <td>{{ $category->created_at->diffForHumans(now())}}</td>
                          <td>{{ $category->updated_at->diffForHumans(now()) }}</td>
                          <td>
                               <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-outline-primary">Edit <i class="far fa-edit"></i></a>
                              <a href="#" onclick = "confirmDelete(this,'{{ $category->id }}')" class="btn btn-outline-danger">delete <i class="far fa-trash-alt"></i></a>
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
            axios.delete('/admin/categories/'+id)
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


