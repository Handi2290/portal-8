<?php 
// API BEGIN HERE
if($_GET['action'] == 'pengumuman'){ 

echo '
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis magna sed odio pharetra, eu interdum metus semper. Suspendisse eu enim a urna hendrerit sagittis at faucibus ex. Aliquam erat volutpat. Integer a turpis id magna imperdiet gravida feugiat vitae nulla. Phasellus sem ligula, pellentesque et lacus sagittis, porta rhoncus lacus. Ut vulputate sit amet lorem vitae pharetra. Pellentesque tincidunt vulputate nibh.</p>

<p>Fusce sodales ultrices semper. Quisque libero orci, consectetur quis tempus at, congue lacinia ex. Ut id nisi sed tortor consequat ultrices vitae sed erat. Vestibulum feugiat justo mi, ac sodales sem dapibus sagittis. Pellentesque a erat ligula. Nunc et tellus et nulla placerat condimentum et ut ante. Nullam porta ipsum facilisis ex molestie euismod. Nullam lacinia augue purus, vitae varius ante aliquam in.</p>';

}

if(@$_GET['action'] == 'pipeline'){

	$data = array();

	$type = substr($_GET['user'], 0, 3);
	if($type == '194'){

		$data['login_type'] == "194";
		$data['id_user'] == "194";
		$data['username'] == "194";
		$data['email'] == "194";
		$data['login_type'] == "194";
		$data['nama'] == "194";
		

	}

}
