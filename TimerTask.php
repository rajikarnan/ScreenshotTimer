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
    var ScreenshotsPending = ScreenshotNo;
    var Shot = 0;
    var Period = (TimeOut/ScreenshotNo)/1000;
    
	 $("#Timer").text('00:00');
        Timer = setInterval(function() {
            TotalSeconds = Math.floor((new Date().valueOf() - StartTime) / 1000);
            let Minutes = Math.floor(TotalSeconds / 60);
            let Seconds = TotalSeconds - Minutes * 60;
            Minutes = (Minutes < 10 ) ? '0'+ Minutes : Minutes;
            Seconds = (Seconds < 10 ) ? '0'+ Seconds : Seconds;
            $("#Timer").text( Minutes + ':' + Seconds);
            $("#Timer").attr('startedTime', TotalSeconds);      
            if(ScreenshotsPending == ScreenshotNo || ( ScreenshotsPending > 0 && TotalSeconds == (Shot + Period)))
            {
            	var Frame = JSCapture.capture(ScreenshotsPending);
            	Shot = TotalSeconds;
            	ScreenshotsPending--;
	            
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
    <button  id="TimeTrackerBtn"  onclick="TimeTracking_Start()">Start Time Tracking</button> 

<canvas id = "screenshot"></canvas>
    <div style="padding: 10px; text-align:center" id="Timer"></div>
</div>



HTML;

echo $Html;

 ?>
