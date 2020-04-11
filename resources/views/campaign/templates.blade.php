@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark">
                <div class="card-header">Campanhas</div>

                <div class="card-body">
                    @if($templates)
                        @foreach($templates as $template)
                        <div class="card bg-dark float-left" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $template->title }}</h5>
                                <a href="/campaign/createas/{{ $template->id }}" class="btn btn-primary">Avançar</a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection