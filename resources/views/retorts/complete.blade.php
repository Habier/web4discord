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
            @php
                $card='cardName = "Last Retort: No se que hacer con mi vida."<br>';
                $card.='promptList = {<br>';
                foreach($retorts as $retort)
                {
                $card.='"'.$retort->question.'",<br>';
                }
            $card.='}';
            @endphp




          <?=$card ?>

        </div>
    </div>
@endsection
