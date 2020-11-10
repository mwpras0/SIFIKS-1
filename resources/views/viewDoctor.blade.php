@extends('layouts.app')

@section('content')

    @include('layouts.inc.navbar')

<hr>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <br>
            <h1>Dr. {{$doctor->name}}, {{$doctor->getSpecialty()->degree}}</h1>
            <a href="" class="text-decoration-none"><h3>{{$doctor->getSpecialty()->name}}</h3></a>
            <br>

<!-- Doctor Profile -->
            <p class="font-weight-bold">
                Profil Dokter
            </p>
            {!! $doctor->biography !!}
            <br>
<!-- Doctor Education -->
            <p class="font-weight-bold">

            <br>
<!-- Doctor Email -->
            <p class="font-weight-bold">
                Email Dokter
            </p>

            <p>
                {{$doctor->email}}
            </p>

        </div>



        <div class="col-md-4">
<!-- card doctor -->
            <div class="card" style="width: 18rem;">
                <br> <br>
                @if($doctor->profile_picture != null)
                <img src="{{ asset('user_images/').'/'.$doctor->profile_picture }}" class="card-user-profile-photo " alt="{{$doctor->name}}">
                @else
                <img src="{{ asset('images/felicia.jpg')}}" class="card-user-profile-photo " alt="{{$doctor->name}}">
                @endif
                <div class="card-body ">
                    <h5 class="text-center">Dr. {{$doctor->name}}, {{$doctor->getSpecialty()->degree}}</h5>
                    <a href="#" class="text-decoration-none"><p class="text-center">{{$doctor->getSpecialty()->name}}</p></a>
                    <br><br>
                    <!-- Tindakan Medis -->
                    {{-- <p class="font-weight-bold">Tindakan Medis : </p>
                    <ul class="col-sm-10">
                        <li>Konsultasi Penyakit Dalam</li>
                        <li>Konsultasi Imunologi</li>
                        <li>Terapi Alergi</li>
                    </ul> --}}
                </div>
            </div>

        </div>




    </div>
</div>
@endsection
