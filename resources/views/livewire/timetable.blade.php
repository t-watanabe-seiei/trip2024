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
    
    <div class="col-sm-7">
<!--  ***********************スケジュールの表示　view***************************************************** -->


      <div class="accordion mt-1" id="accordionExample2">    
      @php
        $scheduleCource = '';
      @endphp

      @foreach ($schedules as $schedule)  	     
          @if ($scheduleCource != $schedule->cource)

              @if ($scheduleCource != '')　　	{{-- レコード２件目以降 前件のaccordion-item   accordion-collapse   accordion-body   ul を閉じる --}}
                   </ul>
                  </div>
                  </div>
                  </div>
              @endif

              <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_{{ $schedule->cource }}" aria-expanded="false" aria-controls="id_{{ $schedule->cource }}">
                  {{ $schedule->cource }}   <!-- 半角スペースより左が日付 -->
                </button>
              </h2>

              <div id="id_{{ $schedule->cource }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">

              <div class="accordion-body">
                <ul class="time-schedule"> 
          @endif

              <li>
                <span class="time">{{ Str::after($schedule->datetime, ' ') }}</span>    <!-- 半角スペースより右が時刻 -->
                <div class="sch_box">
                  <p class="sch_title mt-1">
                    <span class="under">{{$schedule->caption}}</span>

                    @auth  {{-- ログイン中の場合 --}}
                      @can('admin')  {{-- 管理者の場合 --}}
                          <a class="btn" role="button" wire:click="openEditCard({{ $schedule->id }}, '{{ $schedule->caption }}' , '{{ Str::before($schedule->datetime, ' ') }}')">
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>
                      @endcan
                      @can('general')  {{-- 管理者以外の場合 - --}}
                        @if ($schedule->user_id == Auth::user()->id)
                          <a class="btn" role="button" wire:click="openEditCard({{ $schedule->id }}, '{{ $schedule->caption }}' , '{{ Str::before($schedule->datetime, ' ') }}')">
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>
                        @endif
                      @endcan
                    @endauth

                    
                  </p>
                  <p class="sch_tx">

                    <p class="text-start">
                      {!! nl2br($schedule->detail) !!}
                    </p>

                  @if (!empty($schedule->image1))　　{{-- image1が空じゃなければ・・・ --}}

                    <!-- カルーセルで画像表示　画像をクリックすると、lighbox 用 modal で画像を表示 -->    
                        <div id="{{ $schedule->image1 }}" class="carousel slide mb-2">
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










                    @if (!empty($schedule->file1))　　{{-- file1が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm mx-1" role="button" href="storage/{{ $schedule->file1 }}" target="_blank">添付ファイル１</a>
                    @endif

                    @if (!empty($schedule->file2))　　{{-- file2が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm mx-1" role="button" href="storage/{{ $schedule->file2 }}" target="_blank">添付ファイル２</a>
                    @endif

                    @if (!empty($schedule->file3))　　{{-- file2が空じゃなければボタン表示 --}}
                      <a class="btn btn-outline-success btn-sm mx-1" role="button" href="storage/{{ $schedule->file3 }}" target="_blank">添付ファイル３</a>
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
            $scheduleCource = $schedule->cource;
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

              

              <select class="form-select" aria-label="Default select example" name="cource" id="new_cource" wire:model.lazy="cource">
                <option selected>----</option>
                <option value="2025-02-03_事前荷物発送">2025-02-03_事前荷物発送</option>
                <option value="2025-02-05_スキースノボ">2025-02-05_スキースノボ</option>
                <option value="2025-02-05_観光">2025-02-05_観光</option>
                <option value="2025-02-06_スキースノボ">2025-02-06_スキースノボ</option>
                <option value="2025-02-06_観光（福井恐竜）">2025-02-06_観光（福井恐竜）</option>
                <option value="2025-02-06_観光（大阪企業施設見学）">2025-02-06_観光（大阪企業施設見学）</option>
                <option value="2025-02-06_観光（滋賀周遊）">2025-02-06_観光（滋賀周遊）</option>
                <option value="2025-02-07">2025-02-07</option>
                <option value="2025-02-08">2025-02-08</option>
              </select>


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
      <h5 class="card-title">事前に送る荷物</h5>
        <!-- <p class="card-text">Baggage to send in advance</p> -->
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList101">
                <label class="form-check-label" for="CheckList101">着替え（2日目・3日目は私服も可 華美でないもの）</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList102">
                <label class="form-check-label" for="CheckList102">下着</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList103">
                <label class="form-check-label" for="CheckList103">靴下</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList104">
                <label class="form-check-label" for="CheckList104">部屋着（体操服のジャージ上下）</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList105">
                <label class="form-check-label" for="CheckList105">マスク</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList106">
                <label class="form-check-label" for="CheckList106">ビニール袋（洗濯物や荷物整理等に使うため）</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckList107">
                <label class="form-check-label" for="CheckList107">ペットボトルのお茶などの飲み物</label>
              </div>



      <h5 class="card-title">旅行当日に持っていく荷物</h5>

      <!-- <p class="card-text">Baggage for the day</p> -->
      <div class="mb-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList201">
          <label class="form-check-label" for="CheckList201">しおり</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList201">
          <label class="form-check-label" for="CheckList201">筆記用具</label>
        </div>
        
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList202">
          <label class="form-check-label" for="CheckList202">保険証(原本またはコピー）　<br/>※コピーは使えない場合あり</label>
        </div>
        
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList203">
          <label class="form-check-label" for="CheckList203">常備薬（酔い止め・風邪薬・下痢止め・解熱剤など）</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList204">
          <label class="form-check-label" for="CheckList204">コンタクトの洗浄液・コンタクトケース</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList205">
          <label class="form-check-label" for="CheckList205">女子生理用品</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList206">
          <label class="form-check-label" for="CheckList206">小遣い　<br/>お土産代＆３日目ミールクーポン3000円不足分の食事代</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList207">
          <label class="form-check-label" for="CheckList207">手袋・マフラー・帽子・携帯用カイロ・雨具</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList208">
          <label class="form-check-label" for="CheckList208">マスク</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList209">
          <label class="form-check-label" for="CheckList209">携帯電話・充電器・モバイルバッテリー</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList210">
          <label class="form-check-label" for="CheckList210">キャリーバッグの鍵</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList211">
          <label class="form-check-label" for="CheckList211">日焼け止め（スキースノボ選択者）</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="CheckList212">
          <label class="form-check-label" for="CheckList212">ウェアの中に着る服＋厚手の靴下（スキースノボ選択者）</label>
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
      <h5 class="card-title">期日及び宿泊先</h5>
      <p class="card-text">＊期日　令和7年2月5日(水)〜8(土)<br>＊集合　2月5日(水) 7：30<br>　JR 新山口駅 新幹線口(南口)　<br>　1F セブンイレブンの奥<br>＊解散　2月8日(土) 17：33 <br>　　　　JR 新山口駅到着予定<br>＊宿泊先　ヒルトン東京ベイ<br>　　　　　〒279-0031 千葉県浦安市舞浜 1-8<br>　 　　　　TEL：047-355-5000</p>
        
        <h5 class="card-title">1. はじめに</h5>
        <p class="card-text">修学旅行は通常の学校生活では得られない広い知識や体験を私たちに与えてくれる学校行事である。この機会を通して、自主性や責任感を養成すると同時に、集団行動のきまり・公衆道徳などを身に付けよう。そして、先生や親友と生活を共にすることで相互理解を深め、楽しい思い出をつくろう。修学旅行が意義のあるものに、そして、高校生活の思い出となるように、以下の点に留意しよう。
        <p>　＊修学旅行の目的を忘れず、常に誠英高校の生徒としての自覚をもって礼節ある行動をとること。
        <br>　＊団体・集団の中の一人としての役割と責任を忘れず、全体に迷惑をかけないように行動すること。
        <br>　＊修学旅行中は常に「安全」と「健康管理」に心掛けること。</p>

        <h5 class="card-title">2. 持ち物</h5>
        <p class="card-text">＊大きなバッグと新幹線に持ち込む小さなバッグ（貴重品および当日必需品）を準備。
          <br>＊大きなバッグは事前発送。（タグをつける）割れ物は入れないこと。
          <br>　　荷物の発送：2月3日(月)　7：30〜8：25　講堂前<br>　　帰りの際もホテルより大きなバッグを自宅に発送。<br>　　2月8日(土)　朝：ホテルより発送。

        <h5 class="card-title">3. 服装</h5>
          <p class="card-text">＊制服を正しく着用すること。
            <br>＊防寒のため、コート・手袋・マフラー・ネックウォーマーは自由。
            <br>＊靴は歩きやすいものがよい。
            <br>＊化粧品・装飾品（ピアス・ネックレス等）など不要なものを装着・持参しないこと。
            <br>１日目・４日目：制服＋華美でない防寒具
            <br>　　パーカーを制服の中に着るのは禁止　コートを着るのはＯＫ
            <br>２日目・３日目：私服も可（華美でないもの）
            <br>　　※４日目のニジゲンノモリはスカートでは体験ができないアトラクション有り。
            <br>　　そのため、<strong>４日目ホテルで体操服のジャージ上下を着用して、バスに乗り、ニジゲンノモリに向かう</strong>。ジゲンノモリの後、バスで制服に着替える。

          </p>
        <h5 class="card-title">4. 出発当日</h5>
        <p class="card-text">＊集合時間・場所　<br>　2月5日(水) 7：30 新山口駅新幹線口(南口)１F　〜セブンイレブンの奥〜<br>＊当日事故や病気等でやむを得ず不参加となる場合は、7：00までに引率教員、または担任に連絡すること。<br>＊新幹線の停車時間は1分しかないので速やかに乗降車すること。<br>＊他の車両に移動しないこと。</p>

        <h5 class="card-title">5. 注意事項</h5>
        <p class="card-text">＊団体行動をとり、自分勝手な行動をとらないこと。（単独行動は慎むこと。）
          <br>＊時間を厳守すること（10分前行動、5分前集合）。
          <br>＊危険な場所や立入り禁止区域には絶対に立ち寄らないこと。
          <br>＊貴重品の管理は各自で責任をもつこと。
          <br>＊睡眠を十分にとり、健康管理に気を配ること。
          <br>＊緊急事態が発生した時には、速やかに引率教員に連絡をとること。
          <br>＊「しおり」を常に携行し、速やかに行動すること。
          <br>＊旅行中に万引き・暴力行為・飲酒・喫煙など絶対にあってはならない。
        </p>

        <h5 class="card-title">６. バスの移動に関する注意</h5>
        <p class="card-text">＊クラスの代表は、出発前に必ず人員を確認して、引率教員に報告すること。
          <br>＊乗務員・添乗員の指示に従い、運転の妨げになるような言動・行動をしないこと。
          <br>＊乗降の際、事故にあわないように十分注意すること。
          <br>＊ゴミは袋に入れ、車内の美化に務めること。
          <br>＊車内ではシートベルトを着用すること。
          <br>＊下車の際には、忘れ物がないか確認すること。
        </p>

        <h5 class="card-title">７. 新幹線利用上の注意</h5>
        <p class="card-text">＊新幹線の乗車は、指示通りに整列し、速やかに乗車、自分の席につくこと（停車時間1分）。
          <br>＊基本的に他の乗客の迷惑になる行為は絶対にしないこと（大声を出す。歩き回る等）。
          <br>＊他の車両に移動しないこと。 
          <br>＊新幹線を降りる際に、忘れ物がないか確認すること。
        </p>

        <h5 class="card-title">８. ホテルでの心得</h5>
        <p class="card-text">＊非常口・避難場所を確認すること。
        <br>＊オートロックにつき、キー忘れに注意すること。
        <br>＊部屋の整理整頓を心がけ、忘れ物をしないこと（忘れ物があった場合は着払いで返却）。
        <br>＊部屋着・ジャージ・スリッパで宿泊階以外に出ないこと。
        <br>　　（朝食時やロビーで用事があるときは、着替えを済まし、靴を履いて降りてくること）
        <br>＊消灯・就寝時間を厳守し、就寝時間以降は部屋から出ないこと。
        <br>＊夜更かしなどで体調を崩さないように注意すること。
        <br>＊ホテル内の備品を破損しないように注意すること。もし破損した場合は各自で弁償する。
        <br>＊他の宿泊者の迷惑にならないように配慮すること。大声で騒がないこと。
        <br>＊無用の階に立ち入らないこと。他校の生徒や一般の人とみだりに親しくならないこと。
        <br>＊もし、トラブルが発生した時には、引率教員に知らせること。
        <br>＊<strong>ホテルに入った後は外出不可。</strong>
      </p>

      <h5 class="card-title">９. 点呼について</h5>
        <p class="card-text">＊整列の合図があれば速やかに各クラスごとに男女別・出席番号順に整列すること。
          <br>＊集合した際には、級長（それに代わる者）は速やかに点呼を行い、引率教員に報告すること。
        </p>

        <h5 class="card-title">10. 食事について</h5>
        <p class="card-text">＊＊暴飲暴食・偏食をしないこと。
          <br>＊バイキング方式の場合、自分の食べられる量を取り、食べ残しをしないこと。
        </p>

        <h5 class="card-title">11. その他</h5>
        <p class="card-text">＊スマホの電池残量を常時確認し、緊急時に備えること。
        <br>＊周囲に配慮し、トラブルは避けること。
        <br>＊カメラ・財布等の貴重品については、保管・管理に十分注意をすること。（持ち物には記名をしておくこと。）
        <br>＊化粧品・装飾品など不要なものを持参しないこと。
        <br>＊健康管理には十分注意するとともに、常備薬など必要なものは持参すること。
        <br>＊旅行日程・宿泊ホテル（住所・電話番号）は家族に知らせておくこと。
      </p>
      
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
          let elm = document.getElementById('id_' + event.detail.currentCource); 
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