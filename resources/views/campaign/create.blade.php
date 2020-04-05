@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark">
                <div class="card-body">
                    {!! Form::open(['route' => 'campaign.store']) !!}
                        @include('campaign.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
		window.addEventListener('load', function(){
			CKEDITOR.replace( 'editor1' );
            CKEDITOR.replace( 'editor2' );
		});
	</script>
@endsection
