<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- jQuery & SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container">

        <!-- Dashboard Main View -->
        <div class="dashboard-content-view">
            <!-- Header -->
            <header class="header">
                <div class="logo-info">
                    <img class="logo" src="{{ asset('images/logo.jfif') }}" alt="Logo">

                    @php use Illuminate\Support\Facades\Auth; @endphp
                    <div class="user-info">
                        <div class="name">Hi {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</div>
                        <div class="brgy">{{ Auth::user()->address }}</div>
                    </div>
                </div>
                <div class="menu-icon" onclick="toggleSidebar()">
                    <span class="material-icons">menu</span>
                </div>
            </header>

            <!-- Hazard Preparedness Section -->
            <div class="hazard-prep">
                <div class="title">Hazard preparedness</div>
                <div class="hazard-content">
                    <div class="hazard-step">
                        <div class="title-step">Stay Informed</div>
                        <img src="{{ asset('images/slide1.png') }}" alt="" class="step-img">
                    </div>
                    <div class="hazard-step">
                        <div class="title-step">Create an Emergency</div>
                        <img src="{{ asset('images/slide2.png') }}" alt="" class="step-img">
                    </div>
                    <div class="hazard-step">
                        <div class="title-step">Secure Your Home</div>
                        <img src="{{ asset('images/slide3.png') }}" alt="" class="step-img">
                    </div>
                </div>
            </div>

            <!-- Hazard Type Section -->
            <div class="hazard-type-wrapper">
                <div class="title">Select Hazard Area</div>
                <div class="hazard-content-type">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="hazard-type" onclick="selectHazard(this)">
                        <img src="{{ asset('images/type' . $i . '.png') }}" alt="" class="type-img">
                </div>
                @endfor
            </div>
        </div>


        <!-- Hazard Mapping -->
        <div class="hazard-mapping">
            <div class="title">Mapping Hazard Prone Area</div>
        </div>
        <div id="map"></div>
    </div>

    <!-- Emergency Contact View -->
    <div class="emergency-contact-view">
        <div class="emer-header">
            <button class="back-button">
                <span class="material-icons">arrow_back</span> Emergency Contact
            </button>
        </div>

        <div class="emergency-list">
            @foreach ([
            ['logo2.png', 'MUNICIPAL DISASTER RISK REDUCTION AND MANAGEMENT OFFICE'],
            ['logo1.png', 'MUNICIPAL OF HERNANI']
            ] as [$img, $title])
            <div class="emergency-box">
                <div class="emergency-info">
                    <img src="{{ asset('images/' . $img) }}" alt="" class="emerImg">
                    <h3 class="emerTitle">{{ $title }}</h3>
                </div>
                <div class="info-contact">
                    <span class="material-icons">call</span> 09369666509
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Evacuation Center View -->
    <div class="evacuation-center-view">
        <div class="evac-header">
            <button class="back-button">
                <span class="material-icons">arrow_back</span> Evacuation Centers
            </button>
        </div>

        <div class="evacuation-list">
            <div class="evacuation-box">
                <div class="evacuation-info">
                    <img src="{{ asset('images/logo1.png') }}" alt="" class="evacImg">
                    <h3 class="evacTitle">Padang Hernani, Eastern Samar</h3>
                </div>
                <div class="info-contact">
                    <span class="material-icons">call</span> 09369666509
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Report View -->
    <div class="submit-report-view">
        <div class="sub-header">
            <button class="back-button">
                <span class="material-icons">arrow_back</span> Submit Report
            </button>
        </div>

        <!-- Modal for Submitting Report -->
        

        <!-- Submitted Reports List -->
        <div class="report-list">
            <div class="report-title-wrapper">
                <div class="report-title">Incident Report</div>
                <button class="add-report-btn" onclick="openModal()">
    <span class="material-icons">note_add</span>
</button>

            </div>
            <div id="report-list"></div>
        </div>
    </div>
    <div id="reportModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Submit Report for Incident</h2>
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                </div>

                <!-- SweetAlert2 for Session Messages -->
                @if(session('success'))
                <script>
                    Swal.fire('Success', '{{ session('
                        success ') }}', 'success');
                </script>
                @endif

                @if(session('error'))
                <script>
                    Swal.fire('Error', '{{ session('
                        error ') }}', 'error');
                </script>
                @endif

                @if($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: `{!! implode('<br>', $errors->all()) !!}`,
                    });
                </script>
                @endif

                <!-- Incident Form -->
                <form id="incidentForm" method="POST" action="{{ route('incident.store') }}">
                    @csrf
                    <label for="hazardType">Hazard Type</label>
                    <select name="hazardType" required>
                        <option value="">Select Hazard</option>
                        @foreach (['Landslide', 'Typhoon', 'Flood', 'Earthquake'] as $hazard)
                        <option value="{{ $hazard }}">{{ $hazard }}</option>
                        @endforeach
                    </select>

                    <label for="description">Description</label>
                    <textarea name="description" rows="3" required placeholder="Describe the incident..."></textarea>

                    <label>Pinpoint Location</label>
                    <div id="map1"></div>
                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lng">

                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.jfif') }}" alt="Logo" class="logo">
            <div class="user-info">
                <div class="username">John Doe</div>
                <div class="role">Public Community</div>
            </div>
        </div>

        <ul class="nav-list">
            <li class="nav-item active" data-target="dashboard-content-view">Dashboard</li>
            <li class="nav-item" data-target="emergency-contact-view">Emergency Contact</li>
            <li class="nav-item" data-target="evacuation-center-view">Evacuation Centers</li>
            <li class="nav-item" data-target="submit-report-view">Submit Report</li>
        </ul>

        <div class="logout-container">
            <a href="{{ route('logout') }}" class="logout-button" style="text-decoration: none;">
                <span class="material-icons">logout</span> Logout
            </a>
        </div>
    </div>

    </div> <!-- End Container -->

    <!-- JavaScript Section -->
    <script>
        let viewHistory = [];

        function showView(targetClass) {
            const currentView = document.querySelector('.view-active');
            if (currentView) {
                viewHistory.push(currentView.classList[0]);
            }
            document.querySelectorAll('.dashboard-content-view, .emergency-contact-view, .evacuation-center-view, .submit-report-view')
                .forEach(view => view.classList.remove('view-active'));
            document.querySelector(`.${targetClass}`).classList.add('view-active');
        }

        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                const target = item.getAttribute('data-target');
                showView(target);
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                document.querySelector('.sidebar').classList.remove('active');
            });
        });

        document.querySelectorAll('.back-button').forEach(button => {
            button.addEventListener('click', () => {
                const lastView = viewHistory.pop() || 'dashboard-content-view';
                showView(lastView);
                document.querySelectorAll('.nav-item').forEach(i => {
                    i.classList.remove('active');
                    if (i.getAttribute('data-target') === lastView) {
                        i.classList.add('active');
                    }
                });
            });
        });

        window.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.dashboard-content-view').classList.add('view-active');
        });

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Google Maps Initialization
        window.initMap = function() {
            initReportMap();
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 11.313,
                    lng: 125.469
                },
                zoom: 15
            });
            const kmlLayer = new google.maps.KmlLayer({
                url: 'https://raw.githubusercontent.com/baldo123-ruel/kml/5ef142d54aaf509d11b51b5311f9d1cbb639725b/eil_2010_082610000_01%20(2).kmz',
                map: map
            });
            const infoWindow = new google.maps.InfoWindow();
            google.maps.event.addListener(kmlLayer, 'click', function(event) {
                fetchRiskAssessment(event.latLng, event.featureData.name, map, infoWindow);
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
                    if (data.features.length) {
                        const quake = data.features[0];
                        riskAssessment = `Earthquake Risk: A magnitude ${quake.properties.mag} earthquake occurred near ${quake.properties.place}.`;
                        eventDetails = `
                            <p><strong>Magnitude:</strong> ${quake.properties.mag}</p>
                            <p><strong>Location:</strong> ${quake.properties.place}</p>
                            <p><strong>Time:</strong> ${new Date(quake.properties.time).toUTCString()}</p>
                            <p><a href="${quake.properties.url}" target="_blank">More details</a></p>
                        `;
                    }
                    displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow);
                })
                .catch(() => {
                    displayRiskAssessment(hazardName, 'Error fetching data.', '', latLng, map, infoWindow);
                });
        }

        function displayRiskAssessment(hazardName, riskAssessment, eventDetails, latLng, map, infoWindow) {
            const content = `<div><h3>${hazardName}</h3><p><strong>Risk:</strong> ${riskAssessment}</p>${eventDetails}</div>`;
            infoWindow.setContent(content);
            infoWindow.setPosition(latLng);
            infoWindow.open(map);
        }

        function initReportMap() {
            const defaultLatLng = {
                lat: 11.3131,
                lng: 125.6072
            };
            const map = new google.maps.Map(document.getElementById("map1"), {
                center: defaultLatLng,
                zoom: 12,
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false,
                zoomControl: true
            });
            const marker = new google.maps.Marker({
                position: defaultLatLng,
                map: map,
                draggable: true
            });
            updateLatLng(defaultLatLng.lat, defaultLatLng.lng);
            map.addListener("click", (e) => {
                marker.setPosition(e.latLng);
                updateLatLng(e.latLng.lat(), e.latLng.lng());
            });
            marker.addListener("dragend", () => {
                updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
            });

            const locationButton = document.createElement("button");
            locationButton.innerHTML = '<span class="material-icons">my_location</span> My Location';
            locationButton.classList.add("custom-location-button");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

            locationButton.addEventListener("click", () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                        marker.setPosition(pos);
                        updateLatLng(pos.lat, pos.lng);
                    }, () => {
                        alert("Geolocation failed.");
                    });
                } else {
                    alert("No geolocation support.");
                }
            });
        }

        function updateLatLng(lat, lng) {
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        }

        // Incident Form Submit
        $('#incidentForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Success', response.message || 'Report submitted successfully!', 'success');
                    $('#reportModal').hide();
                    $('#incidentForm')[0].reset();
                },
                error: function(xhr) {
                    const errorHtml = xhr.status === 422 ?
                        Object.values(xhr.responseJSON.errors).flat().join('<br>') :
                        'An error occurred.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorHtml
                    });
                }
            });
        });

        // Load Reports
        function loadReports() {
            $.ajax({
                url: "{{ route('incident.myReports') }}",
                method: 'GET',
                success: function(reports) {
                    $('#report-list').empty();
                    reports.forEach(report => {
                        $('#report-list').append(`
                            <div class="report-items">
                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-status">${report.status}</div>
                                        <div class="report-date">${new Date(report.dateSubmitted).toLocaleDateString()}</div>
                                    </div>
                                    <div class="report-content">
                                        <div class="report-type">Type of Incident<div class="report-data-type">${report.hazardType}</div></div>
                                        <div class="report-view-assessment">View Risk Assessment</div>
                                    </div>
                                </div>
                            </div>`);
                    });
                },
                error: function() {
                    console.error('Failed to load reports.');
                }
            });
        }

        function selectHazard(element) {
            // Remove 'active' from all hazard-types
            document.querySelectorAll('.hazard-type').forEach(el => {
                el.classList.remove('active');
            });

            // Add 'active' to the clicked one
            element.classList.add('active');
        }

        loadReports();
        function openModal() {
  document.getElementById('reportModal').classList.add('active');
}

function closeModal() {
  document.getElementById('reportModal').classList.remove('active');
}
    </script>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNJpIkqXi8628smbwHFg_Oh2NCWjeO_Wo&callback=initMap" async defer></script>
</body>

</html>