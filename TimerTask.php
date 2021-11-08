 <?php

$Html = <<<HTML
<script type='text/javascript' src='jquery.2.2.4.min.js'></script>
<script type='text/javascript' src='jscapture.js'></script>

<script type="text/javascript">

	function TimeTracking_Start()
	{
	var Timer;
	var TimerTime = $("#TimeSlot").val();
	var ScreenshotNo = $("#ScreenshotNo").val();
	var TimeOut =  TimerTime * 60000;
	var date = new Date();
    var StartTime = date.getTime();
var config = {};
// 	x : 0, 
// y: 0,
// config.height - (Number) default value the screen height. Specifies the height of the screenshot.
// config.process - (Function|Array) default value an empty array. A list of filters, which are going to process the image.
// config.done - (Function) default value is undefined. Callback, which is being called with the captured image.
// config.fail - (Function) default value is undefined. A callback, which is being executed on unsuccessful screen capturing (for example if the user does not allow screen capturing).
// config.delay - (Number) default value 0. Specifies the delay after each the screenshot will be captured.
	 $("#Timer").text('00:00');
        Timer = setInterval(function() {
            TotalSeconds = Math.floor((new Date().valueOf() - StartTime) / 1000);
            let Minutes = Math.floor(TotalSeconds / 60);
            let Seconds = TotalSeconds - Minutes * 60;
            Minutes = (Minutes < 10 ) ? '0'+ Minutes : Minutes;
            Seconds = (Seconds < 10 ) ? '0'+ Seconds : Seconds;
            $("#Timer").text( Minutes + ':' + Seconds);
            $("#Timer").attr('startedTime', TotalSeconds);      
            if(ScreenshotNo > 0)
            {
            var Frame = JSCapture.capture(ScreenshotNo);
            
            ScreenshotNo--;
        	}

        },1000);
		StopTimer =  setTimeout(function() {
                clearInterval(Timer);
           },TimeOut);
	}
</script>
<div id= "container">
<input id="TimeSlot" name="Timer" type="text">
    <input id="ScreenshotNo" name="NoOfScreenshots" type="text">
    <button  id="TimeTrackerBtn"  onclick="TimeTracking_Start()">Start Timer</button> 

<canvas id = "screenshot"></canvas>
    <div style="padding: 10px; text-align:center" id="Timer"></div>
</div>



HTML;

echo $Html;

 ?>
