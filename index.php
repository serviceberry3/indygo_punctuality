<!--get jQuery Google CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
	include 'templates/header.php';
?>

	<div class="">
		<!--both div and img need to have display:inline property for it to work-->
		<div class="inline">
			<img class="inline pr-4" src="img/indygo_bus.png" style="width: 300px" alt="IndyGo Picture"> 
		</div>
		<?php echo '<h1 class="inline text-6xl">Welcome to indygopunctual!</h1>';  ?>
		<h1>

		</h1>
	</div>
	<br>

	<?php include 'php/get_route_data.php'; ?>


	<div class="pl-6">
		<h2 class="text-6xl">Route: <?php echo $route ?></h2>
		<br>
		<p id="86_data">
			<!--to be filled by update_86() js function-->
		</p>
		<br>
		<p>
			After analysis of all routes has been run by the server for <?php include 'php/get_total_time.php'; echo $hrs ?>hrs <?php echo $min ?>min, IndyGo buses 
			arrived late to stops <?php include 'php/run_stats.php'; ?> of the time.
		</p>
	</div>

	<p>
	</p>


	<script type="text/javascript">
		//show some text in the "86_data" <p> tag
		function update_86 (data) {
			document.getElementById('86_data').innerHTML = data;
		}

		//get 86 route data from IndyGo REST API, then feed the data into "86_data" <p> tag
		function get_rt_data() {
			$.ajax({
				url: 'php/get_route_data.php',
				data: 'rt_to_update=86',
				success: update_86
			});
		}

		//on loading the pg, need to run get_route_data once initially
		get_rt_data();

		//also set get_route_data to run every 10 seconds to constantly refresh the 86 route data
		setInterval(get_rt_data, 10000);

		//update total time served variable every 10 seconds
		setInterval(function () {
			$.ajax({
				url: 'php/update_total_time.php',
				success: function (data) {
					console.log(data);
				}
        	});
		}, 10000);		
	</script>

	<?php
		include 'templates/footer.php'
	?>


