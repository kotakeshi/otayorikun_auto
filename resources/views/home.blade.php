@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}

<div class="form-group">
  {!! Form::label('file1', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" id="kobetsu" name="file1" ><br><br>

  {!! Form::label('file', '比較画像', ['class' => 'control-label']) !!}
  <input type="file" id="target" name="file2[]" webkitdirectory directory onchange="activebutton()"><br>
</div>

<div class="form-group">
  {!! Form::submit('個別識別スタート', ['class' => 'btn btn-default','id' => 'start']) !!}
</div>
{!! Form::close() !!}
<script>
function activebutton() {
  if(document.getElementById("kobetsu").disabled == 'false'){
  document.getElementById("start").disabled == 'false';}
}
</script>
@endsection
