<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
            <div class="menu-icon" onclick="toggleSidebar()">
    <span class="material-icons">menu</span>
</div>
           </header>

           <div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo.jfif') }}" alt="Logo" class="logo">
        <div class="user-info">
            <div class="username">John Doe</div>
            <div class="role">Public Community</div>
        </div>
    </div>

    <ul class="nav-list">
        <li class="nav-item active">Profile</li>
        <li class="nav-item">Emergency Contact</li>
        <li class="nav-item">Evacuation Centers</li>
        <li class="nav-item">Submit Report</li>
    </ul>

    <!-- Logout Button -->
<div class="logout-container">
    <button class="logout-button">
        <span class="material-icons">logout</span>
        Logout
    </button>
</div>

</div>

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
        
<!-- Your map and logic JS FIRST -->
<script>

function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
    }

    // Optional: close sidebar on nav item click
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.remove('active');
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
    // Define globally before Google loads
    window.initMap = function () {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 11.313, lng: 125.469 },
            zoom: 15
        });

        const kmlLayer = new google.maps.KmlLayer({
            url: 'https://raw.githubusercontent.com/baldo123-ruel/kml/5ef142d54aaf509d11b51b5311f9d1cbb639725b/eil_2010_082610000_01%20(2).kmz',
            map: map
        });

        const infoWindow = new google.maps.InfoWindow();

        google.maps.event.addListener(kmlLayer, 'click', function(event) {
            const latLng = event.latLng;
            const hazardName = event.featureData.name;
            fetchRiskAssessment(latLng, hazardName, map, infoWindow);
        });
    }

    function fetchRiskAssessment(latLng, hazardName, map, infoWindow) {
        const lat = latLng.lat();
        const lng = latLng.lng();

        const url = `https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&latitude=${lat}&longitude=${lng}&maxradius=100`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let riskAssessment = 'No recent seismic activity detected.';
                let eventDetails = '';

                if (data.features && data.features.length > 0) {
                    const quake = data.features[0];
                    const mag = quake.properties.mag;
                    const place = quake.properties.place;
                    const time = new Date(quake.properties.time);
                    const quakeUrl = quake.properties.url;

                    riskAssessment = `Earthquake Risk: A magnitude ${mag} earthquake occurred near ${place}.`;
                    eventDetails = `
                        <p><strong>Magnitude:</strong> ${mag}</p>
                        <p><strong>Location:</strong> ${place}</p>
                        <p><strong>Time:</strong> ${time.toUTCString()}</p>
                        <p><a href="${quakeUrl}" target="_blank">More details on USGS website</a></p>
                    `;
                }

                displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow);
            })
            .catch(error => {
                console.error('Error fetching earthquake data:', error);
                displayRiskAssessment(hazardName, 'Error fetching data.', '', latLng, map, infoWindow);
            });
    }

    function displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow) {
        const content = `
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

<!-- Then load Google Maps API AFTER defining initMap -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNJpIkqXi8628smbwHFg_Oh2NCWjeO_Wo&callback=initMap" async defer></script>



</body>
</html>