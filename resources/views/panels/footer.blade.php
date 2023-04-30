<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy; 2023 <a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
          target="_blank">INFOCAL</a> All rights reserved.
      </span>
      <span class="right hide-on-small-only">
        Design and Developed by <a href="https://pixinvent.com/">INFOCAL</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->
