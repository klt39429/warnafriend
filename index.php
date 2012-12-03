<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/jquery.mobile-1.1.1.min.css" rel="stylesheet">
<link href="css/mobiscroll-2.0.1.custom.min.css" rel="stylesheet">

<script type="text/javascript" src="js/jquery1.8.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.1.1.min.js"></script>
<script type="text/javascript" src="js/apigee.js"></script>
<script type="text/javascript" src="js/mobiscroll-2.0.1.custom.min.js"></script>


<script type="text/javascript">

$(function() {
	Usergrid.ApiClient.init('klt39429','sandbox');

	$('#date').scroller({
		preset: 'date',
		theme: 'default',
		display: 'modal',
		mode: 'scroller',
		dateOrder: 'mmD ddyy'
	});   

	$('#submit').click(function() {
		var warning = new Usergrid.Entity("warnings");
		warning.set("name", $('#name').val());
		warning.set("phone", $('#phone').val());
		warning.set("message", $('#message').val());
		warning.set("date", $('#date').val());
		warning.set("feedback", "NOTSENT");
		warning.save();

		// feedback code:
		// 		NOTSENT
		// 		SENT
		// 		NO
		// 		YES

		// Twilio number: (818) 746-2076

		alert("Thanks for warning your friend about his driving. It's still best to take action now. Speak up!");
	});
});
</script>


<body>
	<div data-role="page" id="index_page">
		<div data-role="header">
			<h1>Inform-A-Friend</h1>
		</div><!-- /header -->

		<div data-role="content">
			<input type="text" placeholder="Driver's name" id="name" name="name"/>
			<input type="text" placeholder="Driver's phone number" id="phone" name="phone"/>
			<input type="text" name="date" id="date" placeholder="Date to send alert" />
			<textarea cols="40" rows="18" placeholder="Your message to the driver" name="message" id="message"></textarea>
			<button id="submit">
				Send A Notification!
			</button>
		</div><!-- /content -->
	</div><!-- /page -->

</body>
