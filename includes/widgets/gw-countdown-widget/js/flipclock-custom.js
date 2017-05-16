var clock;

$(document).ready(function() {
	var clock;

	var currentDate = new Date();

	var dateAttr = $('.gw-countdown-clock').attr('data-countdown');
	var cstdateTiming = dateAttr.split(" ");
	
	var mDate = cstdateTiming[0].split("/");
	var mTime = cstdateTiming[1].split(":");

	// Set some date in the future. In this case, it's always Jan 1
	var countdownDate = new Date(mDate[2], mDate[0] - 1, mDate[1], mTime[0], mTime[1], mTime[2]);

	// Calculate the difference in seconds between the future and current date
	var diff = countdownDate.getTime() / 1000 - currentDate.getTime() / 1000;

	clock = $('.gw-countdown-clock').FlipClock(diff, {
		clockFace: 'DailyCounter',
		countdown: true,
		showSeconds: true,
		language: 'de'
	});
		    
});