@extends('layouts.app')
@section('content')
{!! Form::open(['url' => '/startjob5', 'method' => 'post', 'files' => true,'enctype'=>'multipart/form-data']) !!}
グループ5
<div class="form-group">
    {!! Form::label('file', '検索フォルダ', ['class' => 'control-label','height' => '200']) !!}
  <input type="file" name="file5[]" webkitdirectory directory onchange="activebutton()"><br><br>
  <input type="reset" value="リセット" onclick="window.location.reload()"><br><br>

  <input type="checkbox" name="button[]" id="button17" disabled value="17" checked>グループ１７
  <input type="checkbox" name="button[]" id="button18" disabled value="18" checked>グループ１８
  <input type="checkbox" name="button[]" id="button19" disabled value="19" checked>グループ１９
  <input type="checkbox" name="button[]" id="button20" disabled value="20" checked>グループ２０<br><br>
  {!! Form::submit('スタート', ['class' => 'btn btn-default','id' => 'start', 'disabled' => 'true',
  'onsubmit' => 'alert("Are you sure?")']) !!}
</div>
{!! Form::close() !!}
<script>
    function activebutton() {
      for(var i = 17; i < 21; i++){
          document.getElementById("button"+i).disabled = "";
        }
        document.getElementById("start").disabled = "";
    }
    function checkbox(){
          alert("チェックされていません");
        }
</script>
@endsection
