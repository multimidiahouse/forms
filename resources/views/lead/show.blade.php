@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Infos</div>

                    <div class="card-body">
                        @if(count($leads))
                            <table class="table table-dark" id="infos">
                                <thead>
                                <tr>
                                    <th>Info</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>{{ $lead->information }}</td>
                                        <td>{{ $lead->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
            $('#infos').DataTable({
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
