@extends('layouts.app')
@section('content')
<br><br>
<input type="button" value="識別グループ１" onclick="window.open('http://127.0.0.1/rekognition/public/menu1','group1')"><br><br>
<input type="button" value="識別グループ２" onclick="window.open('http://127.0.0.1/rekognition/public/menu2','group2')"><br><br>
<input type="button" value="識別グループ３" onclick="window.open('http://127.0.0.1/rekognition/public/menu3','group3')"><br><br>
<input type="button" value="識別グループ４" onclick="window.open('http://127.0.0.1/rekognition/public/menu4','group4')"><br><br>
<input type="button" value="識別グループ５" onclick="window.open('http://127.0.0.1/rekognition/public/menu5','group5')"><br><br>
<input type="button" value="個別識別" class="btn btn-primary btn-sm" onclick="window.open('http://127.0.0.1/rekognition/public','個別識別')"><br><br>
<a href='http://127.0.0.1/rekognition/public/clearfile' class="btn btn-primary btn-sm">ファイル削除</a>
@endsection
