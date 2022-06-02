var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');

var view = new ol.View({
	projection: 'EPSG:4326',
	center: [18.6531,54.3508],
	zoom: 0
});

var OSM = new ol.layer.Tile({
	title: 'OpenStreetMap',
	type: 'base',
	visible: true,
	source: new ol.source.OSM()
});

var satellite = new ol.layer.Tile({
	title: 'Satelita',
	type: 'base',
	visible: true,
	source: new ol.source.XYZ({
		attributions: ['Powered by ESRI', 
		'Source: Esri, DigitalGlove, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, Aerogrid, IGN, and the GIS User Community'],
		attributionCollapsible: false,
		url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_imagery/MapServer/tile/{z}/{y}/{x}',
		maxZoom: 23
	})
});

var base_maps = new ol.layer.Group({
	title: 'Mapy Bazowe',
	layers: [satellite, OSM]
})

var overlay = new ol.Overlay({
	element: container,
	autoPan: true,
	autoPanAnimation: {
		duration: 250
	}
});

var featureOverlay = new ol.layer.Vector({
	title: 'Highlight',
	source: new ol.source.Vector(),
	map: map
});

closer.onclick = function()
{
	overlay.setPosition(undefined);
	closer.blur();
	return false;
};

var map = new ol.Map({
	target: 'map',
	view: view,
	overlays: [overlay]
});

map.addLayer(base_maps);


var layerSwitcher = new ol.control.LayerSwitcher({
	activationMode: 'click',
	startActive: true,
	tipLbel: 'Layers',
	groupSelectstyle: 'children',
	collapseTipLabel: 'Collapse Layer'
});

map.addControl(layerSwitcher);
layerSwitcher.renderPanel();

/*
var Style = new ol.style.Style({
	image: new ol.style.Circle({
		radius: 10,
		fill: new ol.style.Fill({
			color: '#3399CC'
		})
	})
})
*/

var markers = [];

function createVectorLayer()
{
	var vectorLayer = new ol.layer.Vector({
		title: 'Pointers',
		source: new ol.source.Vector({
			features: markers
		}),
		style: function (feature, resolution) {
			return getStyle(feature, resolution);
		}
	});
	
	
	
	getStyle = function (feature, resolution) {

		if(feature.get('type') == "Building\n")
		{

			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/building.png'
				}),
			})
		}
		else if(feature.get('type') == 'River\n')
		{
			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/river.png'
				}),
			})
		}
		else if(feature.get('type') == 'Area\n')
		{
			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/area.png'
				}),
			})
		}
		else if(feature.get('type') == 'Statue\n')
		{
			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/statue.png'
				}),
			})
		}
		else if(feature.get('type') == 'Park\n')
		{
			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/park.png'
				}),
			})
		}
		else
		{
			return new ol.style.Style({
				image: new ol.style.Icon({
					anchor: [0.5, 1],
					size: [500, 500],
					scale: 0.05,
					src: 'img/place.png'
				}),
			})
		}
		
	}

	map.addLayer(vectorLayer);
	layerSwitcher.renderPanel();
}


map.on('click', highlight);
var counter=0;

