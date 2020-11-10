@extends('layouts.adm-app')

@section('content')
    <section class="content-header">
        <h1>
            Apoteker
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fas fa-tachometer-alt"></i> {{ session('role') }}</a></li>
            <li class="active">Apoteker</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        @include('layouts.inc.messages')

        <!-- Doctor List -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <strong>Daftar Apoteker</strong>
                <div class="pull-right">
                    <a href="{{route('pharmacist.create')}}" class="btn btn-success">
                        <strong>
                            <i class="fa fa-plus"></i>
                            &nbsp;Tambah Apoteker
                        </strong>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(count($pharmacists) > 0)
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nama Apoteker</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Ditinjau</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Terakhir diubah</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"></th>
                                    </tr>
                                    </thead>
                                    @foreach($pharmacists as $pharmacist)
                                    <tbody>
                                    <tr role="row" class="odd">
                                        <td>{{ $pharmacist->name }}</td>
                                        <td>{{ $pharmacist->email }}</td>
                                        <td>{{ $pharmacist->created_at->format("d M Y") }}</td>
                                        <td>{{ $pharmacist->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Yakin ingin menghapus Apoteker?')" method="post" action="{{ route('pharmacist.destroy', $pharmacist->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $pharmacist->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fas fa-trash"></i>
                                                </button>

                                                <a href="{{ route('pharmacist.edit', ['id' => $pharmacist->id]) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fas fa-sync"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                <div class="text-center">
                                    {{ $pharmacists->links() }}
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="alert alert-danger text-center">
                                            <strong>Maaf tidak ada konten.</strong>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection
