@extends('admin.layout.main')

@section('title', 'Data User')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Data User</h2>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>


                                <?php

                                        $nomer = 1;

                                        ?>

                                @foreach($errors->all() as $error)
                                <li>{{ $nomer++ }}. {{ $error }}</li>
                                @endforeach
                            </div>
                            @endif
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table datatables table-hover responsive nowrap" style="width:100%" id="dataTable-1">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#importModal">Import Excel</button>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach($user as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->username }}</td>


                                            <td>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $data->id }}">Delete</button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $data->id }}">Edit</button>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="defaultModalLabel">Delete Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin Ingin Menghapus Data {{ $data->name }}?
                                                    </div>
                                                    <form action="/user/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-success" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn mb-2 btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/user/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" value="{{ $data->name }}" name="name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-username" class="col-form-label">Username</label>
                        <input type="text" value="{{ $data->username }}" name="username" class="form-control" id="recipient-username" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Email</label>
                        <input type="email" value="{{ $data->email }}" name="email" class="form-control" id="recipient-email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn mb-2 btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Import Excel --}}

                                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Import Excel Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/import-excel" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">

                                                    <div class="form-group mb-3">
                                                        <label for="customFile">Custom file input</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{-- End --}}
                                <!-- Add Modal -->
                                <!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/user" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" value="" name="name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-username" class="col-form-label">Username</label>
                        <input type="text" value="" name="username" class="form-control" id="recipient-username" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-id_anggota" class="col-form-label">ID Anggota</label>
                        <input type="text" value="" name="id_anggota" class="form-control" id="recipient-id_anggota" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Email</label>
                        <input type="email" value="" name="email" class="form-control" id="recipient-email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn mb-2 btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection

@section('script')
<script>
    $('#dataTable-1').DataTable({
        autoWidth: true,
        // "lengthMenu": [
        //     [16, 32, 64, -1],
        //     [16, 32, 64, "All"]
        // ]
        dom: 'Bfrtip',


        lengthMenu: [
            [10, 25, 50, -1]
            , ['10 rows', '25 rows', '50 rows', 'Show all']
        ],

        buttons: [{
                extend: 'colvis'
                , className: 'btn btn-primary btn-sm'
                , text: 'Column Visibility',
                // columns: ':gt(0)'


            },

            {

                extend: 'pageLength'
                , className: 'btn btn-primary btn-sm'
                , text: 'Page Length',
                // columns: ':gt(0)'
            },


            // 'colvis', 'pageLength',

            {
                extend: 'excel'
                , className: 'btn btn-primary btn-sm'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // {
            //     extend: 'csv',
            //     className: 'btn btn-primary btn-sm',
            //     exportOptions: {
            //         columns: [0, ':visible']
            //     }
            // },
            {
                extend: 'pdf'
                , className: 'btn btn-primary btn-sm'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            {
                extend: 'print'
                , className: 'btn btn-primary btn-sm'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // 'pageLength', 'colvis',
            // 'copy', 'csv', 'excel', 'print'

        ]
    , });

</script>
@endsection
@section('sweetalert')
@if(Session::get('delete'))
<script>
    Swal.fire({
        icon: 'success'
        , title: 'Good'
        , text: 'Data Berhasil Di Hapus'
    , });

</script>
@endif
@if(Session::get('update'))
<script>
    Swal.fire({
        icon: 'success'
        , title: 'Good'
        , text: 'Data Berhasil Di Update'
    , });

</script>
@endif
@if(Session::get('store'))
<script>
    Swal.fire({
        icon: 'success'
        , title: 'Good'
        , text: 'Data Berhasil Di Tambahkan'
    , });

</script>
@endif
@endsection
