<script src="{{url('/public/design/js/bootstrap-timepicker.min.js')}}"></script>
<script>
			// timepicker 1
			$('#timepicker1').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker1').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			// timepicker 2
			$('#timepicker2').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker2').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});	
			// timepicker 3
			$('#timepicker3').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker3').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			// timepicker 4
			$('#timepicker4').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker4').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			// timepicker 5
			$('#timepicker5').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker5').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			// timepicker 6
			$('#timepicker6').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false,
				disableFocus: true,
				icons: {
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down'
				}
			}).on('focus', function() {
				$('#timepicker6').timepicker('showWidget');
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});				
		</script>