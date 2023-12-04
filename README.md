# Replitにおける、Laravel導入

## ★Replit　Laravel　で検索　→　Fork

## ★Nodeのインストールされてるかチェック  ver16を指定
     npm -v

     node -v

## ★laravel-mixとLaravelプラグインのインストール
     npm install
     
Laravelを新規にインストールすると、アプリケーションのディレクトリ構造のルートにpackage.jsonファイルができます。デフォルトのpackage.jsonファイルは、laravel-mixとLaravelプラグインを使い始めるために必要なものを既に含んでいます。アプリケーションのフロントエンドの依存関係は、NPM経由でインストールできます。



## ★空のSQLiteデータベース ファイルの作成
     touch database/database.sqlite

ローカルマシンにMySQLやPostgresをインストールしたくないので、SQLiteデータベースを使用。SQLiteは小さく、高速で、自己完結型のデータベースエンジンです。使用し始めるには、空のSQLiteファイルを作成することにより、SQLiteデータベースを作成します。通常、このファイルはLaravelアプリケーションのdatabaseディレクトリの中に設置します。
    


## ★.laravel.env 設定ファイルを開き、Laravelからデータベースを操作できるように設定
        DB_CONNECTION=sqlite
        # DB_HOST=127.0.0.1　←削除orコメントアウト
        # DB_PORT=3306　←削除orコメントアウト
        # DB_DATABASE=Laravel　←削除orコメントアウト
        # DB_USERNAME=root　←削除orコメントアウト
        # DB_PASSWORD=　←削除orコメントアウト
        
Laravelがsqliteデータベースドライバを使用するよう、.env設定ファイルを変更します。DB_CONNECTION の値を mysql から sqlite に更新して、DB_HOST から DB_PASSWORD までの行はすべて削除します。

## ★あらかじめ登録されたマイグレーションを実行し、テーブル4つが作成( users , password_resets , failed_jobs , personal_access_tokens )
         php artisan migrate

## ★マイグレーションファイルの作成（スケジュールデータ保存するためのテーブル）
        php artisan make:migration create_schedules_table

## ★マイグレーションファイルの内容の追記
         Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('caption');
            $table->string('detail')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();
            $table->string('file4')->nullable();
            $table->string('file5')->nullable();
            $table->string('maplink')->nullable();
            $table->timestamps();
        });
　　
## ★マイグレーション実行
    php artisan migrate

上記で作成したマイグレーションを実行すると、schedulesテーブルが作成されます

## ★モデル作成
    php artisan make:model Schedule
     
Schedulesテーブルに保存できるようにモデルを定義します。

## ★seeder作成
    php artisan make:seeder SchedulesSeeder

## ★SchedulesSeederに内容を追記
    use Illuminate\Support\Facades\DB;

    public function run()
    {
      DB::table('schedules')->insert([
        [ 'caption' => '集合場所7' , 'detail' => '新山口駅19:55' , 'datetime' => '2009-08-24 23:10:15', ],
        [ 'caption' => '新幹線に乗車7' , 'detail' => '23:15発のぞみ', 'datetime' => '2019-09-24 23:10:15',],
      ]);
    }

## ★DatabaseSeederに登録
    $this->call(SchedulesSeeder::class);

## ★seeder実行 (DatabaseSeederに登録されたSeederが実行される)
    php artisan db:seed

## ★SQLiteをコマンドラインで実行する方法を参照 https://reffect.co.jp/laravel/laravel_sqlite/#google_vignette

シェルに以下を入力

    sqlite3 database/database.sqlite

よく利用するコマンド一覧

     .tables       #テーブル一覧表示
     .header on    #select 文を実行するとヘッダーが表示される
     .mode column  #ヘッダーの列間にスペースを入れて読みやすく
     .quit         #Exit this program
  

## ★phpLiteAdminの導入
※phpLiteAdminは、SQLiteのデータベースをGUIで操作することができるツールです。テーブルを作成したり、SQL文を実行することができます。※phpLiteAdmin Current development version(1.9.9-dev)	PHP8.1.6動作確認
ダウンロードして、phpliteadmin.phpの中身を以下に書き換え
設定

    $password = '';
    $directory = false;
    $subdirectories = false;
    $databases = array(
    	array(
    		'path'=> '/home/runner/2023trip/database/database.sqlite', 
    		'name'=> 'main'
    	)
    );

