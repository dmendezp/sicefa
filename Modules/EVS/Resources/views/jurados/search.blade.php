<label>{{ $person->first_name }} {{ $person->first_last_name }} {{ $person->second_last_name }}</label>
<div>
<span>Codigo de seguridad:</span>

@php $permitted_chars = '0123456789';
// Output: video-g6swmAP8X5VG4jCi.mp4
$code = substr(str_shuffle($permitted_chars), 0, 6);
echo "<h4>".$code."</h4>" @endphp

{!! Form::hidden('code',$code,['id'=>'code']) !!}
{!! Form::button('Autorizar',['class'=>'btn btn-success mtop16', 'id'=>'btnAutorized']) !!}
</div>