function highlight(evt)
{	
	var user_id_value = document.getElementById("user_id_hidden").value;
	var user_type_value = document.getElementById("user_type_hidden").value;

	if(featureOverlay)
		{
			featureOverlay.getSource().clear();
			map.removeLayer(featureOverlay);
		}
		feature = map.forEachFeatureAtPixel(evt.pixel,
			function(feature, layer)
			{
					return feature;
			});
		
		if(feature)
		{
			var geometry = feature.getGeometry();
			var coordx = geometry.getCoordinates()[1];
			var coordy = geometry.getCoordinates()[0];
			var coordinate = evt.coordinate;

			featureOverlay.getSource().addFeature(feature);
			
			var content1 = '<h3>' + feature.get('name') + '</h3>';
			content1 += '<h4>' + feature.get('type') + '</h4>';
			content1 += '<p><b>Koordynaty: </b></br> Coord-X: ' + coordx + '</br>Coord-Y: ' + coordy + '</p>';
			
			let text = user_id_value;
			let result = text.substring(1, 2);
			let name = feature.get("name");
			let user_id = feature.get("user_id");
			let user_id2 = user_id.replace("\n", "");
			let name1, name2;
			name2 = name.replace("\n", "");
			
			if(name.includes(" "))
			{
				nameIndex = name.indexOf(" ");
				name = name.substr(0, nameIndex);
				name1 = name.replace("\n", "");
				
			}
			else
			{
				name1 = name.replace("\n", "");
			}


			if(user_type_value == "'admin'")
			{
				content1 += '<button type="button" class="button_edit" id="edit'+name1+'" data-markername="'+name2+'">Edytuj</button>';
				content1 += '<button type="button" class="button_remove" id="remove'+name1+'" data-markername="'+name2+'">Usuń</button>';
				content.innerHTML = content1;
				content1="";
				
				
				$('#edit'+name1+'').click(function(){			
						var markername = $(this).data('markername');
						
						var mainMenu = document.getElementById("mainMenu");
						var editMarker = document.getElementById("EditMarker");
						var RegisterForm = document.getElementById("RegisterForm");
						var LoginForm = document.getElementById("LoginForm");
						var addMarkerForm = document.getElementById("addMarkerForm");
						
						var hidName = document.getElementById("hidName");
						$('input[name="hidName"]').val(markername);
						editMarker.style["display"] = "block";	
						RegisterForm.style["display"] = "none";
						mainMenu.style["display"] = "none";
						LoginForm.style["display"] = "none";
						addMarkerForm.style["display"] = "none";
						
					});
				
				$('#remove'+name1+'').click(function(){			
				
					var markername = $(this).data('markername');
					
					$.get("php/removeMarker.php", 
					{
						markername: markername
					}, 
					function(data){
						//$("#content").html(data);	

						console.log(markername+'_remove');
					});
				});

			}
			else if(user_type_value == "'user'")
			{			
				content.innerHTML = content1;
				if(result == user_id2)
				{
					content1 += '<button type="button" class="button_edit" id="edit'+name1+'" data-markername="'+name2+'">Edytuj</button>';
					content1 += '<button type="button" class="button_remove" id="remove'+name1+'" data-markername="'+name2+'">Usuń</button>';
					content.innerHTML = content1;
					
					$('#edit'+name1+'').click(function(){			
						var markername = $(this).data('markername');
						
						var mainMenu = document.getElementById("mainMenu");
						var editMarker = document.getElementById("EditMarker");
						var RegisterForm = document.getElementById("RegisterForm");
						var LoginForm = document.getElementById("LoginForm");
						var addMarkerForm = document.getElementById("addMarkerForm");
						
						var hidName = document.getElementById("hidName");
						$('input[name="hidName"]').val(markername);
						editMarker.style["display"] = "block";	
						RegisterForm.style["display"] = "none";
						mainMenu.style["display"] = "none";
						LoginForm.style["display"] = "none";
						addMarkerForm.style["display"] = "none";
						
						
						
					});

					$('#remove'+name1+'').click(function(){			
					
						var markername = $(this).data('markername');
						
						$.get("php/removeMarker.php", 
						{
							markername: markername
						}, 
						function(data){
							//$("#content").html(data);	

							console.log(markername+'_remove2');
							window.location.reload(true);
						});
					});
				}
			}
			else
			{
				content.innerHTML = content1;
			}
			
			if(coordinate[1] > 75)
			{
				coordinate[1] -= 40;
			}

			overlay.setPosition(coordinate);
			
			layerSwitcher.renderPanel();
			map.updateSize();
		}	
	
	

}





map.on('click', function(evt){
    var coords = ol.proj.transform(evt.coordinate, 'EPSG:4326', 'EPSG:4326');
    var lat = coords[0];
    var lon = coords[1];
    var locTxt = "Długość geograficzna [X]: </br>" + lon + "</br> Szerokość geograficzna [Y]: </br>" + lat;
    document.getElementById('pcoords1').innerHTML = locTxt;
    document.getElementById('pcoords2').innerHTML = locTxt;
	document.getElementById("coord_x").value = lon;
	document.getElementById("coord_y").value = lat;
});


map.on('pointermove', function(evt) {
    var coords = ol.proj.transform(evt.coordinate, 'EPSG:4326', 'EPSG:4326');
    var lat = coords[0];
    var lon = coords[1];
    var locTxt = "Długość geograficzna [X]: </br>" + lon + "</br> Szerokość geograficzna [Y]: </br>" + lat;
    document.getElementById('pcoords1').innerHTML = locTxt;
    document.getElementById('pcoords2').innerHTML = locTxt;
});

$('.button_edit').click(function()
{	
				/*			
				var mainMenu = document.getElementById("mainMenu");
				var RegisterForm = document.getElementById("RegisterForm");
				var LoginForm = document.getElementById("LoginForm");
				var addMarkerForm = document.getElementById("addMarkerForm");
				var editMarker = document.getElementById("editMarker");
				mainMenu.style["display"] = "none";
				RegisterForm.style["display"] = "none";
				LoginForm.style["display"] = "none";
				addMarkerForm.style["display"] = "none";
				editMarker.style["display"] = "block";	
				*/
				
				
				
				
				
				var marker_id = $(this).data('markerid');
				
				console.log(marker_id);
});
			