phpliteadmin.phpをpublicフォルダにアップロードし、

https://2023trip.t-watanabe.repl.co/phpliteadmin.php

からアクセス


## ★bootstrap5.3 CDNの導入

https://getbootstrap.jp/docs/5.3/getting-started/introduction/


## ★bladeファイルがハイライトされない問題について

trip.blade.php を trip.php に rename すると PHP 構文としてハイライト され、

     php artisan serve --host 0.0.0.0 --port 8000 

を実行しても、trip.blade.php　として処理され、きちんと表示される。
※ただし、コードの記載が完了した後は、trip.blade.phpに戻した方がよさそう


## PDFファイルを iframe で表示するサンプル
      <iframe src="https://seiei.ac.jp/pdf/seiei_requirements_2022.pdf" width="600" height="332" frameborder="0" style="border:none;"></iframe>

## PDFファイル 新規タブで開く　サンプル

      <a class="btn btn-outline-success btn-sm mb-2" role="button" href="https://seiei.ac.jp/pdf/seiei_requirements_2022.pdf" target="_blank">PDF</a>

## googleMapを　新規タブで開く　サンプル

       <a class="btn btn-outline-primary btn-sm mb-2" role="button" href="https://maps.app.goo.gl/WFSVP1L7HYYZK3TS6" target="_blank">MAP</a>.

## route/web.php を変更

        Route::get('/', function () {
          return view('trip');
        });

        Route::get('/sample', [SampleController::class, 'showPage']);



---------------------------------------------2023.10.04 ココマデ…
以下　2023.10.26～作成

## scheduleコントローラの作成

    php artisan make:controller ScheduleController


## scheduleコントローラの中身を記述

    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Schedule;

    class ScheduleController extends Controller
    {
      public function alldata(Request $request)
      {
        $records = Schedule::all();
        return view('show', ['schedules' => $records]);
      }
    }


## route/web.php に追記

    Route::get('/showAll', 'App\Http\Controllers\ScheduleController@alldata');

## schedulesテーブルの内容を読み込んで表示show.blade.php作成

    <body>
      <h1>Index</h1>
      @foreach ($schedules as $schedule)
        <p>{{$schedule->id}}</p>
        <p>{{$schedule->caption}}</p>
      @endforeach
    </body>

## Laravel　の　model view controller の使い方の基礎は以下を参照

https://tech.amefure.com/php-laravel-eloquent



---------------------------------------------2023.10.26 ココマデ…


## ルーティングに登録処理を設定 routes>web.php

    Route::post('/store', 'App\Http\Controllers\ScheduleController@store')->name('schedule.store');


## show.blade.php に登録部分を追記（caption と detail のみ）　※ただし、警告が表示される

    <div class="container small">
      <h2>登録</h2>
      <form action="/store" method="POST">
      @csrf
        <fieldset>
            <div class="form-group">
                <label for="caption"></label>
                <input type="text" class="form-control" name="caption" id="caption">

                <label for="detail"></label>
                <input type="text" class="form-control" name="detail" id="datail">

                <button type="submit">登録</button>
        </fieldset>
      </form>
    </div>

## ScheduleControllerにStore処理を追記

    public function store(Request $request)
    {
        $this->schedule->InsertSchedule($request);
        return redirect()->route('schedule.all');
    }

## ScheduleモデルにInsertScheduleメソッドを追記

    public function InsertSchedule($request)
    {
        return $this->create([
            'caption' => $request->caption,
            'detail'  => $request->detail,
        ]);
    }

----------------------------------------2023.11.01
## show.blade.php 登録処理に、日付　時刻　ファイルアップロードを追加

    <div>
      <label for="date">date</label>
      <input type="date" class="form-control" name="date" id="date">
    </div>

    <div>
      <label for="time">time</label>
      <input type="time" class="form-control" name="time" id="time">
    </div>

    <div>
      <input type="file" accept=".pdf, .xlsx"　id="file1" name="file1" class="form-control" />
    </div>


