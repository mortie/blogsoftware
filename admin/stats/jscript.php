<?php
	$secondsInDay = 86400;
	$daysToShow = 10;
	$highestValue = 0;
	
	function echoFiles($dirName) {
		global $daysToShow;
		global $secondsInDay;
		global $highestValue;
		
		$iTime = time()-$secondsInDay*$daysToShow;
		for ($i=0; $i<=$daysToShow; ++$i) {
			$entryFile = date($GLOBALS['settings']['log_file_structure'], $iTime);
			$entryPath = $GLOBALS['settings']['content_dir']."stats/$dirName/$entryFile";

			if (file_exists($entryPath)) {
				$entry = file_get_contents($entryPath);
			} else {
				$entry = 0;
			}
		
			echo "'$entry', ";
			if ($entry > $highestValue) {
				$highestValue = $entry;
			}
			$iTime += $secondsInDay;
		}
	}
	
	$stepCount = 10;
	function stepWidth() {
		global $highestValue;
		global $stepCount;
		
		return round($highestValue/$stepCount);
	}
?>

var data = {
	labels: [<?php
		$iTime = time()-$secondsInDay*$daysToShow;
		for ($i=0; $i<=$daysToShow; ++$i) {
			if ($i == $daysToShow) {
				echo "'Today', ";
			} else if ($i == $daysToShow-1) {
				echo "'Yesterday', ";
			} else {
				echo "'".date("M jS", $iTime)."', ";
			}
			$iTime += $secondsInDay;
		}
	?>],
	
	datasets : [{
		fillColor : "rgba(10, 10, 220, 0.5)",
		strokeColor : "rgba(151,187,205,1)",
		pointColor : "rgba(151,187,205,1)",
		pointStrokeColor : "#fff",
		data : [<?php
			echoFiles("visits");
		?>]
	},
	{
		fillColor : "rgba(220,100,100,0.5)",
		strokeColor : "rgba(50, 0, 0, 1)",
		pointColor : "rgba(220,220,220,1)",
		pointStrokeColor : "#fff",
		data : [<?php
			echoFiles("visitors");
		?>]
	}]
}

var options = {
	scaleFontSize: 16,
	
	scaleOverride: true,
	scaleSteps: <?=$stepCount ?>,
	scaleStepWidth: <?=stepWidth() ?>,
	scaleStartValue: 0,
	
	scaleGridLineColor : "rgba(0, 0, 0, .7)",
}

var ctx = document.getElementById("visitDataChart").getContext("2d");
var visitorsChart = new Chart(ctx).Line(data, options);