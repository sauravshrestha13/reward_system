      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    
    <script src="{{asset('admin-assets/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('admin-assets/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('admin-assets/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{asset('admin-assets/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/app-assets/js/core/app.js')}}" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('admin-assets/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('admin-assets/app-assets/js/scripts/pages/dashboard-lite.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="{{asset('sweetprompt/lib/sweetalert2.min.js')}}" type="text/javascript"></script>
    <script>
      // $("[id*='delete']").click(function(e){
      //   var ele = this;
      //   e.preventDefault();
        
      //   swal({
      //     title: "Are you sure?",
      //     text: "You will not be able to recover this record!",
      //     type: "warning",

      //     showCancelButton: true,

      //   }).then(function(){
      //     ele.form.submit();
      //   }).catch(swal.noop);

      // });
    </script>
    @yield('js')
    @include('admin.partials.messages');

    <script type="text/javascript">
    	$(document).ready(function(){
        var url = window.location.href.split('?')[0];
        var url = url.split("/").splice(0, 6);
        
        var action=url[4];
        if(!action || action == '')
          action = 'dashboard';
        
        if($('#'+action).attr('class')!='nav-item hidden')
        {
          $('#'+action).attr('class','nav-item active');
        }
        
    	});
	  </script>

    <script>
      
      
    </script>

  </body>
</html>
