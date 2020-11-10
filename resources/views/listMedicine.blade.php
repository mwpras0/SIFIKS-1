@extends('layouts.app')

@section('content')

    @include('layouts.inc.navbar')
    <div class="container-fluid">
        <div class="jumbotron p-4 p-md-5 text-white rounded bg-primary">
            <div class="row justify-content-center">
                <div class="col-md-6 px-0">
                  {{-- <img src="https://i.ibb.co/JQbV1BQ/sifiks5.png" width="45%" alt="sifiks5" border="0"> --}}
                <h1 class="display-4 font-bold" >Cari Obat</h1>
                <p class="lead my-3" >Kekayaan bukan berasal dari uang, melainkan kesehatan</p>
                {{-- <hr> --}}
                <br>
                {!! Form::open(['action' => 'MedicineController@searchMedicine','method'=> 'POST']) !!}
                @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                {{Form::text ('nama','',['class'=>'form-control','placeholder'=>'Cari Nama Obat'])}}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                    {{Form::submit('Cari',['class'=>'btn btn-warning'])}}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6" >
                  {{-- <div class="img-fluid"> --}}
                      <img src="{{ asset('images/obat-home.png') }}" class="float-right" alt="Obat" width="100%">
                  {{-- </div> --}}
              </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="col-md-6">
                    <h2>Daftar Obat</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($data['medicine'])>0)
            @foreach($data['medicine'] as $medicine)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if($medicine->medicine_picture != null)
                            <img src="{{ asset('user_images/').'/'.$medicine->medicine_picture }}" alt="{{$medicine->name}}" class="card-img" >
                            @else
                            <img src="{{ asset('images/medicine.png') }}" alt="{{$medicine->name}}" class="card-img" >
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$medicine->name}}</h5>
                                <p class="card-text">Harga : {{$medicine->price}}</p>
                                <a href="{{route('show.medicine',['id'=>$medicine->id])}}" class="btn btn-primary">Detail Obat</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="alert alert-danger text-center">
                            <strong>Maaf tidak ada obat.</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="text-center">
                {{ $data['medicine']->links() }}
            </div>
    </div>
@endsection
