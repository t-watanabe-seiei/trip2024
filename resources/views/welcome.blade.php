<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="https://glitch.com/favicon.ico" />
    <title>たびのしおり</title>


    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <style type="text/css">
      /* bootstrap modal 用 */
      .modal-lightbox {background-color:unset!important;}
    </style>

    <!-- bootstrap CDN -->
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet" 
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <!--  Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="{{ asset('/js/app.js') }}" defer></script>
    @livewireStyles
  </head>
  <body>
<livewire:timetable></livewire:timetable>
@livewireScripts



<!-- lighbox 用 modal  -->    
<div class="modal fade" id="lightboxModalFullscreen" tabindex="-1" aria-labelledby="lightboxModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" data-bs-dismiss="modal" aria-label="Close">
      <div class="modal-content modal-lightbox">
        <div class="modal-body d-flex align-items-center justify-content-center">
          <img src="" class="img-fluid" id="LightboxImage" data-bs-dismiss="modal" aria-label="Close" />
        </div>
      </div>
    </div>
</div>







    <!-- bootstrap CDN -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
      crossorigin="anonymous"
    ></script>


  <script>
     // Bootstrap 5 モーダル lightbox
 var jsCardModal = document.getElementById('lightboxModalFullscreen');
 jsCardModal.addEventListener('show.bs.modal', function (event) {
     var button = event.relatedTarget
     var lightboximage = button.getAttribute('data-bs-lightbox')
     document.getElementById('LightboxImage').src = lightboximage;
 })
 </script>



  </body>
</html>
