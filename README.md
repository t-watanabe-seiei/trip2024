<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Replit setup
1. run `php artisan key:generate` to generate an unique key for your project
1. set environment variables in `.laravel.env`
1. ▶ Run

**Laravel doesn't support replit's database,
so you have to use an external database :(**

----

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).





*************************************************************

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
            $table->string('detail');
            $table->dateTime('time');
            $table->string('image');
            $table->string('map');
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

2023.10.04 ココマデ…




## npm  run dev　　(npm run dev　このコマンドで、「JSやCSSもビルドされる」)
(※Laravel9.x期間の途中でlaravel-mix → viteに変更なんて破棄的変更を容赦なくやったので初心者は当然混乱。)