## ScheduleControllerに追記

    //データ登録
    public function store(Request $request)
    {
        $request->datetime = $request->date . ' ' . $request->time;
        if ($request->has('file1')) {
            $path1 = $request->file('file1')->store('public');    //ファイルを保存し、そのパスが返り値
            $request->file1 = pathinfo($path1, PATHINFO_BASENAME);//ファイル名＆拡張子のみDBに保存;
        }
        $this->schedule->InsertSchedule($request);       
        return redirect()->route('schedule.all');
    } 

## Scheduleモデルに追記

    protected $fillable = [
        'caption',
        'detail',
        'datetime',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'file1',
        'file2',
        'file3',
        'file4',
        'file5',
        'maplink'
    ];

    public function InsertSchedule($request)
    {
        return $this->create([
            'caption' => $request->caption,
            'detail'  => $request->detail,
            'datetime'  => $request->datetime,
            'image1' =>  $request->image1,
            'image2' =>  $request->image2,
            'image3' =>  $request->image3,
            'image4' =>  $request->image4,
            'image5' =>  $request->image5,
            'file1' =>  $request->file1,
            'file2' =>  $request->file2,
            'file3' =>  $request->file3,
            'file4' =>  $request->file4,
            'file5' =>  $request->file5,
            'maplink' =>  $request->maplink, 
        ]);
    }

----------------------------------------2023.11.02

## シンボリックリンクの作成
ファイルをアップロードしただけではブラウザからアップロードしたファイルを閲覧することはできません。ブラウザからサーバ上のファイルにアクセスするためには、Laravel インストールディレクトリの下にある公開用の public ディレクトリの下に保存する必要があります。しかし、アップロードしたファイルは/storage/app の下にあるためアクセスすることができません。そのため/public ディレクトリと/storage/app ディレクトリとの間でリンクを持たせる必要があります。リンクを貼ることで/public にアクセスすると/strorage/app ディレクトリにアクセスすることができるようになります。Windows で言えばショートカットをイメージしてください。Laravel ではリンクを貼る設定を行う機能も備えています。

      php artisan storage:link

を実行します。/public ディレクトリの下に storage ディレクトリが作成され、/storage/app/public へシンボリックリンクが張られます。

https://2023trip.t-watanabe.repl.co/storage/GN203kejEHXWHH6yomQeo1WGxtiO5ibwQJmlIgHl.pdf
というように、/strage/ファイル名でアクセス可能


----------------------------------------2023.11.06
# データベースのデータをtrip.blade.php に表示（日付で Day#1 ~ Day#4 )

## web.php
    Route::get('/', 'App\Http\Controllers\ScheduleController@trip');

## ScheduleController.php
    public function trip(Request $request)
    {
      $records = Schedule::all();
      return view('trip', ['schedules' => $records]);
    }




-----------------------------2023.11.13
# edit 機能追加

### web.php
    Route::get('/edit/{id}', 'App\Http\Controllers\ScheduleController@edit2');

### edit.blade.php
/edit/61 　id=61のレコードの内容を表示　image1がNullじゃなかったら、Dellボタンを表示、Dellをクリックすると…
<　input type="hidden" name="image1del" value="false">のvalueがTrueになって、送信
    <　body>

    <form action="/update" method="POST" enctype="multipart/form-data">
     <table>
      @csrf
      <input type="hidden" name="id" value="{{$schedule->id}}">

      <tr><th>caption: </th><td><input type="text" name="caption" value="{{$schedule->caption}}"></td></tr>

      <tr><th>detail: </th><td><textarea name="detail">{{$schedule->detail}}</textarea></td></tr>

      <tr><th>date: </th><td><input type="date" name="date" value="{{ Str::before($schedule->datetime, ' ') }}"></td></tr>

      <tr><th>time: </th><td><input type="time" name="time" value="{{ Str::after($schedule->datetime, ' ') }}"></td></tr>

      <tr><th>image1: </th>
      <td>
      @if(isset( $schedule->image1 ))
      <a href="/storage/{{$schedule->image1}}"><img src="/storage/{{$schedule->image1}}" style="width: auto;height: 1em;" alt=""></a>
      <button type="button" class="btn iza" onclick="delButtonClick(this)">del</button>
      <input type="file" name="image1" value="{{$schedule->image1}}" accept=".jpg, .png" style="display:none;">
      <input type="hidden" name="image1del" value="false">
      @else
      <input type="file" name="image1" value="{{$schedule->image1}}" accept=".jpg, .png">
      @endif
      </td></tr>

      </table>
    <button type="submit">更新</button>
    </form>


    <script>
    function delButtonClick(button){
      button.setAttribute('style', 'display: none;');    //ボタンを非表示
      let next = button.nextElementSibling;
      next.setAttribute('style', 'display: inline;');    //<input type="file" ******  accept=".jpg, .png">の非表示を解除
      let next2 = next.nextElementSibling;
      next2.setAttribute('value', 'true');  
      let prev = button.previousElementSibling;
      prev.setAttribute('style', 'display: none;');    //<a href***><img src****></a> を非表示
    }

    </script>

    </body>

