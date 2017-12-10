@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/startjob4', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}
グループ４
<div class="form-group">
    {!! Form::label('file', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" name="file4[]" webkitdirectory directory onchange="activebutton()"><br><br>
  <input type="reset" value="リセット" onclick="window.location.reload()"><br><br>

  <input type="checkbox" name="button[]" id="button13" disabled value="13" checked>グループ１３
  <input type="checkbox" name="button[]" id="button14" disabled value="14" checked>グループ１４
  <input type="checkbox" name="button[]" id="button15" disabled value="15" checked>グループ１５
  <input type="checkbox" name="button[]" id="button16" disabled value="16" checked>グループ１６<br><br>
  {!! Form::submit('スタート', ['class' => 'btn btn-default','id' => 'start', 'disabled' => 'true',
  'onsubmit' => 'alert("Are you sure?")']) !!}
</div>
{!! Form::close() !!}
<script>
    function activebutton() {
      for(var i = 13; i < 17; i++){
          document.getElementById("button"+i).disabled = "";
        }
        document.getElementById("start").disabled = "";
    }
    function checkbox(){
          alert("チェックされていません");
        }
</script>
@endsection
