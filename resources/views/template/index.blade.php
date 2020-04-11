@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="/template/create">+ Adicionar</a>
                    </div>
                    <div class="card-body">
                        @if(count($templates))
                            <table class="table table-dark" id="templates">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->title }}</td>
                                        <td>{{ $template->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a class="btn btn-secondary" href="/template/{{ $template->id }}/edit"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <a href="/template/create">Clique aqui</a> para criar um template.
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
            $('#templates').DataTable({
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
