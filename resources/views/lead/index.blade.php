@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Campanhas</div>

                    <div class="card-body">
                        @if(count($campaigns))
                            <table class="table table-dark" id="campaigns">
                                <thead>
                                    <tr>
                                        <th>Campanha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td><a href="/lead/{{ $campaign->id }}">{{ $campaign->title }}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <a href="/campaign/create">Clique aqui</a> para criar uma campanha.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('load', function(){
            $('#campaigns').DataTable({
                responsive: true,
                paging: false,
                searching: false,
                language: {
                    url: "/portuguese.json"
                }
            });
        });
    </script>
@endsection
