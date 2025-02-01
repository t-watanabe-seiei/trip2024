<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;    //追記

class Timetable extends Component
{
  use WithFileUploads;
  public $schedules;
  public $images = [];
  public $files = [];
  public $path;
  public $schedule_id;
  public $caption;
  public $cource;
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

  public $user_id;
  public $user_name;
  public $user_role;

  // protected $listeners = ['accordion' => 'openAccordion'];

  public function mount(){
    if ( Auth::check() )     {
      // ログイン中の場合 ログイン中のユーザーを取得
      $user = Auth::user();
      $user_id = $user->id;
      $user_name = $user->name;
      $user_role = $user->role;
      
      // $this->schedules = Schedule::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
      $this->schedules = Schedule::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get()->sortBy([['cource',true],['id',true]]);

      // $this->schedules = Schedule::select(['id','caption','detail','datetime','image1','image2','image3','image4','image5','file1','file2','file3','file4','file5','maplink','created_at','updated_at','user_id','cource',])
      //   ->selectRaw("CASE WHEN cource is not null THEN substr(datetime,0,INSTR(datetime, ' ')) || ' (' || cource || ')' ELSE substr(datetime,0,INSTR(datetime, ' ')) END as tag")
      //   ->where('user_id', Auth::user()->id)->orWhere('user_id', null)
      //   ->get()->sortBy([['tag',true],['datetime',true]]);
          
    }else{
      // 未ログインの場合
      // $this->schedules = Schedule::where('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
      $this->schedules = Schedule::where('user_id', null)->get()->sortBy([['cource',true],['id',true]]);

      // $this->schedules = Schedule::select(['id','caption','detail','datetime','image1','image2','image3','image4','image5','file1','file2','file3','file4','file5','maplink','created_at','updated_at','user_id','cource',])
      //   ->selectRaw("CASE WHEN cource is not null THEN substr(datetime,0,INSTR(datetime, ' ')) || '(' || cource || ')' ELSE substr(datetime,0,INSTR(datetime, ' ')) END as tag")
      //   ->where('user_id', null)->get()->sortBy([['tag',true],['datetime',true]]);
    }
    // $this->schedules = Schedule::all()->sortBy('datetime');
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      // $row->detail = preg_replace_callback($pattern,function ($matches) {
      //     return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      // },nl2br(htmlspecialchars($row->detail)));      

      //$row->detail = nl2br(htmlspecialchars($row->detail));  
      $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
      $replace = '<a href="$1" target="_blank">$1</a>';
      $row->detail = preg_replace($pattern, $replace, $row->detail);
      
    }
  }

  public function render()
  {   
    return view('livewire.timetable');

  }

  public function updatedImage1()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedImage2()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedImage3()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedFile1()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedFile2()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedFile3()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedImages()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedFiles()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedDate()
  {   
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }
  public function updatedCource()
  {
      \Log::debug('updating count   ' . $this->cource);
      $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);
  }

  public function imageDelete()
  {   
    $this->image1 = Null;
    $this->image2 = Null;
    $this->image3 = Null;
    $this->images = [];
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);    //アコーディオンOPEN
  }

  public function fileDelete(){
    $this->file1 = Null;
    $this->file2 = Null;
    $this->file3 = Null;
    $this->files = [];
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);    //アコーディオンOPEN
  }

  public function deleteSchedule($id){
    $this->schedule = Schedule::find($id); 
    $this->schedule->delete();    
    // logger('deleteしました' . $id);

    // $this->schedules = Schedule::all()->sortBy('datetime');
    if ( Auth::check() ) {
      $this->schedules = Schedule::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
    }else{
      $this->schedules = Schedule::where('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
    }
    
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      // $row->detail = preg_replace_callback($pattern,function ($matches) {
      //     return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      // },nl2br(htmlspecialchars($row->detail)));    
      
      // $row->detail = nl2br(htmlspecialchars($row->detail));  
      $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
      $replace = '<a href="$1" target="_blank">$1</a>';
      $row->detail = preg_replace($pattern, $replace, $row->detail);
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
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);    //アコーディオンOPEN

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
      $this->cource = $this->schedule->cource;

      if($this->isNewScheduleCard){
        $this->isNewScheduleCard = false;
      }
      $this->isEditScheduleCard = true;      

      //jsのイベントを発火させる
      $this->dispatchBrowserEvent('show_accordion',['currentDate' => Str::before($this->schedule->datetime, ' '),'currentId' => $this->schedule_id,'currentCource' => $this->cource]);
  }

  public function newSave()
  {
      //バリデーション発動、ひっかかったらここで止まります
      $this->validate([
        'caption' => 'required',
        'detail' => 'required',
        'cource' => 'required',
        'images.*' => 'image|max:10240', // 最大１0ＭＢ
        'files.*' => 'max:10240', // 最大１0ＭＢ
      ],
      [
        'caption.required' => 'captionを入力してください',
        'detail.required' => '詳細を入力してください',
        'cource.required' => 'courceを入力してください',
        'images.*.image' => '画像ファイルを選択してください。',
        'images.*.max:10240' => '画像ファイルサイズが大きすぎ',
        'files.*.max:10240' => 'ファイルサイズが大きすぎです',
      ]);


      $schedule = new Schedule();
      $schedule->caption = $this->caption;
      $schedule->cource = $this->cource;
      $schedule->detail = $this->detail;
      $schedule->datetime = $this->date . " " . $this->time;
      if(Gate::allows('admin')){                   //追記
        $schedule->user_id = null;                 //追記
      }else if(Gate::allows('general')){           //追記
        $schedule->user_id = Auth::user()->id;     //追記
      }                                            //追記


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

      // $this->schedules = Schedule::all()->sortBy('datetime');
      if ( Auth::check() ) {
        $this->schedules = Schedule::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
      }else{
        $this->schedules = Schedule::where('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
      }
    
      foreach ($this->schedules as $row){
        //URL抽出の正規表現
        $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
        //該当する文字列に処理
        // $row->detail = preg_replace_callback($pattern,function ($matches) {
        //     return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
        // },nl2br(htmlspecialchars($row->detail)));    
        
        // $row->detail = nl2br(htmlspecialchars($row->detail));  
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target="_blank">$1</a>';
        $row->detail = preg_replace($pattern, $replace, $row->detail);
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
      $this->dispatchBrowserEvent('reset_new_shedule',['currentDate' => $this->date,'currentTime' => $this->time,'currentCource' => $this->cource]);
      $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);    //アコーディオンOPEN
  }

  public function editSave()
  {
    $this->schedule->caption = $this->caption;
    $this->schedule->cource = $this->cource;
    $this->schedule->detail = $this->detail;
    $this->schedule->datetime = $this->date . " " . $this->time;

    // logger('image1 : ' . $this->image1);
    // logger('image2 : ' . $this->image2);
    // logger('image3 : ' . $this->image3);

    // logger('$this->schedule->image1 : ' . $this->schedule->image1);
    // logger('$this->schedule->image2 : ' . $this->schedule->image2);
    // logger('$this->schedule->image3 : ' . $this->schedule->image3);

    // dd($this->images);


    if ( !is_null($this->image1) || !is_null($this->image2) || !is_null($this->image3)) {
        $this->schedule->image1 = $this->image1;
        $this->schedule->image2 = $this->image2;
        $this->schedule->image3 = $this->image3;
    }else if(!empty($this->images)){
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
    }else{
      $this->schedule->image1 = Null;
      $this->schedule->image2 = Null;
      $this->schedule->image3 = Null;
    }


    if ( !is_null($this->file1) || !is_null($this->file2) || !is_null($this->file3) ) {
      $this->schedule->file1 = $this->file1;
      $this->schedule->file2 = $this->file2;
      $this->schedule->file3 = $this->file3;
    }else if(!empty($this->files)){
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
    }else{
      $this->schedule->file1 = Null;
      $this->schedule->file2 = Null;
      $this->schedule->file3 = Null;
    }


    $this->schedule->save();


    // $this->schedules = Schedule::all()->sortBy('datetime');
    if ( Auth::check() ) {
      $this->schedules = Schedule::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
    }else{
      $this->schedules = Schedule::where('user_id', null)->get()->sortBy([['cource',true],['datetime',true]]);
    }
    
    foreach ($this->schedules as $row){
      //URL抽出の正規表現
      $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
      //該当する文字列に処理
      // $row->detail = preg_replace_callback($pattern,function ($matches) {
      //     return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
      // },nl2br(htmlspecialchars($row->detail)));      
      // $row->detail = nl2br(htmlspecialchars($row->detail));  

      $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
      $replace = '<a href="$1" target="_blank">$1</a>';
      $row->detail = preg_replace($pattern, $replace, $row->detail);
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
    $this->dispatchBrowserEvent('show_accordion',['currentCource' => $this->cource]);    //アコーディオンOPEN

    $this->isEditScheduleCard = false;    //Editカードを閉じる
  }

}
