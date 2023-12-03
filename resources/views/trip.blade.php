<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 
      This is an HTML comment
      You can write text in a comment and the content won't be visible in the page
    -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="https://glitch.com/favicon.ico" />

    <!--
      This is the page head - it contains info the browser uses
      Like the title, which appears on the browser tab but not inside the page
      Further down you'll see the content that displays in the page
    -->
    <title>たびのしおり</title>

    <!-- The website stylesheet -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- The website JavaScript file -->
    <script src="/script.js" defer></script>
  </head>
  <body>
    <!--
      The body includes the content you see in the page
      Each element is defined using tags, like this <div></div>
      The attributes like class="wrapper" let us style elements in the CSS
    -->
    
    
<!--グローバルナビゲーション-->
  <header class="openbtn1">
      
      <!-- ハンバーガーメニュー部分 -->
      <div class="nav">
    
        <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
    
        <!-- ハンバーガーアイコン -->
        <label for="drawer_input" class="drawer_open"><span></span></label>
    
        <!-- メニュー -->
        <nav class="nav_content">
          <ul>
            <li><a href="#">日程</a></li>
            <li><a href="#">概要</a></li>  
          </ul>
        </nav>
    
      </div>
    </header>

        
     <div class="wrapper">
      <div class="content" role="main">
        <div class="size_test">たびのしおり</div>
        <p>TAKETOMI TRIP September 10</p>
      </div>
        
    <hr width="400">
        <p>ーSCHEDULEー</p>
        
        
  <div class="instructions">
     <h1>=Day1=</h1>
    
 <ul class="time-schedule">
  <li>
    <span class="time">9:30</span>
    <div class="sch_box"><p class="sch_title"><span class="under">離島ターミナル</span></p>
      <p class="sch_tx">
      石垣島発フェリーに乗って竹富島へ！<br>チケットはネットで予約!約10分前にアナウンスが流れるからその番号の乗り場に向かう
      </p>
   </div>
    <div style="text-align: center;"><img src="https://cdn.glitch.global/b8aff673-cf77-4b70-9368-f0850c063f54/thumbnails%2FP00019AFF0.jpg?1692102873072" /></div>
  </li>
  <li>
    <span class="time"></span>
    <div class="sch_box">
      <p class="sch_title"><span class="under">移動</span></p>
      <p class="sch_tx">集落まで徒歩15分ほど👣⸒⸒<span class="under">友利観光</span>で自転車を借りる！
      </p>
    </div>
    <div class="switchdsp">
      <label for="l-1">
<span class="clicktxt">map</span>
</label>
<input type="checkbox" id="l-1"><div class="dsp">
<p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d962.9196742628327!2d124.08772231355373!3d24.329047679744253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3460755e2b20e4a3%3A0x902c5152025b7d46!2z5qCq5byP5Lya56S-5Y-L5Yip6Kaz5YWJ!5e0!3m2!1sja!2sjp!4v1692099100198!5m2!1sja!2sjp" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
</div></div>
  </li>
  <li>
    <span class="time">11:00</span>
    <div class="sch_box"><p class="sch_title"><span class="under">お食事処かにふ</span></p>
      <p class="sch_tx">
      混み出す前にランチ！定休日でなくても急にお休みになることも多くあるから事前に電話📞
      </p>
    </div>
    <div class="switchdsp">
<label for="l-2">
<span class="clicktxt">map</span>
</label>
<input type="checkbox" id="l-2"><div class="dsp">
<p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1817.73968571407!2d124.08666459132934!3d24.3297887931407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346075c98dadda59%3A0x89a44e596354c351!2z44GK6aOf5LqL5YemIOOBi-OBq-OBtQ!5e0!3m2!1sja!2sjp!4v1692101643806!5m2!1sja!2sjp" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
</div></div>
</p>
  </li>
  <li>
    <span class="time">12:30</span>
    <div class="sch_box"><p class="sch_title"><span class="under">海巡り！</span></p>
      <p class="sch_tx">
      集落からは少し遠いからまとめて☀️
      </p>
    </div>
  </li>
</ul>
</label>
</div>

        
    </div>
    <!-- The footer holds our remix button — you can keep or delete it ✂ -->
    <footer class="footer">
      <div class="links"></div>
      <a
        class="btn--remix"
        target="_top"
        href="https://glitch.com/edit/#!/remix/glitch-hello-website"
      >
        <img
          src="https://cdn.glitch.com/605e2a51-d45f-4d87-a285-9410ad350515%2FLogo_Color.svg?v=1618199565140"
          alt=""
        />
        Remix on Glitch
      </a>
    </footer>
  </body>
</html>
