@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/startjob2', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}
グループ２
<div class="form-group">
    {!! Form::label('file', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" name="file2[]" webkitdirectory directory onchange="activebutton()"><br><br>
  <input type="reset" value="リセット" onclick="window.location.reload()"><br><br>

  <input type="checkbox" name="button[]" id="button5" disabled value="5" checked>グループ５
  <input type="checkbox" name="button[]" id="button6" disabled value="6" checked>グループ６
  <input type="checkbox" name="button[]" id="button7" disabled value="7" checked>グループ７
  <input type="checkbox" name="button[]" id="button8" disabled value="8" checked>グループ８<br><br>
  {!! Form::submit('スタート', ['class' => 'btn btn-default','id' => 'start', 'disabled' => 'true',
  'onsubmit' => 'alert("Are you sure?")']) !!}
</div>
{!! Form::close() !!}
<script>
    function activebutton() {
      for(var i = 5; i < 9; i++){
          document.getElementById("button"+i).disabled = "";
        }
        document.getElementById("start").disabled = "";
    }
    function checkbox(){
          alert("チェックされていません");
        }
</script>
@endsection
