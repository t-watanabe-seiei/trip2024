<div> <!--  compornent ココから  -->

<!-- ***********************************  bootstrap navi-bar  ***************************************** -->
<!-- navi-barをTopに固定 -->
<!-- <div class='fixed-top'>  
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand mx-3" href="#">たびのしおり</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-3">
          <a class="nav-link active" >Home</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link btn" role="button" wire:click="$toggle('isIntroduction')">introduction</a>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link btn" role="button" wire:click="$toggle('isWhatToBring')">What to bring</a>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link disabled btn" role="button" >allowance</a>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link btn" role="button" wire:click="$toggle('isNewScheduleCard')">new Schedule</a>
        </li>

      </ul>

    </div>
  </div>
</nav>
</div> -->
<!-- ***********************************  bootstrap navi-bar  ここまで***************************************** -->

<!--  app.blade.php から引っ張ってきた navi-barと融合  -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">


  <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> -->
      <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
              {{ config('app.name', 'Laravel') }}
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav me-auto">
                  <li class="nav-item mx-3">
                    <a class="nav-link btn" role="button" wire:click="$toggle('isIntroduction')">introduction</a>
                  </li>

                  <li class="nav-item mx-3">
                    <a class="nav-link btn" role="button" wire:click="$toggle('isWhatToBring')">What to bring</a>
                  </li>

                  <li class="nav-item mx-3">
                    <a class="nav-link disabled btn" role="button" >allowance</a>
                  </li>
              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ms-auto">
                  <!-- Authentication Links -->
                  @guest
                      @if (Route::has('login'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                      @endif

                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else

                    <li class="nav-item mx-3">
                      <a class="nav-link btn" role="button" wire:click="$toggle('isNewScheduleCard')">new Schedule</a>
                    </li>


                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>

                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>




<div class="container-fluid" style="margin-top: 0em;">　

  <div class="row">
    <h6>ーSCHEDULEー</h6>
    @auth
      {{-- ログイン中の場合 --}}
      <h6>{{ Auth::user()->name }}  {{ Auth::user()->id }}  {{ Auth::user()->email }}</h6>
    @endauth

    <div class="col-sm-7">
<!--  ***********************スケジュールの表示　view***************************************************** -->


      <div class="accordion mt-1" id="accordionExample2">    
      @php
        $scheduleDate = '';
      @endphp

      @foreach ($schedules as $schedule)  	     
          @if ($scheduleDate != Str::before($schedule->datetime, ' '))

              @if ($scheduleDate != '')　　	{{-- レコード２件目以降 前件のaccordion-item   accordion-collapse   accordion-body   ul を閉じる --}}
                   </ul>
                  </div>
                  </div>
                  </div>
              @endif

              <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_{{ Str::before($schedule->datetime, ' ') }}" aria-expanded="false" aria-controls="id_{{ Str::before($schedule->datetime, ' ') }}">
                  {{ Str::before($schedule->datetime, ' ') }}   <!-- 半角スペースより左が日付 -->
                </button>
              </h2>

              <div id="id_{{ Str::before($schedule->datetime, ' ') }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">

              <div class="accordion-body">
                <ul class="time-schedule"> 
          @endif

              <li>
                <span class="time">{{ Str::after($schedule->datetime, ' ') }}</span>    <!-- 半角スペースより右が時刻 -->
                <div class="sch_box">
                  <p class="sch_title">
                    <span class="under">{{$schedule->caption}}</span>
                    <a class="btn" role="button" wire:click="openEditCard({{ $schedule->id }}, '{{ $schedule->caption }}' , '{{ Str::before($schedule->datetime, ' ') }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                  </p>
                  <p class="sch_tx">

                  @if (!empty($schedule->image1))　　{{-- image1が空じゃなければ・・・ --}}

                    <!-- カルーセルで画像表示　画像をクリックすると、lighbox 用 modal で画像を表示 -->    
                        <div id="{{ $schedule->image1 }}" class="carousel slide mb-4" data-bs-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <a 
                                data-bs-toggle="modal" 
                                data-bs-target="#lightboxModalFullscreen" 
                                data-bs-lightbox="storage/{{ $schedule->image1 }}" role="button">
                                  <img
                                     src="storage/{{ $schedule->image1 }}" 
                                     class="img-fluid img-thumbnail rounded mx-auto d-block w-75"
                                  />
                              </a>
                            </div>

                          @if (!empty($schedule->image2))　　{{-- image2が空じゃなければ・・・ --}}
                            <div class="carousel-item">
                              <a 
                                data-bs-toggle="modal" 
                                data-bs-target="#lightboxModalFullscreen" 
                                data-bs-lightbox="storage/{{ $schedule->image2 }}" 
                                role="button">
                                  <img 
                                    src="storage/{{ $schedule->image2 }}" 
                                    class="img-fluid img-thumbnail rounded mx-auto d-block w-75" />
                              </a>
                            </div>
                          @endif


                          @if (!empty($schedule->image3))　　{{-- image3が空じゃなければ・・・ --}}
                            <div class="carousel-item">
                              <a 
                                data-bs-toggle="modal" 
                                data-bs-target="#lightboxModalFullscreen" 
                                data-bs-lightbox="storage/{{ $schedule->image3 }}" 
                                role="button">
                                  <img 
                                    src="storage/{{ $schedule->image3 }}" 
                                    class="img-fluid img-thumbnail rounded mx-auto d-block w-75" />
                              </a>
                            </div>
                          @endif


                          @if (!empty($schedule->image4))　　{{-- image4が空じゃなければ・・・ --}}
                            <div class="carousel-item">
                              <a 
                                data-bs-toggle="modal" 
                                data-bs-target="#lightboxModalFullscreen" 
                                data-bs-lightbox="storage/{{ $schedule->image4 }}" 
                                role="button">
                                  <img 
                                    src="storage/{{ $schedule->image4 }}" 
                                    class="img-fluid img-thumbnail rounded mx-auto d-block w-75" />
                              </a>
                            </div>
                          @endif


                          @if (!empty($schedule->image5))　　{{-- image5が空じゃなければ・・・ --}}
                            <div class="carousel-item">
                              <a 
                                data-bs-toggle="modal" 
                                data-bs-target="#lightboxModalFullscreen" 
                                data-bs-lightbox="storage/{{ $schedule->image5 }}" 
                                role="button">
                                  <img 
                                    src="storage/{{ $schedule->image5 }}" 
                                    class="img-fluid img-thumbnail rounded mx-auto d-block w-75" />
                              </a>
                            </div>
                          @endif


                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#{{ $schedule->image1 }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#{{ $schedule->image1 }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                        </div>
                    <!-- カルーセル ここまで -->
                  @endif








                  <p class="text-start">
                    {!! $schedule->detail !!}
                  </p>

                    @if (!empty($schedule->file1))　　{{-- file1が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm m-1" role="button" href="storage/{{ $schedule->file1 }}" target="_blank">添付ファイル１</a>
                    @endif

                    @if (!empty($schedule->file2))　　{{-- file2が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm m-1" role="button" href="storage/{{ $schedule->file2 }}" target="_blank">添付ファイル２</a>
                    @endif

                    @if (!empty($schedule->file3))　　{{-- file2が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm m-1" role="button" href="storage/{{ $schedule->file3 }}" target="_blank">添付ファイル３</a>
                    @endif
                  </p>
                </div>
              </li>

          @if ($loop->last)    	{{-- @foreachループの最後 --}}
              </ul>
            </div>
            </div>
            </div>
          @endif

          @php
            $scheduleDate = Str::before($schedule->datetime, ' ');
          @endphp

      @endforeach

      </div>




<!--  *************************スケジュールの表示　view end********************************************* -->
    </div>
    <div class="col-sm-5">


<!--  *****************new schedule 用のカード************************************************ -->

@if ($isNewScheduleCard)
  <div class="card mt-1 schedule_card" style="position: sticky;top: 60px;" id="new_schedule_card">
    <h5 class="card-header">new schedule <button type="button" class="btn-close float-end" aria-label="Close" wire:click="$toggle('isNewScheduleCard')"></button></h5>
    <div class="card-body">
      <p class="card-text">Please enter the required information.</p>


          <form wire:submit.prevent="newSave" id="newSchedule">
            <div class="mb-3">
              <label for="new_caption" class="form-label">caption</label>
              <input type="text" class="form-control" name="caption" id="new_caption" wire:model.defer="caption">
            </div>

            <div class="mb-3">
              <label for="new_detail" class="form-label">detail</label>
              <textarea class="form-control" id="new_detail" name="detail" rows="5" wire:model.defer="detail"></textarea>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="new_date" class="form-label">date</label>
                <input type="date" class="form-control" name="date" id="new_date" wire:model.lazy="date">
              </div>
              <div class="col">
                <label for="new_time" class="form-label">time</label>
                <input type="time" class="form-control" name="time" id="new_time" wire:model.defer="time">
              </div>
            </div>

            <div class="mb-3">
              <label for="new_images" class="form-label">images</label>
              <input type="file" wire:model="images" id="new_images" accept=".jpg, .jpeg, .png, .gif" class="form-control" multiple>
              @error('images.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div> 

            <div class="mb-3">
            <label for="new_files" class="form-label">files</label>
                <input type="file" wire:model="files" id="new_files" accept=".pdf, .xlsx, .docx" class="form-control" multiple>
                @error('files.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-outline-success">Save</button>
            </div>

          </form>

          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

    </div>
  </div>
@endif





<!-- *******************new schedule 用のカード end********************* -->




<!--  *****************edit schedule 用のカード************************************************ -->

@if ($isEditScheduleCard)
      <div class="card mt-1 schedule_card" style="position: sticky;top: 60px;" id="edit_schedule_card">
        <h5 class="card-header">edit schedule<button type="button" class="btn-close float-end" aria-label="Close" wire:click="$toggle('isEditScheduleCard')"></button></h5>

        <div class="card-body">
          <p class="card-text">Please enter the required information.</p>

              <form wire:submit.prevent="editSave" id="editSchedule">
                <div class="mb-3">
                  <label for="edit_caption" class="form-label">caption</label>
                  <input type="text" class="form-control" name="caption" id="edit_caption" wire:model.defer="caption">
                </div>

                <div class="mb-3">
                  <label for="edit_detail" class="form-label">detail</label>
                  <textarea class="form-control" id="edit_detail" name="detail" rows="5" wire:model.defer="detail"></textarea>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="edit_date" class="form-label">date</label>
                    <input type="date" class="form-control" name="date" id="edit_date" wire:model.lazy="date">
                  </div>
                  <div class="col">
                    <label for="edit_time" class="form-label">time</label>
                    <input type="time" class="form-control" name="time" id="edit_time" wire:model.defer="time">
                  </div>
                </div>



                @if(isset($image1) || isset($image2) || isset($image3))
                  <div class="mb-3">
                     <div class="col"><label for="edit_images_btn" class="form-label">images</label></div>
                      <div class="col">
                        @isset($image1)
                          <a href="storage/{{$image1}}" target="_blank"><img src="storage/{{$image1}}" style="width: auto;height: 2em;" alt=""></a>
                        @endisset
                        @isset($image2)
                          <a href="storage/{{$image2}}" target="_blank"><img src="storage/{{$image2}}" style="width: auto;height: 2em;" alt=""></a>
                        @endisset
                        @isset($image3)
                          <a href="storage/{{$image3}}" target="_blank"><img src="storage/{{$image3}}" style="width: auto;height: 2em;" alt=""></a>
                        @endisset
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="edit_images_btn" wire:click="imageDelete()">delete</button>
                      </div>
                  </div> 
                @else
                  <div class="mb-3">
                    <label for="edit_images" class="form-label">images (Up to 3 possible)</label>
                    <input type="file" wire:model="images" id="edit_images" accept=".jpg, .jpeg, .png, .gif" class="form-control" multiple>
                    @error('images.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
                  </div>
                @endif



                @if(isset($file1) || isset($file2) || isset($file3))
                  <div class="mb-3">
                     <div class="col"><label for="edit_files_btn" class="form-label">files</label></div>
                      <div class="col">
                        @isset($file1)
                          <a href="storage/{{$file1}}" target="_blank">file1</a>
                        @endisset
                        @isset($file2)
                          <a href="storage/{{$file2}}" target="_blank">file2</a>
                        @endisset
                        @isset($file3)
                          <a href="storage/{{$file3}}" target="_blank">file3</a>
                        @endisset
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="edit_files_btn" wire:click="fileDelete()">delete</button>
                      </div>
                  </div> 
                @else
                  <div class="mb-3">
                  <label for="edit_files" class="form-label">files (Up to 3 possible)</label>
                      <input type="file" wire:model="files" id="edit_files" accept=".pdf, .xlsx, .docx" class="form-control" multiple>
                      @error('files.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
                  </div>
                @endif



                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save schedule</button>
                    <div class="float-end">
                      <!--a class="btn btn-sm btn-outline-danger" role="button" wire:click="deleteSchedule({{ $schedule_id }})"><i class="fa-solid fa-trash-can"></i></a-->
                      <a class="btn btn-sm btn-outline-danger" role="button" onclick="delButtonClick({{ $schedule_id }})"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>


              </form>

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

        </div>
      </div>
@endif



<!-- *******************edit schedule 用のカード end********************* -->













<!--  *****************what to bring カード************************************************ -->
@if ($isWhatToBring)
  <div class="card mt-1 schedule_card" style="position: sticky;top: 60px;" id="new_schedule_card">
    <h5 class="card-header">What to Bring<button type="button" class="btn-close float-end" aria-label="Close" wire:click="$toggle('isWhatToBring')"></button></h5>
    <div class="card-body">
      <h5 class="card-title">Baggage to send in advance</h5>
        <!-- <p class="card-text">Baggage to send in advance</p> -->
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList101">
                <label class="form-check-label" for="CheckList101">Bring list 01</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList102">
                <label class="form-check-label" for="CheckList102">Bring list 02</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList103">
                <label class="form-check-label" for="CheckList103">Bring list 03</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList104">
                <label class="form-check-label" for="CheckList104">Bring list 04</label>
              </div>
            </div>

      <h5 class="card-title">Baggage on the day of travel</h5>

      <!-- <p class="card-text">Baggage for the day</p> -->
      <div class="mb-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList201">
          <label class="form-check-label" for="CheckList201">しおり</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList202">
          <label class="form-check-label" for="CheckList202">健康保険証(可能な限り原本を推奨）　<br/>※コピーは使えない場合あり)</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList203">
          <label class="form-check-label" for="CheckList203">Bring list 03</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList204">
          <label class="form-check-label" for="CheckList204">Bring list 04</label>
        </div>
      </div>

    </div>
  </div>
@endif
<!-- *******************what to bring カード end********************* -->



<!--  *****************Introduction カード************************************************ -->
@if ($isIntroduction)
  <div class="card mt-1 schedule_card" style="position: sticky;top: 60px;" id="new_schedule_card">
    <h5 class="card-header">Introduction<button type="button" class="btn-close float-end" aria-label="Close" wire:click="$toggle('isIntroduction')"></button></h5>
    <div class="card-body">
      <h5 class="card-title">Introduction</h5>
        <p class="card-text">A school trip is a school event that gives us a wide range of knowledge and experiences that cannot be obtained during normal school life.</p>

      <h5 class="card-title">bout clothes</h5>
        <p class="card-text">A Uniforms will be worn on the first and last day. On other days, you may wear casual clothes.</p>
    </div>
  </div>
@endif
<!-- *******************Introduction カード end********************* -->















    </div>
  </div>
</div>　　<!--   div class="container-fluid"  ココマデ*********************************  -->







<script>
  //該当日付のアコーディオンを開く
  window.addEventListener('show_accordion', event => {
          let elm = document.getElementById('id_' + event.detail.currentDate); 
          if (elm === null){
            // 要素が存在しない場合の処理
          } else {
            // 要素が存在する場合の処理
            elm.classList.toggle("show");
          }
  });

  window.addEventListener('reset_new_shedule', event => {
          let form = document.getElementById("newSchedule");
          let currentDate = event.detail.currentDate;
          let currentTime = event.detail.currentTime;
          form.reset();
          @this.set('date' , currentDate);    //Timetable.phpの $dateプロパティ に '2023-12-13'　日付文字列をセット
          @this.set('time' , currentTime);    //Timetable.phpの $dateプロパティ に '2023-12-13'　日付文字列をセット
  });

  window.addEventListener('reset_edit_shedule', event => {
          let form = document.getElementById("editSchedule");
          form.reset();
  })

  //Editボタンを押した際、ゴミ箱ボタンの処理
  function delButtonClick(id){
    if(confirm('削除します。よろしいですか？')) {
      @this.deleteSchedule(id);
    }
  }

</script>














</div>　<!--  compornent ココまで  -->