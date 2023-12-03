<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Schedule;
use Illuminate\Support\Str;

class Timetable extends Component
{
  use WithFileUploads;
  public $schedules;
  public $images = [];
  public $files = [];
  public $path;
  public $schedule_id;
  public $caption;
  public $detail;
  public $date;
  public $time;
  public $image1;
  public $image2;
  public $image3;
  public $file1;
  public $file2;
  public $file3;

  public $schedule;

  public $isNewScheduleCard = false;
  public $isEditScheduleCard = false;
  public $isWhatToBring = false;
  public $isIntroduction = false;

  // protected $listeners = ['accordion' => 'openAccordion'];

  public function mount(){
    $this->schedules = Schedule::all()->sortBy('datetime');
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      $row->detail = preg_replace_callback($pattern,function ($matches) {
          return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      },nl2br(htmlspecialchars($row->detail)));      
    }
  }

  public function render()
  {   
    return view('livewire.timetable');

  }

  public function updatedImage1()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedImage2()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedImage3()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedFile1()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedFile2()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedFile3()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedImages()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedFiles()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }
  public function updatedDate()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);
  }

  public function imageDelete()
  {   
    $this->image1 = Null;
    $this->image2 = Null;
    $this->image3 = Null;
    $this->images = [];
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);    //アコーディオンOPEN
  }

  public function fileDelete(){
    $this->file1 = Null;
    $this->file2 = Null;
    $this->file3 = Null;
    $this->files = [];
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);    //アコーディオンOPEN
  }

  public function deleteSchedule($id){
    $this->schedule = Schedule::find($id); 
    $this->schedule->delete();    
    // logger('deleteしました' . $id);

    $this->schedules = Schedule::all()->sortBy('datetime');
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      $row->detail = preg_replace_callback($pattern,function ($matches) {
          return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      },nl2br(htmlspecialchars($row->detail)));      
    }

    // $this->caption = Null;
    // $this->detail = Null;
    // $this->time = Null;
    // $this->image1 = Null;
    // $this->image2 = Null;
    // $this->image3 = Null;
    // $this->file1 = Null;
    // $this->file2 = Null;
    // $this->file3 = Null;
    // $this->images = [];
    // $this->files = [];
    //reset_new_shedule（入力時に使ったデータ消去）
    // $this->dispatchBrowserEvent('reset_edit_shedule',['currentDate' => $this->date]);
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);    //アコーディオンOPEN

    $this->isEditScheduleCard = false;    //Editカードを閉じる
  }

  public function openEditCard($id , $caption , $date)
  {
      $this->schedule = Schedule::find($id); 
      $this->schedule_id = $id;
      $this->caption = $this->schedule->caption;
      $this->detail = $this->schedule->detail;
      $this->date = Str::before($this->schedule->datetime, ' ');
      $this->time = Str::after($this->schedule->datetime, ' ');
      $this->image1 = $this->schedule->image1;
      $this->image2 = $this->schedule->image2;
      $this->image3 = $this->schedule->image3;
      $this->file1 = $this->schedule->file1;
      $this->file2 = $this->schedule->file2;
      $this->file3 = $this->schedule->file3;

      if($this->isNewScheduleCard){
        $this->isNewScheduleCard = false;
      }
      $this->isEditScheduleCard = true;      

      //jsのイベントを発火させる
      $this->dispatchBrowserEvent('show_accordion',['currentDate' => Str::before($this->schedule->datetime, ' '),'currentId' => $this->schedule_id]);
  }

  public function newSave()
  {
      //バリデーション発動、ひっかかったらここで止まります
      $this->validate([
        'caption' => 'required',
        'detail' => 'required',
        'images.*' => 'image|max:10240', // 最大１0ＭＢ
        'files.*' => 'max:10240', // 最大１0ＭＢ
      ],
      [
        'caption.required' => 'captionを入力してください',
        'detail.required' => '詳細を入力してください',
        'images.*.image' => '画像ファイルを選択してください。',
        'images.*.max:10240' => '画像ファイルサイズが大きすぎ',
        'files.*.max:10240' => 'ファイルサイズが大きすぎです',
      ]);


      $schedule = new Schedule();
      $schedule->caption = $this->caption;
      $schedule->detail = $this->detail;
      $schedule->datetime = $this->date . " " . $this->time;

      $counter = 1;
      foreach ($this->images as $image) {
          $path = pathinfo($image->store('public'), PATHINFO_BASENAME);//ファイル名.拡張子のみ

          switch ($counter){
            case 1:
              $schedule->image1 = $path;
              break;
            case 2:
              $schedule->image2 = $path;
              break;
            case 3:
              $schedule->image3 = $path;
              break;
            default:
          }    

          if($counter >= 3) {break;}    //ファイルアップロードは3つまで
          $counter++;
      }
      $counter = 1;
      foreach ($this->files as $file) {
          $path = pathinfo($file->store('public'), PATHINFO_BASENAME);//ファイル名.拡張子のみ

          switch ($counter){
            case 1:
              $schedule->file1 = $path;
              break;
            case 2:
              $schedule->file2 = $path;
              break;
            case 3:
              $schedule->file3 = $path;
              break;
            default:
          }    

          if($counter >= 3) {break;}    //ファイルアップロードは3つまで
          $counter++;
      }

      // dd($schedule);
      // logger($schedule);

      $schedule->save();

      $this->schedules = Schedule::all()->sortBy('datetime');
      foreach ($this->schedules as $row){
        //URL抽出の正規表現
        $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
        //該当する文字列に処理
        $row->detail = preg_replace_callback($pattern,function ($matches) {
            return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
        },nl2br(htmlspecialchars($row->detail)));      
      }

      $this->caption = Null;
      $this->detail = Null;
      $this->image1 = Null;
      $this->image2 = Null;
      $this->image3 = Null;
      $this->file1 = Null;
      $this->file2 = Null;
      $this->file3 = Null;
      $this->images = [];
      $this->files = [];
      //reset_new_shedule（入力時に使ったデータ消去）
      $this->dispatchBrowserEvent('reset_new_shedule',['currentDate' => $this->date,'currentTime' => $this->time]);
      $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);    //アコーディオンOPEN
  }

  public function editSave()
  {
    $this->schedule->caption = $this->caption;
    $this->schedule->detail = $this->detail;
    $this->schedule->datetime = $this->date . " " . $this->time;

    logger('image1 : ' . $this->image1);
    logger('image2 : ' . $this->image2);
    logger('image3 : ' . $this->image3);

    logger('$this->schedule->image1 : ' . $this->schedule->image1);
    logger('$this->schedule->image2 : ' . $this->schedule->image2);
    logger('$this->schedule->image3 : ' . $this->schedule->image3);

    // dd($this->images);


    if (empty($this->images)) {
        $this->schedule->image1 = Null;
        $this->schedule->image2 = Null;
        $this->schedule->image3 = Null;
    }else{
        $counter = 1;
        foreach ($this->images as $image) {
            $path = pathinfo($image->store('public'), PATHINFO_BASENAME);//ファイル名.拡張子のみ

            switch ($counter){
              case 1:
                $this->schedule->image1 = $path;
                break;
              case 2:
                $this->schedule->image2 = $path;
                break;
              case 3:
                $this->schedule->image3 = $path;
                break;
              default:
            }    

            if($counter >= 3) {break;}    //ファイルアップロードは3つまで
            $counter++;
        }
    }


    if (empty($this->files)) {
        $this->schedule->file1 = Null;
        $this->schedule->file2 = Null;
        $this->schedule->file3 = Null;
    }else{
        $counter = 1;
        foreach ($this->files as $file) {
            $path = pathinfo($file->store('public'), PATHINFO_BASENAME);//ファイル名.拡張子のみ

            switch ($counter){
              case 1:
                $this->schedule->file1 = $path;
                break;
              case 2:
                $this->schedule->file2 = $path;
                break;
              case 3:
                $this->schedule->file3 = $path;
                break;
              default:
            }    

            if($counter >= 3) {break;}    //ファイルアップロードは3つまで
            $counter++;
        }
    }


    $this->schedule->save();


    $this->schedules = Schedule::all()->sortBy('datetime');
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      $row->detail = preg_replace_callback($pattern,function ($matches) {
          return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      },nl2br(htmlspecialchars($row->detail)));      
    }

    $this->caption = Null;
    $this->detail = Null;
    $this->time = Null;
    $this->image1 = Null;
    $this->image2 = Null;
    $this->image3 = Null;
    $this->file1 = Null;
    $this->file2 = Null;
    $this->file3 = Null;
    $this->images = [];
    $this->files = [];
    //reset_new_shedule（入力時に使ったデータ消去）
    // $this->dispatchBrowserEvent('reset_edit_shedule',['currentDate' => $this->date]);
    $this->dispatchBrowserEvent('show_accordion',['currentDate' => $this->date]);    //アコーディオンOPEN

    $this->isEditScheduleCard = false;    //Editカードを閉じる
  }

}
