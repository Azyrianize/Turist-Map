<?php
	session_start();
	include('php/database_connection.php');
	
	if(isset($_SESSION["logged"]))
	{	
		if($_SESSION['logged']==true)
		{
			echo "<script>var logged_in = true;</script>";
		}	
		else
		{
			echo "<script>var logged_in = false;</script>";
		}
	}
	else
	{
		echo "<script>var logged_in = false;</script>";
	}
?>
					
					
<!DOCTYPE html>
    <head>
        
		<meta charset="utf-8">		
		<link rel="stylesheet" href="libs/v6.9.0/css/ol.css" type="text/css">
        <link rel="stylesheet" href="libs/v6.9.0/examples/resources/layout.css" type="text/css">
		<link rel="stylesheet" href="libs/ol-layerswitcher-master/dist/ol-layerswitcher.css" type="text/css">
        <link rel="stylesheet" href="styles.css" type="text/css" />
			
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
		<script src="libs/v6.9.0/build/ol.js"></script>
		<script src="libs/ol-layerswitcher-master/dist/ol-layerswitcher.js"></script>
		
		
		
		<title>OpenLayers Map</title>
		
    </head>
	
	<body>
		<div id="content">
			
			<div id="sidebar">
				<div id="mainMenu">
					<div id="coords">
						<h2>Koordynaty danego miejsca:</h2>
						<p id="pcoords1">Szerokość geograficzna [X]: </br> 0 </br>Długość geograficzna [Y]: </br> 0</p>
					</div>
					
					<div id="addMarker_div" style="display: none;">
						<h2>Ustaw własny marker:</h2>
						<p>Wybierz odpowiednią lokalizację i dodaj własny punkt turystyczny.</p>
						<button type="button" id="addMarker_button">Dodaj własny punkt</button>
					</div>
					
					<div id="centerDiv">
						<div id="loginDiv">
							<p>Zaloguj się aby mieć opcję dodawania punktów</p>
							<button type="button" id="Login_button">Zaloguj</button>
							<button type="button" id="Register_button">Rejestracja</button>
						</div>
						
						<button type="button" id="Logout_button" style="display: none;">Wyloguj</button>
						
					</div>	
				</div>
				
				<div id="addMarkerForm" style="display: none;">
				
					<div id="coords">
						<h2>Koordynaty danego miejsca:</h2>
						<p id="pcoords2">Szerokość geograficzna [X]: 0 </br>Długość geograficzna [Y]: 0</p>
					</div>
						
					<button type="button" class="back">Cofnij</button>

					<br><br><p>Uzupełnij formularz aby dodać punkt</p>	
						
					<form action="php/addMarker.php" id="addMarker_form" method="post">			
						<input type="text" name="name" placeholder="Nazwa" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwa'" /><br/>
						<input type="text" name="type" placeholder="Typ" onfocus="this.placeholder=''" onblur="this.placeholder='Typ'" /><br/>
						<input type="text" id="coord_x" name="coord_x" placeholder="Coord_x" onfocus="this.placeholder=''" onblur="this.placeholder='Coord_x'" /><br/>
						<input type="text" id="coord_y" name="coord_y" placeholder="Coord_y" onfocus="this.placeholder=''" onblur="this.placeholder='Coord_y'" /><br/>
						<input type="submit" class="button_submit" value="Dodaj" />
					</form>
					
					<?php				
						if(isset($_SESSION["error_message_marker"]))
						{
							echo $_SESSION["error_message_marker"];
							unset($_SESSION['error_message_marker']);
							echo "<script>var error_marker = true;</script>";
						}
						else
						{
							echo "<script>var error_marker = false;</script>";
						}
					?>
					
					<input type="hidden" id="user_id_hidden" value="'<?=$_SESSION["user_id"]?>'">
					<input type="hidden" id="user_type_hidden" value="'<?=$_SESSION["type"]?>'">
					
				</div>
				
				<div id="LoginForm" style="display: none;">
					<button type="button" class="back">Cofnij</button>
					
					<br><br><p>Uzupełnij formularz aby się zalogować</p>	
						
					<form action="php/Login.php"  id="login_form" method="post">			
						<input type="text" name="username" placeholder="Nazwa" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwa'" /><br/>
						<input type="password" name="password" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'" /><br/>
						<input type="submit" class="button_submit" value="Zaloguj" />
					</form>
					
					<?php				
						if(isset($_SESSION["error_message_login"]))
						{
							echo $_SESSION["error_message_login"];
							unset($_SESSION['error_message_login']);
							echo "<script>var error_login = true;</script>";
						}
						else
						{
							echo "<script>var error_login = false;</script>";
						}
					?>
					
				</div>
				
				<div id="RegisterForm" style="display: none;">
					<button type="button" class="back">Cofnij</button>
					
					<br><br><p>Uzupełnij formularz aby się zarejestrować</p>	
						
					<form action="php/Register.php" id="register_form" method="post">			
						<input type="text" name="username" placeholder="Nazwa" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwa'" /><br/>
						<input type="password" name="password" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'" /><br/>
						<input type="password" name="repeatpassword" placeholder="Powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Powtórz hasło'" /><br/>
						<input type="submit" class="button_submit" value="Stwórz konto" />
					</form>
				
					<?php
						if(isset($_SESSION["error_message_register"]))
						{
							echo $_SESSION["error_message_register"];
							unset($_SESSION['error_message_register']);
							echo "<script>var error_register = true;</script>";
						}
						else
						{
							echo "<script>var error_register = false;</script>";
						}
					?>
				</div>
				
				<div id="EditMarker" style="display: none;">
				
					<div id="coords">
						<h2>Koordynaty danego miejsca:</h2>
						<p id="pcoords2">Szerokość geograficzna [X]: 0 </br>Długość geograficzna [Y]: 0</p>
					</div>
						
					<button type="button" class="mainmenu">Menu główne</button>

					<br><br><p>Uzupełnij formularz aby edytować wybrany punkt</p>	
						
					<form action="php/editMarker.php" id="editMarker" method="post">			
						<input type="text" name="name" placeholder="Nazwa" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwa'" /><br/>
						<input type="text" name="type" placeholder="Typ" onfocus="this.placeholder=''" onblur="this.placeholder='Typ'" /><br/>
						<input type="text" id="coord_x_edit" name="coord_x" placeholder="Coord_x" onfocus="this.placeholder=''" onblur="this.placeholder='Coord_x'" /><br/>
						<input type="text" id="coord_y_edit" name="coord_y" placeholder="Coord_y" onfocus="this.placeholder=''" onblur="this.placeholder='Coord_y'" /><br/>
						<input type="submit" class="button_submit" value="Dodaj" />
						<input type="hidden" name="hidName" />
					</form>
										
				</div>
			</div>
			
			<div id="map"></div>
		
			<div id="popup" class="ol-popup">
				<a href="#" id="popup-closer" class="ol-popup-closer"></a>
				<div id="popup-content"></div>

			</div>
		</div>
        
		
		<script src="main.js"></script>	
		
		<script>
			var arrMarkers, marker;
			var markers_temp = [];
			var counter = 0;
			var user_id, name, type, coord_x, coord_y;
			var d_addMarker = document.getElementById("addMarker_div");
			var d_login = document.getElementById("loginDiv");
			var b_logout = document.getElementById("Logout_button");
					
			$(document).ready(function() {
				
				if(error_marker)
				{
					var mainMenu = document.getElementById("mainMenu");
					var addMarkerForm = document.getElementById("addMarkerForm");
					mainMenu.style["display"] = "none";
					addMarkerForm.style["display"] = "block";	
				}
				
				if(error_register)
				{
					var mainMenu = document.getElementById("mainMenu");
					var addMarkerForm = document.getElementById("RegisterForm");
					mainMenu.style["display"] = "none";
					RegisterForm.style["display"] = "block";
				}
				
				if(error_login)
				{
					var mainMenu = document.getElementById("mainMenu");
					var addMarkerForm = document.getElementById("LoginForm");
					mainMenu.style["display"] = "none";
					LoginForm.style["display"] = "block";
				}
				
				if(logged_in)
				{
					
					d_addMarker.style["display"] = "block";
					d_login.style["display"] = "none";
					b_logout.style["display"] = "block";
				}
				else
				{
					d_addMarker.style["display"] = "none";
					d_login.style["display"] = "block";
					b_logout.style["display"] = "none";
				}
				
				
				
				$.get("php/getMarker.php", 
				{},
				function(data)
				{	
					arrMarkers = $.parseJSON(data);
						
					for (let x in arrMarkers) 
					{
						counter++;	
			
						if(counter == 1)
						{
							user_id = arrMarkers[x];
						}
						else if(counter == 2)
						{
							name = arrMarkers[x];
						}
						else if(counter == 3)
						{
							type = arrMarkers[x];
						}
						else if(counter == 4)
						{
							coord_y = arrMarkers[x];
						}
						else if(counter == 5)
						{
							coord_x = arrMarkers[x];
						}
						else if(counter == 6)
						{
							let marker_temp = {
								"type": type,
								"name": name,
								"coord_x": coord_x,
								"coord_y": coord_y,
								"user_id": user_id									
							}
	
							markers_temp.push(marker_temp);					
							counter = 0;	
						}
					}
					
					for (let x in markers_temp) 
					{						
						marker = new ol.Feature({
							geometry: new ol.geom.Point([markers_temp[x].coord_x, markers_temp[x].coord_y]),
							type: markers_temp[x].type,
							name: markers_temp[x].name,
							user_id: markers_temp[x].user_id
						});
						markers.push(marker);
						
					}			

					createVectorLayer();
					
				});		
			});
			
			$('#addMarker_button').click(function(){			
				var mainMenu = document.getElementById("mainMenu");
				var addMarkerForm = document.getElementById("addMarkerForm");
				mainMenu.style["display"] = "none";
				addMarkerForm.style["display"] = "block";	
				
			});
		
			$('#Login_button').click(function(){			
				var mainMenu = document.getElementById("mainMenu");
				var addMarkerForm = document.getElementById("LoginForm");
				mainMenu.style["display"] = "none";
				LoginForm.style["display"] = "block";	
				
			});
			
			$('#Logout_button').click(function(){			
				window.location.href = "php/logout.php";
				
			});
			
			$('#Register_button').click(function(){			
				var mainMenu = document.getElementById("mainMenu");
				var addMarkerForm = document.getElementById("RegisterForm");
				mainMenu.style["display"] = "none";
				RegisterForm.style["display"] = "block";	
				
			});
			
			
			
			$('.back').click(function(){			
				var mainMenu = document.getElementById("mainMenu");
				var addMarkerForm = document.getElementById("addMarkerForm");
				mainMenu.style["display"] = "block";
				addMarkerForm.style["display"] = "none";
				LoginForm.style["display"] = "none";
				RegisterForm.style["display"] = "none";
				
				$(".error").remove();
				error_marker = false;
				error_login = false;
				error_register = false;
			});
			
			$('.mainmenu').click(function(){			
				var mainMenu = document.getElementById("mainMenu");
				var EditMarker = document.getElementById("EditMarker");
				mainMenu.style["display"] = "block";
				EditMarker.style["display"] = "none";

				
				$(".error").remove();
				error_marker = false;
				error_login = false;
				error_register = false;
			});
			
		</script>	
		
		
		
    </body>


	
	
</html>
