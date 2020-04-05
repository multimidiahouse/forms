@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Usuários</div>

                    <div class="card-body">
                        @if(count($users))
                            <table class="table table-dark" id="users">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ativo</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->active ? 'SIM' : 'NÃO') }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="/user/{{ $user->id }}/edit"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <a href="/user/create">Clique aqui</a> para criar um usuário.
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
            $('#users').DataTable({
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