### ScheduleController.php
    public function update(Request $request)  
    {  
      if ($request->image1del == 'true') {
        $schedule->image1 = Null;
      }
      if ($request->has('image1')) {
        $schedule->image1 = pathinfo($request->file('image1')->store('public'), PATHINFO_BASENAME);
      }
      $schedule->save();
      return redirect()->route('schedule.all');
    }


-----------------------------2023.11.16
# Laravel × JavaScript（Fetch） × MySQL を利用した非同期通信（第２回：一覧表示）
https://laraweb.net/tutorial/10777/
ここを参考に、javascript非同期通信で一覧表示

## web.php
    Route::get('/ajaxtest', 'App\Http\Controllers\ScheduleController@getIndex');
    Route::get('ajaxtest/show_all', 'App\Http\Controllers\ScheduleController@showAll'); // 全表示

## ScheduleController.php
    public function getIndex()
    {
        return view('ajaxtest');
    }
    public function showAll()
    {   
        $records = Schedule::all();
        // ヘッダーを指定することによりjsonの動作を安定させる
        header('Content-type: application/json');
        // htmlへ渡す配列$productListをjsonに変換する
        echo json_encode($records);
    }

## ajaxtest.php

    <body>
      <table border="1">
        <tr id="all_show_result">
          <th>id</th><th>caption</th>
        </tr>
      </table>

    <!--非同期通信処理-->
    <script>
    function getAllData(){    
        fetch('ajaxtest/show_all', { // 第1引数に送り先
        })
            .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
            .then(res => {
             /*--------------------
                  PHPからの受取成功
                 --------------------*/
                // 取得したレコードをeachで順次取り出す
                res.forEach(elm =>{
                    var insertHTML = "<tr><td>" + elm['id'] + "</td><td>" + elm['caption'] + "</td></tr>"
                    var all_show_result = document.getElementById("all_show_result");
                    all_show_result.insertAdjacentHTML('afterend', insertHTML);
                })
                console.log("通信成功");
                console.log(res); // 返ってきたデータ
            })
            .catch(error => {
                console.log(error); // エラー表示
            })
    }

    // 関数を実行
    getAllData();
    </script>

    </body>



-----------------------------2023.11.19
# Laravel LivewireとはBlade（Laravelの標準Viewテンプレート）を用いて、JavaScriptを記述せずにSPAを実現できるライブラリ。
これまでの様にフロントエンドにVueやReactなどフレームワークを選定する必要がなくなり、バックエンドはもちろんフロントエンドもLaravelだけで開発が可能。</br>
https://reffect.co.jp/laravel/laravel-livewire/#google_vignette </br>
https://b3s.be-s.co.jp/programming-language/php/4599/</br>


ここを参考に、Livewireを利用してSPAに対応するといいかも
Laravel × JavaScript（Fetch）は中止（Livewireの中でAjax通信が行われているみたい）

LivewireはLaravelの標準ライブラリではありません。
Laravelで認証機能を担う Jetstream を使用する際に、
View部分をLivewireかInertia（vue.js）を選択する必要があるのでその際にLivewireを選択する。
または直接インストールして使用する方法があります。


