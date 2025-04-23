<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://hernaniv3-production.up.railway.app/css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
        <div class="container">
          <header class="header">
            <div class="logo-info">
                <img class="logo" src="{{ asset('images/logo.jfif') }}" alt="Logo">
                <div class="user-info">
                    <div class="name">Hi Ruel Baldo</div>
                    <div class="brgy">Brgy .04 Hernani, Eastern Samar.</div>
                </div>
            </div>
            <div class="menu-icon">
                <span class="material-icons">menu</span>
            </div>
           </header>

           <div class="hazard-prep">
                 <div class="title">
                      Hazard preparedness
                 </div>
                 <div class="hazard-content">
                     <div class="hazard-step">
                          <div class="title-step">
                              Stay Informed
                          </div>
                          <img src="{{ asset('images/slide1.png') }}" alt="" class="step-img">
                     </div>
                     <div class="hazard-step">
                          <div class="title-step">
                               Create an Emergency
                          </div>
                          <img src="{{ asset('images/slide2.png') }}" alt="" class="step-img">
                     </div>
                     <div class="hazard-step">
                          <div class="title-step">
                              Secure  Your Home
                          </div>
                          <img src="{{ asset('images/slide3.png') }}" alt="" class="step-img">
                     </div>
                 </div>
           </div>


           <div class="hazard-type">
                 <div class="title">
                       Select Hazard Area
                 </div>
                 <div class="hazard-content-type">
                     <div class="hazard-type">
                          <img src="{{ asset('images/type1.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type2.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type3.png') }}" alt="" class="type-img">
                     </div>
                     <div class="hazard-type">
                          <img src="{{ asset('images/type4.png') }}" alt="" class="type-img">
                     </div>
                 </div>
           </div>

           <div class="hazard-mapping">
              <div class="title">Mapping Hazard Prone Area</div>
           </div>
           <div id="map"></div>
        
        </div>
        

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNJpIkqXi8628smbwHFg_Oh2NCWjeO_Wo&callback=initMap" async defer></script>

<script>
    // Initialize the map
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 4
        });

        // Load the KML layer
        var kmlLayer = new google.maps.KmlLayer({
            url: 'https://raw.githubusercontent.com/baldo123-ruel/kml/5ef142d54aaf509d11b51b5311f9d1cbb639725b/eil_2010_082610000_01%20(2).kmz',
            map: map
        });

        var infoWindow = new google.maps.InfoWindow();

        // Handle KML feature clicks
        google.maps.event.addListener(kmlLayer, 'click', function(event) {
            var latLng = event.latLng;  // Get clicked location's latitude and longitude
            var hazardName = event.featureData.name; // Hazard name from KML
            
            console.log('Clicked location: ', latLng);  // Log the latLng object to ensure it's correct

            // Fetch the risk assessment based on the clicked coordinates
            fetchRiskAssessment(latLng, hazardName, map, infoWindow);
        });

        console.log('KML Layer added.');
    }

    // Fetch risk assessment from external APIs
    function fetchRiskAssessment(latLng, hazardName, map, infoWindow) {
        // Log the latLng again here to confirm it's being passed correctly
        console.log('Fetching risk assessment for:', latLng);

        // Get the coordinates of the clicked location
        var lat = latLng.lat();
        var lng = latLng.lng();

        // Use the lat and lng to fetch risk assessment from external APIs
        fetchEarthquakeRisk(lat, lng, hazardName, map, infoWindow, latLng);
    }

    // Function to fetch earthquake risk from USGS Earthquake Data API
    function fetchEarthquakeRisk(lat, lng, hazardName, map, infoWindow, latLng) {
        var url = `https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&latitude=${lat}&longitude=${lng}&maxradius=100`;

        console.log('Fetching earthquake risk for coordinates:', lat, lng); // Log coordinates for the API call

        fetch(url)
            .then(response => response.json())
            .then(data => {
                var riskAssessment = 'No recent seismic activity detected.';
                var eventDetails = '';

                if (data.features && data.features.length > 0) {
                    // Getting the first feature (latest earthquake in the region)
                    var earthquake = data.features[0];
                    var magnitude = earthquake.properties.mag;
                    var place = earthquake.properties.place;
                    var time = new Date(earthquake.properties.time);
                    var url = earthquake.properties.url;

                    // Format the risk assessment with more details
                    riskAssessment = `Earthquake Risk: A magnitude ${magnitude} earthquake occurred near ${place}.`;

                    // Display more details
                    eventDetails = `
                        <p><strong>Magnitude:</strong> ${magnitude}</p>
                        <p><strong>Location:</strong> ${place}</p>
                        <p><strong>Time:</strong> ${time.toUTCString()}</p>
                        <p><a href="${url}" target="_blank">More details on USGS website</a></p>
                    `;
                }

                // Display risk assessment with more details in the info window
                displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow);
            })
            .catch(error => {
                console.error('Error fetching earthquake risk:', error);
                var errorMessage = 'Error fetching earthquake risk.';
                displayRiskAssessment(hazardName, errorMessage, '', latLng, map, infoWindow);
            });
    }

    // Function to display risk assessment in an info window
    function displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow) {
        var content = `
            <div class="info-window-content">
                <h3>${hazardName}</h3>
                <p><strong>Risk Assessment Result:</strong></p>
                <p>${riskAssessment}</p>
                <div>${eventDetails}</div>
            </div>
        `;
        infoWindow.setContent(content);
        infoWindow.setPosition(latLng);
        infoWindow.open(map);
    }
</script>
</body>
</html>