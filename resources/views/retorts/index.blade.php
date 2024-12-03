@extends('layouts.basic.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form name="quote" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="question" class="required">Pregunta</label>
                    <textarea id="question" name="question" required="required" class="form-control"></textarea>
                </div>

                <button type="submit" id="send" name="send">Enviar</button>
            </form>
        </div>
    </div>
    <div class="row" style="margin-top: 2.4em">
        <div class="col-md-12">
            @foreach($retorts as $retort)
                <div class="row" style="margin-bottom: 0.66em;">
                    <div class="col-md-1">{!! htmlHelper::deleteButton(route('retorts.delete',['id'=>$retort->id]))!!}</div>
                    <div class="col-md-11">{{$retort->question}}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
