@extends('layouts.app')

@section('content')

    @include('layouts.inc.navbar')

<hr>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <br>
            <h1>{{$medicine->name}}</h1>
            
            <br>

<!-- Harga -->
            <p class="font-weight-bold">
                Harga Obat
            </p>
            <p>
                {{$medicine->price}}
            </p>
            <br>
<!-- Stok -->
            <p class="font-weight-bold">
                Stok Obat
            </p>

            <p>
                {{$medicine->stock}}
            </p>

            <p class="font-weight-bold">
                Deskripsi Obat
            </p>
            
                {!! $medicine->description !!}
            
            <br>

        </div>

        <div class="col-md-4">
<!-- card doctor -->
            <div class="card" style="width: 18rem;">
                <br> <br>
                @if($medicine->medicine_picture != null)
                <img src="{{ asset('user_images/').'/'.$medicine->medicine_picture }}" class="card-user-profile-photo " alt="{{$medicine->name}}">
                @else
                <img src="{{ asset('images/medicine.png')}}" class="card-user-profile-photo " alt="{{$medicine->name}}">
                @endif
                <div class="card-body ">
                    <a href="#" class="nav-link btn btn-primary">Beli Sekarang</a>
                    <br><br>
                </div>
            </div>

        </div>




    </div>
</div>
@endsection
