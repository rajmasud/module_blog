@guest
<h3>Before Login </h3>
<button class="btn btn-social btn-facebook" onclick="location.href='{{ url($lang.'/login/facebook') }}';">
    <i class="fab fa-facebook-square fa-3x  "></i>
</button>

@endguest
@auth
{!! Form::model($row,['url'=>Request::fullUrl() ]) !!}
@method('put') {{-- Se Post da errore :) --}}
{!! Form::bsRatingMulti('ratings') !!}

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" data-dismiss="modal">Vota !</button>
    {{--
        {!! Form::bsSubmit('vota') !!}
        --}}
</div>
{!! Form::close() !!}
{{ Theme::showStyles(false) }}
{{ Theme::showScripts(false) }}
@endauth
