<?php
	
function get_count() {
	$people = json_decode( file_get_contents("https://api.usergrid.com/klt39429/sandbox/warnings/"), 1);
	$counts = array(
		'ALL' => count($people['entities']),
		'YES' => 0
	);
	foreach ($people['entities'] as $person) {
		if ($person['feedback'] == 'YES') {
			$counts['YES']++;
		}
	}
	return $counts;
}

$counts = get_count();

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

	$('#home').click(function() {
		window.location = "index.php";
	});

});

</script>

<body>
	<div data-role="page" id="index_page">
		<div data-role="header">
			<h1>Inform-A-Friend</h1>
		</div><!-- /header -->

		<div data-role="content">
			<h4>
				Out of <span class="label label-info"><?php echo $counts['ALL']; ?></span> messages were sent, <span class="label label-important"><?php echo $counts['YES']; ?></span> drivers responsed positively about it
			</h4>
			<br />
				<button id="home">Inform another driver!</button>
		</div><!-- /content -->
	</div><!-- /page -->

</body>