### Livewireパッケージのインストール
    composer require livewire/livewire

https://reffect.co.jp/laravel/laravel-livewire/#google_vignette </br>
を参考に

### welcome.blade.php　ファイルを以下に修正
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Livewire</title>
        @livewireStyles
    </head>
    <body>
    <h1>Hello Livewire</h1>
    <livewire:counter></livewire:counter>
        @livewireScripts
    </body>
    </html>

### Livewire関連ファイルの作成

    php artisan make:livewire counter

実行すると、app¥Http¥Livewire ディレクトリに Counter.php ファイルと resouces¥views¥livewire ディレクトリにビューファイル counter.blade.php ファイルが作成されます。

### counter.blade.php ファイルの中身
    <div>
        {{-- Close your eyes. Count to one. That is how long forever feels. --}}
        <h1>初めてのLivewire@@</h1>
        <h2>{{ $count }}</h2>
        <p><button wire:click="inc">+1</button></p>

        <input type="text" wire:model.lazy="message" />{{ $message }}
        @if(!$message)
        <p style="color:red;font-weight:bold">文字を入力してください。</p>
        @else
        <p>文字を入力しました。</p>
        @endif

        <div>
          <h2>ユーザ一覧</h2>
          <ul>
            @foreach($schedules as $schedule)
              <li>{{ $schedule->id }}　{{ $schedule->caption }}  <button wire:click="delSchedule({{ $schedule->id }})">削除</button></li>
            @endforeach
          </ul>
        </div>
    </div>

<ul>
  <li>Counter.phpファイル内の変数 $count を表示　＆ +1ボタンをクリックすると、変数が＋１される関数 "inc" 呼び出し</li>
  <li>Counter.phpファイル内の変数 $message に値をセット（inputに入力された内容）<br />
    ※デフォルトでは文字を入力後に ajax リクエストが行われるが、ajax リクエストのタイミングを操作することも可能（debounce , lazy , defer)
  </li>
  <li>livewire で if 文を利用する時は Blade の @if をそのまま利用することが可能。</li>
  <li>@foreach($schedules as $schedule)で、$schedules内のデータをすべて表示</li>
</ul>

### counter.php ファイルの中身
    namespace App\Http\Livewire;

    use Livewire\Component;
    use App\Models\Schedule;

    class Counter extends Component
    {
        public $count = 10;
        public $message;
        public $schedules;

        public function mount(){
          $this->schedules = Schedule::all();
        }

        public function delSchedule($id){
            //$idを引き継いで、trueを返したアイテムだけが残る
            $this->schedules = $this->schedules->filter(function($value, $key) use($id){    
                return $value['id'] != $id;
            });
            //データベースから削除
            $schedule = Schedule::find($id);
            $schedule->delete();
        }

        public function inc(){
            $this->count++;
        }

        public function render()
        {
            return view('livewire.counter');
        }
    }


<ul>
  <li>use App\Models\Schedule;　で利用するモデルの宣言</li>
  <li>public $message;    でbladeファイルから参照する変数の宣言</li>
  <li>public function mount(){　　<br/>
    この関数は、livewire のコンポーネントが初期化した直後に一度だけ実行され、render 関数の前に実行が行われます。</li>
  <li>render 関数があり、php artisan make:livewire counterコマンドで Counter.php ファイルと一緒に作成された counter.blade.php ファイルが指定されています。</li>
</ul>











## 以上を参考に、livewireのコンポーネント「timetable」を作成
php artisan make:livewire timetable

実行すると、app¥Http¥Livewire ディレクトリに Timetable.php ファイルと resouces¥views¥livewire ディレクトリにビューファイル timetable.blade.php ファイルが作成されます。


### welcome.blade.php　ファイルを以下に修正
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Livewire</title>
    @livewireStyles
</head>
<body>
<h1>Hello Livewire</h1>
<livewire:timetable></livewire:timetable>
    @livewireScripts
</body>
</html>

## timetable.blade.phpに以下のタグを追記（Livewireでファイルアップロード）
    <form wire:submit.prevent="save">
        <input type="file" wire:model="photo">

        @error('photo') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save Photo</button>
    </form>


## Timetable.phpに以下を追記（Livewireでファイルアップロード）
    public function save()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
        $this->photo->store('public');
    }

