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
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>
                                            @php
                                                $fields = json_decode( $lead->information, true );
                                                foreach ($fields as $key => $value)
                                                {
                                                    echo ' ' . $key . ': ' . $value;
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ $lead->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if(auth()->user()->admin)
                                            {!! Form::open(['route' => ['lead.destroy', $lead->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt"></i>', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-secondary',
                                                'onclick' => "return confirm('Tem certeza que deseja remover este registro?')"
                                            ]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
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
