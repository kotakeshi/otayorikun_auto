<?php

namespace App\Http\Controllers;

use App\User;
use Aws\Rekognition\RekognitionClient;
use Aws\AwsClient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Meibo;

class HomeController extends Controller
{
    public function menu(Request $request)
    {
      return view('menu');
    }
    public function menu1(Request $request)
    {
      return view('menu1');
    }
    public function menu2(Request $request)
    {
      return view('menu2');
    }
    public function menu3(Request $request)
    {
      return view('menu3');
    }
    public function menu4(Request $request)
    {
      return view('menu4');
    }
    public function menu5(Request $request)
    {
      return view('menu5');
    }
    public function clearfile(Request $request)
    {
      /*フォルダ内ファイル削除*/
      define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
      $success = \File::cleanDirectory(imagepath.'image');
      echo "検索先ファイルを削除しました。";
    }
    public function startjob1(Request $request)
    {
      echo "処理を開始しました。".Carbon::now();
      echo "<br><br>";
      define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
      /*選択グループ読み込み*/
      for ( $i=1; $i<=count($_POST['button']); $i++ ){
        $group1[] = $_POST['button'][$i-1];
      }
        foreach($group1 as $group1_number){
          $filegroup1[] = Meibo::select()->where('group','=',$group1_number)->get()->toArray();
          $filterArray = array_filter($filegroup1);
          $valueArray = array_values($filterArray);
      }
      /*多次元配列の１次取得*/
      foreach($valueArray as $val1){
        /*多次元配列の２次取得*/
        foreach($val1 as $val2){
            /*各画像の自動認識処理*/
              /*フォルダ内ファイル削除*/
              $success = \File::cleanDirectory(imagepath.$val2['roomno']);
              $image1 = file_get_contents($val2['gazou']);
              /*処理時間上限設定*/
              set_time_limit(7200);

              for ( $j=0; $j<count($_FILES['file1']['name']); $j++ ){
              $name = $_FILES['file1']['name'][$j];
                /*１番目の配列の場合の処理*/
                if($val1 === reset($valueArray)){
                move_uploaded_file($_FILES['file1']['tmp_name'][$j], imagepath.'image/'.$name);
                }
              $targetimage = file_get_contents(imagepath.'image/'.$name);

              /*AWS自動認識API設定*/
              $o_awsRekognition = new RekognitionClient
              ([
              'credentials' => array
              (
                'key'   => 
                'secret'=> 
              ),
              'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
              'version'   => 'latest'
              ]);

              $count = 0;
              $maxTries = 3;

              while (true){
                try {
                  $result = $o_awsRekognition->compareFaces
                  ([
                    'SimilarityThreshold' => 60,
                    'SourceImage' =>['Bytes' => $image1],
                    'TargetImage' =>['Bytes' => $targetimage],
                  ]);

                  $result = array($result);
                  $result = array_key_exists('0',$result[0]['FaceMatches']);

                  if($result == '1'){
                    file_put_contents(imagepath.$val2['roomno'].'/'.$name,$targetimage);
                  }
                    unset($targetimage);
                  break;
                  }
                  catch (\Exception $e) {
                    if (++$count === $maxTries) {
                      break;
                    }
                  }
                }
              }
            }
          }
          echo "グループ１の処理が完了しました。".Carbon::now();
        }
        public function startjob2(Request $request)
        {
          echo "処理を開始しました。".Carbon::now();
          echo "<br><br>";
          define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
          /*選択グループ読み込み*/
          for ( $i=1; $i<=count($_POST['button']); $i++ ){
            $group2[] = $_POST['button'][$i-1];
          }
            foreach($group2 as $group2_number){
              $filegroup2[] = Meibo::select()->where('group','=',$group2_number)->get()->toArray();
              $filterArray = array_filter($filegroup2);
              $valueArray = array_values($filterArray);
          }
          foreach($valueArray as $val1){
            foreach($val1 as $val2){
                /*各画像の自動認識処理*/

                  /*フォルダ内ファイル削除*/
                  $success = \File::cleanDirectory(imagepath.$val2['roomno']);
                  $image2 = file_get_contents($val2['gazou']);
                  /*処理時間上限設定*/
                  set_time_limit(7200);

                  for ( $j=0; $j<count($_FILES['file2']['name']); $j++ ){
                  $name = $_FILES['file2']['name'][$j];
                  /*１番目の配列の場合の処理*/
                  if($val1 === reset($valueArray)){
                  move_uploaded_file($_FILES['file2']['tmp_name'][$j], imagepath.'image/'.$name);
                  }
                  $targetimage = file_get_contents(imagepath.'image/'.$name);

                  /*AWS自動認識API設定*/
                  $o_awsRekognition = new RekognitionClient
                  ([
                  'credentials' => array
                  (
                    'key'   => 'AKIAITV44WXQR2YQ743Q',
                    'secret'=> '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'
                  ),
                  'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
                  'version'   => 'latest'
                  ]);

                  $count = 0;
                  $maxTries = 3;

                  while (true){
                    try {
                      $result = $o_awsRekognition->compareFaces
                      ([
                        'SimilarityThreshold' => 60,
                        'SourceImage' =>['Bytes' => $image2],
                        'TargetImage' =>['Bytes' => $targetimage],
                      ]);

                      $result = array($result);
                      $result = array_key_exists('0',$result[0]['FaceMatches']);

                      if($result == '1'){
                        file_put_contents(imagepath.$val2['roomno'].'/'.$name,$targetimage);
                      }
                        unset($targetimage);
                      break;
                      }
                      catch (\Exception $e) {
                        if (++$count === $maxTries) {
                          break;
                        }
                      }
                    }
                  }
                }
              }
              echo "グループ２の処理が完了しました。".Carbon::now();
            }
        public function startjob3(Request $request)
        {
          echo "処理を開始しました。".Carbon::now();
          echo "<br><br>";
          define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
          /*選択グループ読み込み*/
          for ( $i=1; $i<=count($_POST['button']); $i++ ){
            $group3[] = $_POST['button'][$i-1];
          }
            foreach($group3 as $group3_number){
              $filegroup3[] = Meibo::select()->where('group','=',$group3_number)->get()->toArray();
              $filterArray = array_filter($filegroup3);
              $valueArray = array_values($filterArray);
          }
          foreach($valueArray as $val1){
            foreach($val1 as $val2){
                /*各画像の自動認識処理*/

                  /*フォルダ内ファイル削除*/
                  $success = \File::cleanDirectory(imagepath.$val2['roomno']);
                  $image3 = file_get_contents($val2['gazou']);
                  /*処理時間上限設定*/
                  set_time_limit(7200);

                  for ( $j=0; $j<count($_FILES['file3']['name']); $j++ ){
                  $name = $_FILES['file3']['name'][$j];
                  /*１番目の配列の場合の処理*/
                  if($val1 === reset($valueArray)){
                  move_uploaded_file($_FILES['file3']['tmp_name'][$j], imagepath.'image/'.$name);
                  }
                  $targetimage = file_get_contents(imagepath.'image/'.$name);

                  /*AWS自動認識API設定*/
                  $o_awsRekognition = new RekognitionClient
                  ([
                  'credentials' => array
                  (
                    'key'   => 'AKIAITV44WXQR2YQ743Q',
                    'secret'=> '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'
                  ),
                  'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
                  'version'   => 'latest'
                  ]);

                  $count = 0;
                  $maxTries = 3;

                  while (true){
                    try {
                      $result = $o_awsRekognition->compareFaces
                      ([
                        'SimilarityThreshold' => 60,
                        'SourceImage' =>['Bytes' => $image3],
                        'TargetImage' =>['Bytes' => $targetimage],
                      ]);

                      $result = array($result);
                      $result = array_key_exists('0',$result[0]['FaceMatches']);

                      if($result == '1'){
                        file_put_contents(imagepath.$val2['roomno'].'/'.$name,$targetimage);
                      }
                        unset($targetimage);
                      break;
                      }
                      catch (\Exception $e) {
                        if (++$count === $maxTries) {
                          break;
                        }
                      }
                    }
                  }
                }
              }
              echo "グループ３の処理が完了しました。".Carbon::now();
            }
      public function startjob4(Request $request)
      {
        echo "処理を開始しました。".Carbon::now();
        echo "<br><br>";
        define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
        /*選択グループ読み込み*/
        for ( $i=1; $i<=count($_POST['button']); $i++ ){
          $group4[] = $_POST['button'][$i-1];
        }
          foreach($group4 as $group4_number){
            $filegroup4[] = Meibo::select()->where('group','=',$group4_number)->get()->toArray();
            $filterArray = array_filter($filegroup4);
            $valueArray = array_values($filterArray);
        }
        foreach($valueArray as $val1){
          foreach($val1 as $val2){
              /*各画像の自動認識処理*/

                /*フォルダ内ファイル削除*/
                $success = \File::cleanDirectory(imagepath.$val2['roomno']);
                $image4 = file_get_contents($val2['gazou']);
                /*処理時間上限設定*/
                set_time_limit(7200);

                for ( $j=0; $j<count($_FILES['file4']['name']); $j++ ){
                $name = $_FILES['file4']['name'][$j];
                /*１番目の配列の場合の処理*/
                if($val1 === reset($valueArray)){
                move_uploaded_file($_FILES['file4']['tmp_name'][$j], imagepath.'image/'.$name);
                }
                $targetimage = file_get_contents(imagepath.'image/'.$name);

                /*AWS自動認識API設定*/
                $o_awsRekognition = new RekognitionClient
                ([
                'credentials' => array
                (
                  'key'   => 'AKIAITV44WXQR2YQ743Q',
                  'secret'=> '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'
                ),
                'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
                'version'   => 'latest'
                ]);

                $count = 0;
                $maxTries = 3;

                while (true){
                  try {
                    $result = $o_awsRekognition->compareFaces
                    ([
                      'SimilarityThreshold' => 60,
                      'SourceImage' =>['Bytes' => $image4],
                      'TargetImage' =>['Bytes' => $targetimage],
                    ]);

                    $result = array($result);
                    $result = array_key_exists('0',$result[0]['FaceMatches']);

                    if($result == '1'){
                      file_put_contents(imagepath.$val2['roomno'].'/'.$name,$targetimage);
                    }
                      unset($targetimage);
                    break;
                    }
                    catch (\Exception $e) {
                      if (++$count === $maxTries) {
                        break;
                      }
                    }
                  }
                }
              }
            }
            echo "グループ４の処理が完了しました。".Carbon::now();
          }
          public function startjob5(Request $request)
          {
            echo "処理を開始しました。".Carbon::now();
            echo "<br><br>";
            define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
            /*選択グループ読み込み*/
            for ( $i=1; $i<=count($_POST['button']); $i++ ){
              $group5[] = $_POST['button'][$i-1];
            }
              foreach($group5 as $group5_number){
                $filegroup5[] = Meibo::select()->where('group','=',$group5_number)->get()->toArray();
                $filterArray = array_filter($filegroup5);
                $valueArray = array_values($filterArray);
            }
            /*多次元配列の１次取得*/
            foreach($valueArray as $val1){
              /*多次元配列の２次取得*/
              foreach($val1 as $val2){
                  /*各画像の自動認識処理*/
                    /*フォルダ内ファイル削除*/
                    $success = \File::cleanDirectory(imagepath.$val2['roomno']);
                    $image5 = file_get_contents($val2['gazou']);
                    /*処理時間上限設定*/
                    set_time_limit(7200);

                    for ( $j=0; $j<count($_FILES['file5']['name']); $j++ ){
                    $name = $_FILES['file5']['name'][$j];
                      /*１番目の配列の場合の処理*/
                      if($val1 === reset($valueArray)){
                      move_uploaded_file($_FILES['file5']['tmp_name'][$j], imagepath.'image/'.$name);
                      }
                    $targetimage = file_get_contents(imagepath.'image/'.$name);

                    /*AWS自動認識API設定*/
                    $o_awsRekognition = new RekognitionClient
                    ([
                    'credentials' => array
                    (
                      'key'   => 'AKIAITV44WXQR2YQ743Q',
                      'secret'=> '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'
                    ),
                    'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
                    'version'   => 'latest'
                    ]);

                    $count = 0;
                    $maxTries = 3;

                    while (true){
                      try {
                        $result = $o_awsRekognition->compareFaces
                        ([
                          'SimilarityThreshold' => 60,
                          'SourceImage' =>['Bytes' => $image5],
                          'TargetImage' =>['Bytes' => $targetimage],
                        ]);

                        $result = array($result);
                        $result = array_key_exists('0',$result[0]['FaceMatches']);

                        if($result == '1'){
                          file_put_contents(imagepath.$val2['roomno'].'/'.$name,$targetimage);
                        }
                          unset($targetimage);
                        break;
                        }
                        catch (\Exception $e) {
                          if (++$count === $maxTries) {
                            break;
                          }
                        }
                      }
                    }
                  }
                }
                echo "グループ５の処理が完了しました。".Carbon::now();
              }
    /*
     ファイルアップロード処理
    */
    public function upload(Request $request)
    {
      echo "処理を開始しました。".Carbon::now();
      echo "<br><br>";
      define('imagepath','C:/xampp/htdocs/rekognition/storage/app/');
      $success = \File::cleanDirectory(imagepath.'public/kobetsu');
      $filename1 = $request->file('file1')->store('public/image');
      $image1 = file_get_contents(imagepath.$filename1);

      set_time_limit(7200);

      for ( $j=0; $j<count($_FILES['file2']['name']); $j++ ){
      $name = $_FILES['file2']['name'][$j];
      move_uploaded_file($_FILES['file2']['tmp_name'][$j], imagepath.'public/image/'.$name);
      $targetimage = file_get_contents(imagepath.'public/image/'.$name);

      /*AWS自動認識API設定*/
      $o_awsRekognition = new RekognitionClient
      ([
      'credentials' => array
      (
        'key'   => 'AKIAITV44WXQR2YQ743Q',
        'secret'=> '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'
      ),
      'region'    => 'us-east-1', //北バージニア。アジアリージョン未対応
      'version'   => 'latest'
      ]);

      $count = 0;
      $maxTries = 3;

      while (true){
        try {
          $result = $o_awsRekognition->compareFaces
          ([
            'SimilarityThreshold' => 60,
            'SourceImage' =>['Bytes' => $image1],
            'TargetImage' =>['Bytes' => $targetimage],
          ]);

          $result = array($result);
          $result = array_key_exists('0',$result[0]['FaceMatches']);

          if($result == '1'){
            file_put_contents(imagepath.'public/kobetsu'.'/'.$name,$targetimage);
          }
            unset($targetimage);
          break;
          }
          catch (\Exception $e) {
            if (++$count === $maxTries) {
              break;
            }
          }
        }
      }
      echo "個別識別の処理が完了しました。".Carbon::now();
    }
}
