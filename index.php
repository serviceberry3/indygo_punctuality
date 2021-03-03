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
		<p id="86_data">
			<?php print_num_buses_on_rt(); list_bus_data(); ?>
		</p>
		<p>
			After analysis of all routes has been run by the server for <?php include 'php/get_total_time.php'; echo $hrs ?>hrs <?php echo $min ?>min, IndyGo buses 
			arrived late to stops <?php include 'php/run_stats.php'; ?> of the time.
		</p>
	</div>

	<p>
	</p>


	<script type="text/javascript">
		function update_86 (data) {
			console.log("Refreshed content");
			//document.getElementById('86_data').innerHTML = data;
		}

		//run this file recursively every 10 sec, which will update the bus data
		setInterval(function () {
			
			$.ajax({
				url: 'index.php',
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


