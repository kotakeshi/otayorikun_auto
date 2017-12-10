@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/startjob1', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}
グループ１
<div class="form-group">
    {!! Form::label('file', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" name="file1[]" webkitdirectory directory onchange="activebutton()"><br><br>
  <input type="reset" value="リセット" onclick="window.location.reload()"><br><br>

  <input type="checkbox" name="button[]" id="button1" disabled value="1" checked>グループ１
  <input type="checkbox" name="button[]" id="button2" disabled value="2" checked>グループ２
  <input type="checkbox" name="button[]" id="button3" disabled value="3" checked>グループ３
  <input type="checkbox" name="button[]" id="button4" disabled value="4" checked>グループ４<br><br>
  {!! Form::submit('スタート', ['class' => 'btn btn-default','id' => 'start', 'disabled' => 'true',
  'onsubmit' => 'alert("Are you sure?")']) !!}
</div>
{!! Form::close() !!}
<script>
    function activebutton() {
      for(var i = 1; i < 5; i++){
          document.getElementById("button"+i).disabled = "";
        }
        document.getElementById("start").disabled = "";
    }
    function checkbox(){
          alert("チェックされていません");
        }
</script>
@endsection
