		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			// var _gaq = _gaq || [];
			// 	_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
			// 	_gaq.push(['_trackPageview']);
			
			// (function() {
			// 	var ga = document.createElement('script');
			// 	ga.type = 'text/javascript';
			// 	ga.async = true;
			// 	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			// 	var s = document.getElementsByTagName('script')[0];
			// 	s.parentNode.insertBefore(ga, s);
			// })();
			

		</script>
		<?php 
		
		if(auth()->user()->rank == '1'){?>
			<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="4b1058f9-29fc-445f-bb36-6c7c4a88b164";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
		<?php } ?>
</body>

</html>