ファイルを選択しただけで、storage/app/livewire-tmpの中にファイルがアップロード自動でされる。save()を実行すると,publicフォルダの中に、ファイルが保存される。



### Livewireでファイルアップロードをすると、以下のようなエラー
Mixed Content: The page at 'https://(省略)/' was loaded over HTTPS, but requested an insecure XMLHttpRequest endpoint 'http://(省略)/contents/'. This request has been blocked; the content must be served over HTTPS.

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

これを　welcome.blade.php に記載すると、エラー発生せず


## Livewire-tmp がクリーンアップされない
ファイルのクリーンアップは 24 時間に 1 回だと思うので、すぐに実行されるとは思いません。ローカル ファイルの場合は自動で、S3 でクリーンアップのために実行する設定コマンドがあります。























# xserverでの公開


### gitHub に新規リポジトリ作成
### Replit > 該当プロジェクトに移動 > git > setting -> Remote に　git@github.com:t-watanabe-seiei/2023trip-2.git > save


https://chigusa-web.com/blog/xserver-laravel-github/
### Xserver にログインして、Laravel用のプロジェクトディレクトリを用意し、Gitクローンを行います。
    $ git clone git@github.com:t-watanabe-seiei/school-trip.git
### GitHubから最新の「masterブランチ」を取り込む  ( 認証用パスワード必要 )
    git fetch
    git pull
### school-tripフォルダに移動
    $ cd school-trip
### Composerパッケージのインストール
    $ composer install
### APP_KEYを更新します。
    $ php artisan key:generate
### .envファイルを適宜修正します。（一部抜粋）
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=http://初期ドメイン
### ひとつ上のフォルダに移動
    $ cd ../
### 公開ディレクトリの設定
Laravelプロジェクト直下のpublicフォルダを、公開フォルダに配置します。シンボリックリンクを貼ります。
    $ ln -s /home/seiei9/seiei.online/public_html/trip2023.seiei.online/school-trip/public app
### laravel-mixとLaravelプラグインのインストール
    npm install          ※エラーが出たら npm audit fix --force
### 空のSQLiteデータベース ファイルの作成
    touch database/database.sqlite
### あらかじめ登録されたマイグレーションを実行し、テーブル作成(users,password_resets,failed_jobs,personal_access_tokens)
     php artisan migrate
### seeder実行 (DatabaseSeederに登録されたSeederが実行される)
     php artisan db:seed
### phpLiteAdminの設定変更
    $databases = array(
      array(
        'path'=> '/home/runner/2023trip/database/database.sqlite', 
        'path'=> '/home/seiei9/seiei.online/public_html/trip2023.seiei.online/school-trip/database/database.sqlite',
        'name'=> 'main'
      )
    );
    
### Nodeパッケージのインストールとビルド
プロジェクト直下で以下のコマンドを実行し、NPMパッケージをインストールします。
      $ npm install

## シンボリックリンクの作成
      $ php artisan storage:link
を実行します。/public ディレクトリの下に storage ディレクトリが作成され、/storage/app/public へシンボリックリンクが張られます。
https://2023trip.t-watanabe.repl.co/storage/GN203kejEHXWHH6yomQeo1WGxtiO5ibwQJmlIgHl.pdf
というように、/strage/ファイル名でアクセス可能


### 本番環境で、サブディレクトリを設置した場合、Livewire.js が 404 Not Found の解決方法
    php artisan livewire:publish --config

 ##### を実行すると、config/livewire.php が生成される。config/livewire.phpに以下の記載
    'asset_url' => null,
    // という箇所を
    
    'asset_url' => env('ASSET_URL', null),
    // と変更します。

  ##### 次に本番環境のenvファイルに以下のようにASSET_URLをセットします。envファイル内のどこに入れてもいいです。

    ASSET_URL="/subdir"








## npm  run dev　　(npm run dev　このコマンドで、「JSやCSSもビルドされる」)
(※Laravel9.x期間の途中でlaravel-mix → viteに変更なんて破棄的変更を容赦なくやったので初心者は当然混乱。)


