{!! Form::hidden('id', isset($campaign) ? $campaign->id : 0) !!}
{!! Form::hidden('slug', isset($campaign) ? $campaign->slug : '') !!}
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Título:') !!}
    {!! Form::text('title', isset($campaign) ? $campaign->title : '', ['class' => 'form-control bg-dark text-white', 'required']) !!}
</div>

<div class="col-sm-12 mt-1">
    <ul class="nav nav-tabs navbar-dark">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#html">HTML</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#response">Tela Final</a>
        </li>
    </ul>
</div>

<div class="tab-content no-gutters">
    <div class="tab-pane container active" id="html">
        {!! Form::textarea('html', isset($campaign) ? $campaign->html : '', ['class' => 'form-control bg-dark text-white', 'id' => 'editor1']) !!}
    </div>
    <div class="tab-pane container fade" id="response">
        {!! Form::textarea('response', isset($campaign) ? $campaign->response : '', ['class' => 'form-control bg-dark text-white', 'id' => 'editor2']) !!}
    </div>
</div>

<div class="form-group col-sm-12 mt-2">
    {!! Form::submit('salvar', ['class' => 'btn btn-secondary']) !!}
</div>
