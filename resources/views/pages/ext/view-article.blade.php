@extends('layouts.adm-app')
@section('content')
    <section class="content-header">
        <h1>
            <a href="{{ url()->previous() }}" class="btn btn-default">
                <i class="fa fa-chevron-left"></i>
            </a>&nbsp;&nbsp;&nbsp;
            Preview Artikel
            <small><b>( {{ Str::limit($article->title) }} )</b></small>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fas fa-tachometer-alt"></i> {{ session('role') }}</a></li>
            <li class="active"><a href="{{ Auth::guard('admin')->check() ? route('admin.article.index') : route('doctor.article.index') }}">Artikel</a></li>
            <li class="active">{{ Str::limit($article->title) }}<small>(Preview)</small></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-primary container" style="padding-bottom:20px;">
            <br>
            <div class="text-muted">
                Ditinjau <strong>{{ $article->created_at->format("d F Y") }}</strong>
                <br>
                Oleh
                <strong>
                    {{ $article->writer()['data']->name }}
                    <small>( {{ $article->writer()['role'] }} )</small>
                </strong>
            </div>
            <hr>
            <div class="text-center">
                @if ($article->cover_image != null)
                    <img class="center size-full wp-image-1544282" src="{{ asset('cover_images/').'/'.$article->cover_image}}" alt="{{$article->title}}" width="650" height="433">
                @else
                    <img class="alignnone size-full wp-image-1544282" src="{{ asset('cover_images/noimage.jpg')}}" alt="{{$article->title}}" width="650" height="433">
                @endif
            </div>
            <h2>{{ $article->title }}</h2><br>
            {!! $article->content !!}
        </div>
    </section>
@endsection
