@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/startjob3', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}
グループ３
<div class="form-group">
    {!! Form::label('file', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" name="file3[]" webkitdirectory directory onchange="activebutton()"><br><br>
  <input type="reset" value="リセット" onclick="window.location.reload()"><br><br>

  <input type="checkbox" name="button[]" id="button9" disabled value="9" checked>グループ９
  <input type="checkbox" name="button[]" id="button10" disabled value="10" checked>グループ１０
  <input type="checkbox" name="button[]" id="button11" disabled value="11" checked>グループ１１
  <input type="checkbox" name="button[]" id="button12" disabled value="12" checked>グループ１２<br><br>
  {!! Form::submit('スタート', ['class' => 'btn btn-default','id' => 'start', 'disabled' => 'true',
  'onsubmit' => 'alert("Are you sure?")']) !!}
</div>
{!! Form::close() !!}
<script>
    function activebutton() {
      for(var i = 9; i < 13; i++){
          document.getElementById("button"+i).disabled = "";
        }
        document.getElementById("start").disabled = "";
    }
    function checkbox(){
          alert("チェックされていません");
        }
</script>
@endsection
