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

    public function startjob1(Request $request)
    {
      define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
        /*選択グループ読み込み*/
        for ( $i=1; $i<=count($_POST['button']); $i++ )
        {
          /*2,6,10,14番目のグループ番号を読み込む*/
          if(($i % 4) == 1){
            $group1[] = $_POST['button'][$i-1];
          }
        }
          /*各グループ番号の画像ファイルパスを取得*/
        foreach($group1 as $group1_number){
          $filegroup1[] = Meibo::select()->where('group','=',$group1_number)->get()->toArray();
          $filename1[] = array_column($filegroup1[0],'gazou');
        }
            /*各画像の自動認識処理*/
            foreach($filename1[0] as $file_1){
              /*フォルダ内ファイル削除*/
              $room[] = Meibo::select()->where('gazou','=',$file_1)->get()->toArray();
              $room_no = $room[0][0]['roomno'];
              $success = \File::cleanDirectory(imagepath.$room_no);

              $image1 = file_get_contents($file_1);
              /*処理時間上限設定*/
              set_time_limit(7200);

              for ( $j=0; $j<count($_FILES['file1']['name']); $j++ ){
              $name = $_FILES['file1']['name'][$j];
              move_uploaded_file($_FILES['file1']['tmp_name'][$j], imagepath.'image/'.$name);
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
                    'SourceImage' =>['Bytes' => $image1],
                    'TargetImage' =>['Bytes' => $targetimage],
                  ]);

                  $result = array($result);
                  $result = array_key_exists('0',$result[0]['FaceMatches']);

                  if($result == '1'){
                    file_put_contents(imagepath.$room_no.'/'.$name,$targetimage);
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
            echo Carbon::now();
        }
    public function startjob2(Request $request)
    {
      define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
      if(count($_POST['button'])>=2){
        /*選択グループ読み込み*/
        for ( $i=1; $i<=count($_POST['button']); $i++ )
        {
          /*2,6,10,14番目のグループ番号を読み込む*/
          if(($i % 4) == 2){
            $group2[] = $_POST['button'][$i-1];
          }
        }
          /*各グループ番号の画像ファイルパスを取得*/
        foreach($group2 as $group2_number){
          $filegroup2[] = Meibo::select()->where('group','=',$group2_number)->get()->toArray();
          $filename2[] = array_column($filegroup2[0],'gazou');
        }
            /*各画像の自動認識処理*/
            foreach($filename2[0] as $file_2){
              /*フォルダ内ファイル削除*/
              $room[] = Meibo::select()->where('gazou','=',$file_2)->get()->toArray();
              $room_no = $room[0][0]['roomno'];
              $success = \File::cleanDirectory(imagepath.$room_no);

              $image2 = file_get_contents($file_2);
              /*処理時間上限設定*/
              set_time_limit(7200);

              for ( $j=0; $j<count($_FILES['file2']['name']); $j++ ){
              $name = $_FILES['file2']['name'][$j];
              move_uploaded_file($_FILES['file2']['tmp_name'][$j], imagepath.'image/'.$name);
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
                    file_put_contents(imagepath.$room_no.'/'.$name,$targetimage);
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
            echo Carbon::now();
          }
        }
  public function startjob3(Request $request)
  {
    define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
    if(count($_POST['button'])>=3){
      /*選択グループ読み込み*/
      for ( $i=1; $i<=count($_POST['button']); $i++ )
      {
        /*2,6,10,14番目のグループ番号を読み込む*/
        if(($i % 4) == 3){
          $group3[] = $_POST['button'][$i-1];
        }
      }
        /*各グループ番号の画像ファイルパスを取得*/
      foreach($group3 as $group3_number){
        $filegroup3[] = Meibo::select()->where('group','=',$group3_number)->get()->toArray();
        $filename3[] = array_column($filegroup3[0],'gazou');
      }
          /*各画像の自動認識処理*/
          foreach($filename3[0] as $file_3){
            /*フォルダ内ファイル削除*/
            $room[] = Meibo::select()->where('gazou','=',$file_3)->get()->toArray();
            $room_no = $room[0][0]['roomno'];
            $success = \File::cleanDirectory(imagepath.$room_no);

            $image3 = file_get_contents($file_3);
            /*処理時間上限設定*/
            set_time_limit(7200);

            for ( $j=0; $j<count($_FILES['file2']['name']); $j++ ){
            $name = $_FILES['file2']['name'][$j];
            move_uploaded_file($_FILES['file2']['tmp_name'][$j], imagepath.'image/'.$name);
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
                  file_put_contents(imagepath.$room_no.'/'.$name,$targetimage);
                }
                  unset($targetimage);
                  unset($room);
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
          echo Carbon::now();
        }
      }
      public function startjob4(Request $request)
      {
        define('imagepath','C:/xampp/htdocs/rekognition/storage/app/public/');
        if(count($_POST['button'])>=4){
          /*選択グループ読み込み*/
          for ( $i=1; $i<=count($_POST['button']); $i++ )
          {
            /*2,6,10,14番目のグループ番号を読み込む*/
            if(($i % 4) == 0){
              $group4[] = $_POST['button'][$i-1];
            }
          }
            /*各グループ番号の画像ファイルパスを取得*/
          foreach($group4 as $group4_number){
            $filegroup4[] = Meibo::select()->where('group','=',$group4_number)->get()->toArray();
            $filename4[] = array_column($filegroup4[0],'gazou');
          }
              /*各画像の自動認識処理*/
              foreach($filename4[0] as $file_4){
                /*フォルダ内ファイル削除*/
                $room[] = Meibo::select()->where('gazou','=',$file_4)->get()->toArray();
                $room_no = $room[0][0]['roomno'];
                $success = \File::cleanDirectory(imagepath.$room_no);
                $image4 = file_get_contents($file_4);
                /*処理時間上限設定*/
                set_time_limit(7200);

                for ( $j=0; $j<count($_FILES['file2']['name']); $j++ ){
                $name = $_FILES['file2']['name'][$j];
                move_uploaded_file($_FILES['file2']['tmp_name'][$j], imagepath.'image/'.$name);
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
                      file_put_contents(imagepath.$room_no.'/'.$name,$targetimage);
                    }
                      unset($targetimage);
                      unset($room);
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
              echo Carbon::now();
            }
          }
    /*
     ファイルアップロード処理
    */
    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'file' => [
        //         // 必須
        //         'required',
        //         // アップロードされたファイルであること
        //         'file',
        //         // 最小縦横120px 最大縦横400px
        //         'dimensions:min_width=120,min_height=120,max_width=3000,max_height=3000',
        //     ]
        // ]);
            define('imagepath','C:/xampp/htdocs/rekognition/storage/app/');
            $filename1 = $request->file('file1')->store('public/image');
            $image1 = (file_get_contents(imagepath.$filename1));

            set_time_limit(7200);

            $imageout = array();

            for ( $i=0; $i<count($_FILES['file2']['name']); $i++ )
            {
            $name = $_FILES['file2']['name'][$i];
            move_uploaded_file($_FILES['file2']['tmp_name'][$i], imagepath.'public/image/'.$name);
            $targetimage = file_get_contents(imagepath.'public/image/'.$name);

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

            while (true)
            {
              try {
                $result = $o_awsRekognition->compareFaces
                ([
                  'SimilarityThreshold' => 60,
                  'SourceImage' =>['Bytes' => $image1],
                  'TargetImage' =>['Bytes' => $targetimage],
                ]);

                $result = array($result);
                $result = array_key_exists('0',$result[0]['FaceMatches']);
                if($result == '1')
                {
                array_push($imageout,'storage/image/'.$name);
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
              print_r($imageout);
              echo Carbon::now();
              return view('return')->with(['viewimage' => $imageout]);

    }
}
