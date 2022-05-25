<!-- start webpushr code --> <script>(function(w,d, s, id) {if(typeof(w.webpushr)!=='undefined') return;w.webpushr=w.webpushr||function(){(w.webpushr.q=w.webpushr.q||[]).push(arguments)};var js, fjs = d.getElementsByTagName(s)[0];js = d.createElement(s); js.id = id;js.async=1;js.src = "https://cdn.webpushr.com/app.min.js";fjs.parentNode.appendChild(js);}(window,document, 'script', 'webpushr-jssdk'));webpushr('setup',{'key':'BD1RV_xlcqWuYKMRT4ARVIej9HeK3oowqHEyylkX6RnK40hShMBQv-Wj_CMjpA_B_XuRsNBVixv2mi3bqeJ0ka8' ,'integration':'popup' });</script><!-- end webpushr code -->
<script>
    function _webpushrScriptReady(){
    webpushr('fetch_id',function (sid) { 
      console.log(sid)
      var _token=$("input[name*='_token']").val();

        $.ajax({
            url:'{{route('save_push_id')}}',
            method:"POST",
            data:{
                _token:_token,
                sid:sid
            },
            success:function(data)
            {
                console.log(data)
            }
             
        });
       
    });
}
</script>
