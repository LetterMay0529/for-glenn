
<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white">Real Estate Portal v1 © 2021-Present</span>
        </div>
    </div>
</div>
<!-- END PAGE FOOTER -->


<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ asset('admin_assets/js/plugin/pace/pace.min.js') }}"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{{ asset('admin_assets/js/libs/jquery-2.1.1.min.js') }}"><\/script>');
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{{ asset('admin_assets/js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="{{ asset('admin_assets/js/app.config.js') }}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{ asset('admin_assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script> 

<!-- BOOTSTRAP JS -->
<script src="{{ asset('admin_assets/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js') }}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{ asset('admin_assets/js/smartwidgets/jarvis.widget.min.js') }}"></script>
 
 

<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
 

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{ asset('admin_assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<!-- browser msie issue fix -->
<script src="{{ asset('admin_assets/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{ asset('admin_assets/js/plugin/fastclick/fastclick.min.js') }}"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<script src="{{ asset('admin_assets/js/demo.min.js') }}"></script>

<!-- MAIN APP JS FILE -->
<script src="{{ asset('admin_assets/js/app.min.js') }}"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="{{ asset('admin_assets/js/speech/voicecommand.min.js') }}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{ asset('admin_assets/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('admin_assets/js/plugin/jquery-form/jquery-form.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
                
            pageSetUp();
 
    });
</script>
<script>

$('#activity').on('click', function(){
    
    console.log('dsfsd');
    $('#notificationBody').html('<center><p>Loading...</p><center>');

    $.ajax({
        url: "{{ route('agent.agent_view_notification'); }}",
        method: "POST",
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data){

            $('#notificationBody').html(data);

        }
    });
});

</script>
 