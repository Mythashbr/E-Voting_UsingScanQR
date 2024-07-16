@extends('admin.layout.main')

@section('title', 'Suara Pemilihan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Suara Pemilihan</h2>
            {{-- <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p> --}}
            <div class="card shadow">
                <div class="card-body">
                    <form action="/cari-suara-pemilihan" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="example-select">Pemilihan</label>
                            <select name="id_pemilihan" class="form-control" id="example-select">

                                @if (Session::get('id_pemilihan') != null)
                                <option selected value="{{ Session::get('id_pemilihan') }}">
                                    <?php
                                        $pemilihaan = DB::table('tb_pemilihan')->where('id', Session::get('id_pemilihan'))->first();
                                        echo $pemilihaan->name;
                                        ?>

                                </option>
                                @else
                                <option selected value="0">Pilih Pemilihan</option>
                                @endif

                                @foreach($pemilihan as $dataa)
                                <option value="{{ $dataa->id }}">{{ $dataa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
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
                                    

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Calon</th>
                                            <th>Jumlah Suara</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach($jumlahsuara as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            @if($data->id_calon == null)
                                            <td></td>
                                            <td></td>
                                            @else
                                            <?php
                                            $calon = App\Models\Calon::where('id', $data->id_calon)->first();
                                            ?>
                                            <td>{{ $calon->name }}</td>
                                            <td>{{ $data->jumlahsuara }}</td>
                                            @endif

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
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
@if(Session::get('create'))
<script>
    Swal.fire({
        icon: 'success'
        , title: 'Good'
        , text: 'Data Berhasil Di Tambahkan'
    , });

</script>
@endif
@endsection
