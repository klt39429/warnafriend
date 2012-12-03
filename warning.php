<?php
	
function get_person() {
	$uuid = $_GET['uuid'];
	$person = json_decode( file_get_contents("https://api.usergrid.com/klt39429/sandbox/warnings/{$uuid}"), 1 );
	return $person['entities'][0];
}

function get_fact() {
	$facts = json_decode( file_get_contents("https://api.usergrid.com/klt39429/sandbox/facts/"), 1 );
	$facts = $facts['entities'];

	return $facts[rand(0, count($facts)-1)];
}

$person = get_person();
$fact = get_fact();

?>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/jquery.mobile-1.1.1.min.css" rel="stylesheet">
<link href="css/mobiscroll-2.0.1.custom.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="js/jquery1.8.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.1.1.min.js"></script>
<script type="text/javascript" src="js/apigee.js"></script>
<script type="text/javascript" src="js/mobiscroll-2.0.1.custom.min.js"></script>

<script>

$(function() {
	Usergrid.ApiClient.init('klt39429','sandbox');

	function update_status(feedback) {
		var warning = new Usergrid.Entity("warnings");
		warning.set("uuid", $('#uuid').attr('uuid'));
		warning.set("feedback", feedback);
		warning.save(function() {
			if ( 'YES' == feedback ) {
				alert("Thanks for protecting yourself and other drivers!");
			} else {
				alert("Well, there is only so much we can do");
			}
			window.location = "stats.php";
		});
	}

	$('#yes').click(function() {
		update_status("YES");
		//window.location = "stats.php";
	});
	$('#no').click(function() {
		update_status("NO");
	});

});

</script>

<body>
	<div data-role="page" id="index_page">
		<div data-role="header">
			<h1>Inform-A-Friend</h1>
		</div><!-- /header -->

		<div data-role="content">
			<div>
				<span class="label label-important"><?php echo $person['name']; ?>,</span> you received this message because someone cares enough about you that they want you to stop texting while driving
			</div>
			<br />
			<div>
				<span class="label label-info">Personal message:</span>
				<?php echo $person['message']; ?>
			</div>
			<br />
			<div>
				<span class="label label-warning">Not so fun fact:</span>
				<?php echo $fact['fact']; ?>
			</div>
			<br />
			<div>
				What do you plan to do about this?	
			</div>
			<div>
				<div style="text-align:center;">
					<button data-inline="true" id="yes">I will stop!</button>
					<button data-inline="true" id="no">I could care less!</button>
					<input type="hidden" id="uuid" uuid="<?php echo $_GET['uuid']; ?>" />
				</div>
			</div>
		</div><!-- /content -->
	</div><!-- /page -->

</body>
