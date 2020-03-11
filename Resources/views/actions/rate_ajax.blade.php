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
--
<rating-one value="3.23" title="qualita"></rating-one>
--
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" data-dismiss="modal">Vota !</button>
    {{--
        {!! Form::bsSubmit('vota') !!}
        --}}
</div>

{!! Form::close() !!}
@php
    /*
    Theme::add('pub_theme::dist/js/manifest.js',1);
    Theme::add('pub_theme::dist/js/vendor.js',2);
    Theme::add('pub_theme::dist/js/app.js',3);
    Theme::add('pub_theme::dist/js/app.css',3);
    Theme::add('pub_theme::js/test.js');
    */
    Theme::add('http://rawgit.com/gjunge/rateit.js/master/scripts/rateit.css');
    Theme::add('http://rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js');
    Theme::add('pub_theme::js/test.js');
@endphp
inizio
{!! Theme::showStyles(false) !!}
{!! Theme::showScripts(false) !!}
fine
@endauth
