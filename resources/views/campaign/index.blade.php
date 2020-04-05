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
									<th>Título</th>
									<th>URL</th>
									<th>Ínicio</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach($campaigns as $campaign)
									<tr>
										<td>{{ $campaign->title }}</td>
										<td>{{ env('APP_URL') . '/' . $campaign->slug }}</td>
										<td>{{ $campaign->created_at->format('d/m/Y') }}</td>
										<td>
                                            <a class="btn btn-secondary" href="/campaign/{{ $campaign->id }}/edit"><i class="fas fa-edit"></i></a>
											<a class="btn btn-secondary" href="/lead/{{ $campaign->id }}"><i class="fas fa-address-card"></i></a>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal{{ $campaign->id }}">
                                                <i class="fas fa-users"></i>
                                            </button>
                                            <div class="modal fade" id="modal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="CampaignUser{{ $campaign->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <form class="form-inline" action="{{ url('/campaign/adduser') }}" method="post">
                                                                {!! Form::hidden('campaign_id', $campaign->id) !!}
                                                                <div class="form-group">
                                                                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="form-control btn btn-secondary">+</button>
                                                                </div>
                                                            </form>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-dark">
                                                                <thead>
                                                                    <th>Nome</th>
                                                                    <th>Email</th>
                                                                </thead>
                                                                @if(count($campaignusers) && count($campaignusers[$campaign->id]))
                                                                <tbody>
                                                                    @foreach($campaignusers[$campaign->id] as $campaignuser)
                                                                        <tr>
                                                                            <td>{{ $campaignuser->name }}</td>
                                                                            <td>{{ $campaignuser->email }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										</td>
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
