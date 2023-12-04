<div> <!--  compornent ココから  -->

<!-- ***********************************  bootstrap navi-bar  ***************************************** -->
<div class='fixed-top'>  <!-- navi-barをTopに固定 -->
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
          <a class="nav-link disabled">allowance</a>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link btn" role="button" wire:click="$toggle('isNewScheduleCard')">new Schedule</a>
        </li>

        <!-- li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li -->

      </ul>

      <!-- <button type="button" class="btn btn-success mx-1" wire:click="$toggle('isNewScheduleCard')">new</button>
      <button type="button" class="btn btn-success mx-1" wire:click="$toggle('isEditScheduleCard')">edit</button> -->

      <!-- form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form -->



    </div>
  </div>
</nav>
</div>
<!-- ***********************************  bootstrap navi-bar  ここまで***************************************** -->







<div class="container-fluid" style="margin-top: 3em;">　

  <div class="row">
    <h6>ーSCHEDULEー</h6>

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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ Str::before($schedule->datetime, ' ') }}" aria-expanded="false" aria-controls="{{ Str::before($schedule->datetime, ' ') }}">
                  {{ Str::before($schedule->datetime, ' ') }}   <!-- 半角スペースより左が日付 -->
                </button>
              </h2>

              <div id="{{ Str::before($schedule->datetime, ' ') }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">

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








                  <p class="text-start mx-5">
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
    <h5 class="card-header">new schedule</h5>
    <div class="card-body">
      <h5 class="card-title">Insert time schedule</h5>
      <p class="card-text">Please enter the required information.</p>


          <form wire:submit.prevent="newSave" id="newSchedule">
            <div class="mb-3">
              <label for="caption" class="form-label">caption</label>
              <input type="text" class="form-control" name="caption" id="caption" wire:model.defer="caption">
            </div>

            <div class="mb-3">
              <label for="detail" class="form-label">detail</label>
              <textarea class="form-control" id="detail" name="detail" rows="5" wire:model.defer="detail"></textarea>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="date" class="form-label">date</label>
                <input type="date" class="form-control" name="date" id="date" wire:model.lazy="date">
              </div>
              <div class="col">
                <label for="time" class="form-label">time</label>
                <input type="time" class="form-control" name="time" id="time" wire:model.defer="time">
              </div>
            </div>

            <div class="mb-3">
              <label for="images" class="form-label">images</label>
              <input type="file" wire:model="images" accept=".jpg, .jpeg, .png, .gif" class="form-control" multiple>
              @error('images.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div> 

            <div class="mb-3">
            <label for="images" class="form-label">files</label>
                <input type="file" wire:model="files" accept=".pdf, .xlsx, .docx" class="form-control" multiple>
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
        <h5 class="card-header">edit schedule</h5>
        <div class="card-body">
          <h5 class="card-title">edit time schedule</h5>
          <p class="card-text">Please enter the required information.</p>

              <form wire:submit.prevent="editSave" id="editSchedule">
                <div class="mb-3">
                  <label for="caption" class="form-label">caption</label>
                  <input type="text" class="form-control" name="caption" id="caption" wire:model.defer="caption">
                </div>

                <div class="mb-3">
                  <label for="detail" class="form-label">detail</label>
                  <textarea class="form-control" id="detail" name="detail" rows="5" wire:model.defer="detail"></textarea>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="date" class="form-label">date</label>
                    <input type="date" class="form-control" name="date" id="date" wire:model.lazy="date">
                  </div>
                  <div class="col">
                    <label for="time" class="form-label">time</label>
                    <input type="time" class="form-control" name="time" id="time" wire:model.defer="time">
                  </div>
                </div>



                @if(isset($image1) || isset($image2) || isset($image3))
                  <div class="mb-3">
                     <div class="col"><label for="images" class="form-label">images</label></div>
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
                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="imageDelete()">delete</button>
                      </div>
                  </div> 
                @else
                  <div class="mb-3">
                    <label for="images" class="form-label">images (Up to 3 possible)</label>
                    <input type="file" wire:model="images" accept=".jpg, .jpeg, .png, .gif" class="form-control" multiple>
                    @error('images.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
                  </div>
                @endif



                @if(isset($file1) || isset($file2) || isset($file3))
                  <div class="mb-3">
                     <div class="col"><label for="images" class="form-label">files</label></div>
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
                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="fileDelete()">delete</button>
                      </div>
                  </div> 
                @else
                  <div class="mb-3">
                  <label for="images" class="form-label">files (Up to 3 possible)</label>
                      <input type="file" wire:model="files" accept=".pdf, .xlsx, .docx" class="form-control" multiple>
                      @error('files.*') <div class="alert alert-danger">{{ $message }}</div> @enderror
                  </div>
                @endif



                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save schedule</button>
                    <div class="float-end">
                      <a class="btn btn-sm btn-outline-danger" role="button" wire:click="deleteSchedule({{ $schedule_id }})"><i class="fa-solid fa-trash-can"></i></a>
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
    <h5 class="card-header">What to Bring</h5>
    <div class="card-body">
      <h5 class="card-title">What to Bring</h5>
      <p class="card-text">Please read information.</p>
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList01">
                <label class="form-check-label" for="CheckList01">Bring list 01</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList02">
                <label class="form-check-label" for="CheckList02">Bring list 02</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList03">
                <label class="form-check-label" for="CheckList03">Bring list 03</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList04">
                <label class="form-check-label" for="CheckList03">Bring list 04</label>
              </div>
            </div>

    </div>
  </div>
@endif





<!-- *******************what to bring カード end********************* -->

















    </div>
  </div>
</div>　　<!--   div class="container-fluid"  ココマデ*********************************  -->







<script>
  //該当日付のアコーディオンを開く
  window.addEventListener('show_accordion', event => {
      //if(confirm('編集します。よろしいですか？')) {
          //console.log(event.detail.currentDate);
          let elm = document.getElementById(event.detail.currentDate); 
          if (elm === null){
            // 要素が存在しない場合の処理
          } else {
            // 要素が存在する場合の処理
            elm.classList.toggle("show");
          }



      //}
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


  //Editボタンを押した際、画像ファイルor添付ファイルがある場合の、Delボタンの処理
  function delButtonClick(button){
    let propName = button.getAttribute('name');
    if(propName == 'image'){
      @this.imageDelete();
    }else if(propName == 'file'){
      @this.fileDelete();
    }
  }
</script>














</div>　<!--  compornent ココまで  -->