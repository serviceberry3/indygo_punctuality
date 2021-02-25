<!--get jQuery Google CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
	include 'templates/header.php';
	
	echo '<p class="text-6xl">Welcome to indygopunctual!</p>'; 
	//echo 'Number of buses currently serving 86 route: ' . $num_buses_on_rt . PHP_EOL;
	
	?>

	<p id="86_data">
		<?php include('php/get_route_data.php'); ?>
	</p>


	<script type="text/javascript">
		function update_86 (data) {
			document.getElementById('86_data').innerHTML = data;
		}

		setInterval(function () {
			
			$.ajax({
				url: 'php/get_route_data.php',
				success: update_86
			});

			//$.get('php/get_route_data.php');
		}, 10000);

		setInterval(function () {
			$.ajax({
				url: 'php/update_total_time.php',
				success:function (data) {
					console.log(data);
					//document.getElementById('86_data').innerHTML = data;
				}
        	});

			//$.get('php/get_route_data.php');
		}, 10000);


		
	</script>

	<?php
		include 'templates/footer.php'
	?>


