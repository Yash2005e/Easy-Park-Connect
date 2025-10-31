<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Finder - Find Parking Spots Near You</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1000;
        }

        .app-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Header action buttons */
        .top-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .header-btn {
            background: white;
            color: #667eea;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .header-btn:hover {
            background: #f3f4ff;
        }
        .location-status {
            text-align: center;
            padding: 8px;
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .location-status.active {
            background: #4caf50;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        #search-input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            outline: none;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .main-container {
            display: flex;
            height: calc(100vh - 180px);
        }

        .sidebar {
            width: 380px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .filter-section {
            padding: 15px;
            background: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }

        .filter-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }

        .filter-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-align: center;
        }

        .filter-btn:hover {
            background: #f0f0f0;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .filter-btn.parking {
            grid-column: span 2;
            background: #4caf50;
            color: white;
            border-color: #4caf50;
            font-weight: bold;
        }

        .results-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .parking-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .parking-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .parking-card.selected {
            border-color: #667eea;
            background: #f0f0ff;
        }

        .parking-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .parking-type {
            display: inline-block;
            background: #4caf50;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .parking-address {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .parking-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .parking-distance {
            color: #667eea;
            font-weight: bold;
        }

        .parking-status {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-open {
            background: #c8e6c9;
            color: #2e7d32;
        }

        .status-closed {
            background: #ffcdd2;
            color: #c62828;
        }

        .rating {
            color: #ffa500;
        }

        #map {
            flex: 1;
            position: relative;
        }

        .map-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2000; /* ensure controls sit above the map canvas */
            display: flex;
            gap: 8px;
            align-items: center;
            pointer-events: auto; /* allow interaction */
        }

        .locate-btn {
            background: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            transition: all 0.3s;
            z-index: 2001;
            pointer-events: auto;
        }

        .locate-btn:hover {
            background: #667eea;
            color: white;
        }

        .refresh-btn {
            background: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 2001;
            pointer-events: auto;
        }

        .refresh-btn:hover {
            background: #45a049;
        }

        #clear-route-btn {
            background: #f44336;
            color: white;
        }

        #clear-route-btn:hover {
            background: #da190b;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .stats-bar {
            padding: 10px 15px;
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #666;
        }

        .stats-bar strong {
            color: #333;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: 40%;
            }
            
            .filter-buttons {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .filter-btn.parking {
                grid-column: span 3;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="app-title">🅿️ ParkSpot Pro</div>
            <div class="top-actions">
                <a href="<?php echo base_url('home/index'); ?>" class="header-btn">Go Back Home</a>
                <a href="<?php echo base_url('admin'); ?>" class="header-btn">Admin Dashboard</a>
                <?php if(
                    isset(
                        $this->session
                    ) && $this->session->userdata('user_logged_in')
                ): ?>
                    <a href="<?php echo base_url('user/logout'); ?>" class="header-btn">Logout</a>
                <?php else: ?>
                    <a href="<?php echo base_url('user/register'); ?>" class="header-btn">Register</a>
                <?php endif; ?>
            </div>
        </div>
        <div id="location-status" class="location-status">
            📍 Detecting your location...
        </div>
        <div class="search-container">
            <input 
                id="search-input" 
                type="text" 
                placeholder="Search for a specific location or parking..."
            >
            <span class="search-icon">🔍</span>
        </div>
    </div>

    <div class="main-container">
        <div class="sidebar">
            <div class="filter-section">
                <div class="filter-title">QUICK FILTERS</div>
                <div class="filter-buttons">
                    <button class="filter-btn parking active" onclick="showParking()">
                        🅿️ All Parking
                    </button>
                    <button class="filter-btn" data-type="restaurant">
                        🍽️ Restaurants
                    </button>
                    <button class="filter-btn" data-type="lodging">
                        🏨 Hotels
                    </button>
                    <button class="filter-btn" data-type="atm">
                        🏧 ATMs
                    </button>
                    <button class="filter-btn" data-type="gas_station">
                        ⛽ Gas Station
                    </button>
                </div>
            </div>
            <div class="stats-bar" id="stats-bar">
                Found <strong>0</strong> parking spots nearby
            </div>
            <div class="results-container" id="results-container">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    Finding parking spots near you...
                </div>
            </div>
        </div>
        
        <div id="map">
            <div class="map-controls">
                <button class="locate-btn" onclick="centerOnUserLocation()" title="Center on my location">
                    📍
                </button>
                <button class="refresh-btn" onclick="refreshParkingSearch()" title="Refresh parking search">
                    🔄
                </button>
                <button id="clear-route-btn" class="locate-btn" onclick="clearRoute()" title="Clear route" style="display: none;">
                    ❌
                </button>
            </div>
        </div>
    </div>

    <script>
        // ===============================================
        // GOOGLE MAPS CONFIGURATION
        // ===============================================
        const API_KEY = 'AIzaSyDVLfjbMcdJ9ozo7GhhAn6ezs0WVaMuOCc';
        
        let map;
        let service;
        let infoWindow;
        let markers = [];
        let userMarker;
        let userLocation = null;
        let currentPlaces = [];
        let selectedMarker = null;
        let currentFilter = 'parking';
        let directionsService;
        let directionsRenderer;
        let currentRoute = null;

        // Ensure location is a plain LatLngLiteral {lat:number,lng:number}
        function normalizeLocation(location) {
            if (!location) return null;
            // If location already has numeric lat/lng properties
            if (typeof location.lat === 'number' && typeof location.lng === 'number') return location;
            // If it's a LatLng object with toJSON
            if (typeof location.toJSON === 'function') return location.toJSON();
            // If it's LatLng with methods lat()/lng()
            if (typeof location.lat === 'function' && typeof location.lng === 'function') {
                return { lat: location.lat(), lng: location.lng() };
            }
            return null;
        }

        function initMap() {
            const defaultLocation = { lat: 40.7128, lng: -74.0060 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 15,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: true,
                styles: [
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{ visibility: "off" }]
                    }
                ]
            });

            service = new google.maps.places.PlacesService(map);
            infoWindow = new google.maps.InfoWindow();

            // Initialize directions service and renderer
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: false,
                polylineOptions: {
                    strokeColor: '#4285f4',
                    strokeWeight: 5,
                    strokeOpacity: 0.8
                },
                preserveViewport: false
            });

            // Move our custom controls into the Google Maps controls container so they sit above overlays and receive events
            try {
                const mc = document.querySelector('.map-controls');
                if (mc && map && map.controls && google && google.maps) {
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(mc);
                }
            } catch (err) {
                console.warn('Failed to move map-controls into map.controls:', err);
            }

            const input = document.getElementById('search-input');
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("Can't find that location!");
                    return;
                }

                map.setCenter(place.geometry.location);
                map.setZoom(15);
                
                searchNearbyPlaces(place.geometry.location, 'parking');
            });

            getUserLocation();
        }

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        document.getElementById('location-status').innerHTML = 
                            '📍 Location detected - Showing parking near you';
                        document.getElementById('location-status').classList.add('active');

                        if (userMarker) {
                            userMarker.setMap(null);
                        }

                        userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: 'Your Location',
                            animation: google.maps.Animation.DROP,
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                scale: 12,
                                fillColor: '#4285f4',
                                fillOpacity: 1,
                                strokeColor: 'white',
                                strokeWeight: 3
                            },
                            zIndex: 1000
                        });

                        map.setCenter(userLocation);
                        searchNearbyPlaces(userLocation, 'parking');
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        document.getElementById('location-status').innerHTML = 
                            '⚠️ Location access denied - Showing default area';
                        
                        searchNearbyPlaces(map.getCenter(), 'parking');
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else {
                document.getElementById('location-status').innerHTML = 
                    '⚠️ Location not supported - Showing default area';
                searchNearbyPlaces(map.getCenter(), 'parking');
            }
        }

        function searchNearbyPlaces(location, type) {
            clearMarkers();
            currentFilter = type;
            
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event?.target?.classList.add('active');

            document.getElementById('results-container').innerHTML = `
                <div class="loading">
                    <div class="loading-spinner"></div>
                    Searching for ${type === 'parking' ? 'parking spots' : type}...
                </div>
            `;

            // normalize location to LatLngLiteral
            const loc = normalizeLocation(location) || map.getCenter().toJSON();

            let request = {
                location: new google.maps.LatLng(loc.lat, loc.lng),
                radius: 5000 // broader radius
            };

            if (type === 'parking') {
                request.keyword = 'parking lot OR parking garage OR car park';
            } else {
                // NearbySearch 'type' expects a single string type
                request.type = type;
            }

            service.nearbySearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                    if (type === 'parking') {
                        results = results.filter(place => {
                            const name = place.name.toLowerCase();
                            const types = place.types || [];
                            return name.includes('parking') || 
                                   name.includes('garage') || 
                                   name.includes('car park') ||
                                   types.includes('parking');
                        });
                    }
                    
                    currentPlaces = results;
                    displayResults(results, location);
                    
                    results.forEach((place, index) => {
                        createMarker(place, index);
                    });

                    if (results.length > 0) {
                        const bounds = new google.maps.LatLngBounds();
                        if (userLocation) {
                            bounds.extend(userLocation);
                        }
                        results.slice(0, 10).forEach(place => {
                            bounds.extend(place.geometry.location);
                        });
                        map.fitBounds(bounds);
                    }
                } else {
                    document.getElementById('results-container').innerHTML = `
                        <div class="no-results">
                            <p>😔 No ${type === 'parking' ? 'parking spots' : type} found nearby</p>
                            <p style="margin-top: 10px; font-size: 14px;">Try searching in a different area</p>
                        </div>
                    `;
                    updateStats(0);
                }
            });
        }

        function createMarker(place, index) {
            let markerIcon;
            
            if (currentFilter === 'parking') {
                markerIcon = {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                            <circle cx="20" cy="20" r="18" fill="#4caf50" stroke="white" stroke-width="2"/>
                            <text x="20" y="26" font-family="Arial" font-size="16" font-weight="bold" fill="white" text-anchor="middle">P</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(40, 40),
                    anchor: new google.maps.Point(20, 20)
                };
            } else {
                markerIcon = {
                    path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                    scale: 6,
                    fillColor: '#667eea',
                    fillOpacity: 1,
                    strokeColor: 'white',
                    strokeWeight: 2
                };
            }

            const marker = new google.maps.Marker({
                position: place.geometry.location,
                map: map,
                title: place.name,
                icon: markerIcon,
                animation: google.maps.Animation.DROP
            });

            markers.push(marker);

            marker.addListener('click', () => {
                showPlaceDetails(place, marker, index);
                selectPlaceCard(index);
            });
        }

        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        function displayResults(places, searchLocation) {
            const container = document.getElementById('results-container');
            
            if (places.length === 0) {
                container.innerHTML = `
                    <div class="no-results">
                        <p>No results found</p>
                    </div>
                `;
                updateStats(0);
                return;
            }

            updateStats(places.length);

            if (searchLocation) {
                places.sort((a, b) => {
                    const distA = getDistance(searchLocation, a.geometry.location);
                    const distB = getDistance(searchLocation, b.geometry.location);
                    return distA - distB;
                });
            }

            container.innerHTML = places.map((place, index) => {
                const distance = searchLocation ? getDistance(searchLocation, place.geometry.location) : null;
                const isOpen = place.opening_hours ? place.opening_hours.open_now : null;
                
                return `
                    <div class="parking-card" data-index="${index}" onclick="selectPlace(${index})">
                        ${currentFilter === 'parking' ? '<span class="parking-type">PARKING</span>' : ''}
                        <div class="parking-name">${place.name}</div>
                        <div class="parking-address">${place.vicinity || 'Address not available'}</div>
                        <div class="parking-info">
                            <div>
                                ${place.rating ? `<span class="rating">⭐ ${place.rating}</span>` : ''}
                                ${distance ? `<span class="parking-distance">📍 ${distance}</span>` : ''}
                            </div>
                            ${isOpen !== null ? `
                                <span class="parking-status ${isOpen ? 'status-open' : 'status-closed'}">
                                    ${isOpen ? 'OPEN' : 'CLOSED'}
                                </span>
                            ` : ''}
                        </div>
                    </div>
                `;
            }).join('');
        }

        function getDistance(location1, location2) {
            const lat1 = location1.lat;
            const lon1 = location1.lng;
            const lat2 = location2.lat();
            const lon2 = location2.lng();
            
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon/2) * Math.sin(dLon/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            const distance = R * c;
            
            if (distance < 1) {
                return `${Math.round(distance * 1000)}m`;
            } else {
                return `${distance.toFixed(1)}km`;
            }
        }

        function selectPlace(index) {
            const place = currentPlaces[index];
            const marker = markers[index];
            
            selectPlaceCard(index);
            showPlaceDetails(place, marker, index);
            
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        function selectPlaceCard(index) {
            document.querySelectorAll('.parking-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.querySelector(`[data-index="${index}"]`)?.classList.add('selected');
        }

        function showPlaceDetails(place, marker, index) {
            const request = {
                placeId: place.place_id,
                fields: ['name', 'formatted_address', 'formatted_phone_number', 'website', 
                         'rating', 'opening_hours', 'user_ratings_total', 'price_level']
            };

            service.getDetails(request, (details, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    let content = `
                        <div style="max-width: 300px; padding: 10px;">
                            <h3 style="margin: 0 0 10px 0; color: #333;">${details.name}</h3>
                            ${currentFilter === 'parking' ? '<span style="background: #4caf50; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px;">PARKING FACILITY</span>' : ''}
                            <div style="margin-top: 10px;">
                                <p style="margin: 5px 0;">📍 ${details.formatted_address || place.vicinity}</p>
                                ${details.formatted_phone_number ? `<p style="margin: 5px 0;">📞 ${details.formatted_phone_number}</p>` : ''}
                                ${details.rating ? `<p style="margin: 5px 0;">⭐ ${details.rating} (${details.user_ratings_total || 0} reviews)</p>` : ''}
                                ${details.price_level ? `<p style="margin: 5px 0;">💰 ${'$'.repeat(details.price_level)}</p>` : ''}
                                ${details.website ? `<p style="margin: 5px 0;"><a href="${details.website}" target="_blank" style="color: #667eea;">Visit Website</a></p>` : ''}
                            </div>
                            ${details.opening_hours ? `
                                <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #eee;">
                                    <strong>Hours:</strong>
                                    <div style="font-size: 12px; margin-top: 5px;">
                                        ${details.opening_hours.weekday_text ? details.opening_hours.weekday_text[new Date().getDay()].split(': ')[1] : 'Not available'}
                                    </div>
                                </div>
                            ` : ''}
                            <div style="margin-top: 15px;">
                                <button onclick="getDirections('${place.geometry.location.lat()}', '${place.geometry.location.lng()}')" 
                                        style="background: #4285f4; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 5px;">
                                    📍 Show Route on Map
                                </button>
                                <button onclick="openInGoogleMaps('${place.geometry.location.lat()}', '${place.geometry.location.lng()}')" 
                                        style="background: #4caf50; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; width: 100%;">
                                    🗺️ Open in Google Maps
                                </button>
                            </div>
                        </div>
                    `;
                    
                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);
                }
            });
        }

        function getDirections(lat, lng) {
            if (!userLocation) {
                alert('Please enable location services to get directions');
                return;
            }

            // Close any existing info windows first
            if (infoWindow) {
                infoWindow.close();
            }

            // Show loading indicator
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'route-loading';
            loadingDiv.innerHTML = 'Calculating route...';
            loadingDiv.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); z-index: 1000;';
            document.getElementById('map').appendChild(loadingDiv);

            const request = {
                origin: new google.maps.LatLng(userLocation.lat, userLocation.lng),
                destination: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
                provideRouteAlternatives: false
            };

            console.log('Direction request:', request);

            directionsService.route(request, (result, status) => {
                // Remove loading indicator
                const loader = document.getElementById('route-loading');
                if (loader) {
                    loader.remove();
                }

                console.log('Direction status:', status);
                console.log('Direction result:', result);

                if (status === google.maps.DirectionsStatus.OK) {
                    // Clear any existing route
                    if (currentRoute) {
                        directionsRenderer.setDirections({ routes: [] });
                    }
                    
                    // Display the route on the map
                    directionsRenderer.setDirections(result);
                    currentRoute = result;

                    // Show clear route button
                    document.getElementById('clear-route-btn').style.display = 'block';

                    // Get route information
                    const route = result.routes[0];
                    const leg = route.legs[0];
                    
                    // Show route information in info window
                    const routeInfo = `
                        <div style="padding: 10px; max-width: 300px;">
                            <h4 style="margin: 0 0 10px 0; color: #4285f4;">📍 Route Information</h4>
                            <div style="background: #f5f5f5; padding: 10px; border-radius: 5px; margin: 10px 0;">
                                <p style="margin: 5px 0;"><strong>🚗 Distance:</strong> ${leg.distance.text}</p>
                                <p style="margin: 5px 0;"><strong>⏱️ Duration:</strong> ${leg.duration.text}</p>
                            </div>
                            <p style="margin: 5px 0; font-size: 12px;"><strong>From:</strong> Your location</p>
                            <p style="margin: 5px 0; font-size: 12px;"><strong>To:</strong> ${leg.end_address}</p>
                            <div style="margin-top: 15px; display: flex; gap: 10px;">
                                <button onclick="clearRoute()" 
                                        style="flex: 1; background: #f44336; color: white; border: none; padding: 8px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                                    ❌ Clear
                                </button>
                                <button onclick="openInGoogleMaps(${lat}, ${lng})" 
                                        style="flex: 1; background: #4caf50; color: white; border: none; padding: 8px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                                    🗺️ Navigate
                                </button>
                            </div>
                        </div>
                    `;

                    // Create a custom info window at the destination
                    if (infoWindow) {
                        infoWindow.close();
                    }
                    infoWindow = new google.maps.InfoWindow({
                        content: routeInfo
                    });
                    
                    // Open info window at destination
                    infoWindow.setPosition(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
                    infoWindow.open(map);

                    // Adjust map bounds to show entire route
                    const bounds = new google.maps.LatLngBounds();
                    result.routes[0].overview_path.forEach(path => {
                        bounds.extend(path);
                    });
                    
                    // Fit bounds with padding
                    map.fitBounds(bounds);
                    
                    // Add additional padding after a short delay
                    setTimeout(() => {
                        const currentZoom = map.getZoom();
                        if (currentZoom > 16) {
                            map.setZoom(16);
                        }
                    }, 300);

                } else {
                    // Handle errors with proper status checks
                    let errorMessage = 'Unable to calculate route. ';
                    
                    if (status === google.maps.DirectionsStatus.ZERO_RESULTS) {
                        errorMessage = 'No route found between these locations. The destination may not be accessible by road.';
                    } else if (status === google.maps.DirectionsStatus.NOT_FOUND) {
                        errorMessage = 'Could not locate one of the specified locations.';
                    } else if (status === google.maps.DirectionsStatus.REQUEST_DENIED) {
                        errorMessage = 'Directions request was denied. Please make sure Directions API is enabled in Google Cloud Console.';
                    } else if (status === google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
                        errorMessage = 'Too many requests. Please try again in a few seconds.';
                    } else if (status === google.maps.DirectionsStatus.INVALID_REQUEST) {
                        errorMessage = 'Invalid request. Please try selecting a different location.';
                    } else {
                        errorMessage = `Route calculation failed: ${status}. Please enable Directions API in Google Cloud Console.`;
                    }
                    
                    console.error('Directions error:', status, errorMessage);
                    alert(errorMessage);
                }
            });
        }

        function clearRoute() {
            if (directionsRenderer) {
                directionsRenderer.setDirections({ routes: [] });
                directionsRenderer.setMap(null);
                // Recreate the renderer
                directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: false,
                    polylineOptions: {
                        strokeColor: '#4285f4',
                        strokeWeight: 5,
                        strokeOpacity: 0.8
                    },
                    preserveViewport: false
                });
            }
            currentRoute = null;
            
            // Close any open info windows
            if (infoWindow) {
                infoWindow.close();
            }

            // Hide the clear route button
            const clearBtn = document.getElementById('clear-route-btn');
            if (clearBtn) {
                clearBtn.style.display = 'none';
            }
        }

        function openInGoogleMaps(lat, lng) {
            if (userLocation) {
                const url = `https://www.google.com/maps/dir/?api=1&origin=${userLocation.lat},${userLocation.lng}&destination=${lat},${lng}`;
                window.open(url, '_blank');
            } else {
                const url = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`;
                window.open(url, '_blank');
            }
        }

        function centerOnUserLocation() {
            if (userLocation) {
                map.setCenter(userLocation);
                map.setZoom(15);
                
                if (userMarker) {
                    userMarker.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(() => {
                        userMarker.setAnimation(null);
                    }, 2000);
                }
            } else {
                getUserLocation();
            }
        }

        function refreshParkingSearch() {
            const center = map.getCenter();
            searchNearbyPlaces(center, currentFilter);
        }

        function showParking() {
            // Clear all other place markers
            Object.keys(placeMarkers).forEach(type => {
                clearPlaceMarkers(type);
            });
            
            // Reset active filters
            Object.keys(activeFilters).forEach(type => {
                activeFilters[type] = false;
            });

            // Reset filter button styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector('.filter-btn.parking').classList.add('active');

            // Show parking spots
            searchNearbyPlaces(userLocation || map.getCenter(), 'parking');
        }

        let placeMarkers = {
            restaurant: [],
            lodging: [],
            atm: [],
            gas_station: []
        };

        let activeFilters = {
            restaurant: false,
            lodging: false,
            atm: false,
            gas_station: false
        };

        // store latest results per place type so list selection works
        let currentPlacesByType = {
            restaurant: [],
            lodging: [],
            atm: [],
            gas_station: []
        };

        function togglePlace(placeType) {
            console.log('togglePlace called for', placeType);
            const button = document.querySelector(`.filter-btn[data-type="${placeType}"]`);

            if (activeFilters[placeType]) {
                // turn off
                clearPlaceMarkers(placeType);
                activeFilters[placeType] = false;
                if (button) button.classList.remove('active');
                currentPlacesByType[placeType] = [];

                // if no other non-parking filters are active, clear results pane
                const anyActive = Object.keys(activeFilters).some(k => activeFilters[k]);
                if (!anyActive) {
                    document.getElementById('results-container').innerHTML = '';
                    updateStats(0);
                }
            } else {
                // enable and fetch nearby services for this type
                searchNearbyPlacesByType(placeType);
                activeFilters[placeType] = true;
                if (button) button.classList.add('active');
            }
        }

        function searchNearbyPlacesByType(type) {
            console.log('searchNearbyPlacesByType', type);
            const rawLoc = userLocation || map.getCenter();
            const loc = normalizeLocation(rawLoc) || map.getCenter().toJSON();

            const request = {
                location: new google.maps.LatLng(loc.lat, loc.lng),
                radius: 5000,
                type: type
            };

            service.nearbySearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results) {
                    // clear previous markers for this type
                    clearPlaceMarkers(type);

                    // store results
                    currentPlacesByType[type] = results;

                    // create markers
                    results.forEach(place => {
                        createPlaceMarker(place, type);
                    });

                    // show results list and stats
                    displayPlaceResults(type, results, location);

                    // adjust map bounds
                    const bounds = new google.maps.LatLngBounds();
                    if (userLocation) bounds.extend(userLocation);
                    results.slice(0, 15).forEach(p => bounds.extend(p.geometry.location));
                    map.fitBounds(bounds);
                } else if (status === google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                    currentPlacesByType[type] = [];
                    displayPlaceResults(type, [], location);
                } else {
                    console.warn('Places search failed for', type, status);
                }
            });
        }

        function createPlaceMarker(place, type) {
            const icons = {
                restaurant: '🍽️',
                lodging: '🏨',
                atm: '🏧',
                gas_station: '⛽'
            };

            const marker = new google.maps.Marker({
                position: place.geometry.location,
                map: map,
                title: place.name,
                label: {
                    text: icons[type],
                    fontSize: '20px'
                }
            });

            marker.addListener('click', () => {
                showPlaceDetails(place, marker);
            });

            placeMarkers[type].push(marker);
        }

        function clearPlaceMarkers(type) {
            if (placeMarkers[type]) {
                placeMarkers[type].forEach(marker => marker.setMap(null));
                placeMarkers[type] = [];
            }
        }

        function displayPlaceResults(type, places, searchLocation) {
            const container = document.getElementById('results-container');

            if (!places || places.length === 0) {
                container.innerHTML = `
                    <div class="no-results">
                        <p>No ${type.replace('_',' ')} found nearby</p>
                    </div>
                `;
                document.getElementById('stats-bar').innerHTML = `Found <strong>0</strong> ${type.replace('_',' ')} nearby`;
                return;
            }

            document.getElementById('stats-bar').innerHTML = `Found <strong>${places.length}</strong> ${type.replace('_',' ')} nearby`;

            container.innerHTML = places.map((place, index) => {
                const distance = searchLocation ? getDistance(searchLocation, place.geometry.location) : null;
                return `
                    <div class="parking-card" data-type="${type}" data-index="${index}" onclick="selectPlaceByType('${type}', ${index})">
                        <div class="parking-name">${place.name}</div>
                        <div class="parking-address">${place.vicinity || ''}</div>
                        <div class="parking-info">
                            <div>${distance ? `<span class="parking-distance">📍 ${distance}</span>` : ''}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Attach click handlers to filter buttons that use data-type (robust alternative to inline onclick)
        (function attachFilterButtonListeners(){
            try {
                document.querySelectorAll('.filter-btn[data-type]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const t = btn.dataset.type;
                        console.log('filter button clicked', t);
                        togglePlace(t);
                    });
                });

                // As a robust fallback, use event delegation so clicks are caught even if elements move
                document.addEventListener('click', (e) => {
                    const btn = e.target.closest && e.target.closest('.filter-btn');
                    if (!btn) return;
                    // ignore clicks on parking button since it has its own handler
                    if (btn.classList.contains('parking')) return;
                    const t = btn.dataset.type;
                    if (t) {
                        console.log('delegated filter click', t);
                        togglePlace(t);
                    }
                });
            } catch (err) {
                console.warn('Could not attach filter button listeners', err);
            }
        })();

        function selectPlaceByType(type, index) {
            const place = currentPlacesByType[type] && currentPlacesByType[type][index];
            const marker = placeMarkers[type] && placeMarkers[type][index];
            if (!place) return;
            map.setCenter(place.geometry.location);
            map.setZoom(17);
            if (marker) showPlaceDetails(place, marker);
        }

        function updateStats(count) {
            const statsText = currentFilter === 'parking' 
                ? `Found <strong>${count}</strong> parking spots nearby`
                : `Found <strong>${count}</strong> ${currentFilter.replace('_', ' ')} places nearby`;
            document.getElementById('stats-bar').innerHTML = statsText;
        }

        // Test function for debugging
        function testDirections() {
            if (!userLocation) {
                console.log('No user location available');
                return;
            }
            
            const testDestination = new google.maps.LatLng(
                userLocation.lat + 0.01, 
                userLocation.lng + 0.01
            );
            
            const request = {
                origin: new google.maps.LatLng(userLocation.lat, userLocation.lng),
                destination: testDestination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            
            console.log('Test request:', request);
            
            directionsService.route(request, (result, status) => {
                console.log('Test status:', status);
                console.log('Test result:', result);
                if (status === google.maps.DirectionsStatus.OK) {
                    console.log('Directions service is working!');
                    directionsRenderer.setDirections(result);
                } else {
                    console.error('Directions service test failed:', status);
                }
            });
        }

        window.gm_authFailure = () => {
            alert('Google Maps authentication failed. Please check your API key and make sure Directions API is enabled.');
        };
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVLfjbMcdJ9ozo7GhhAn6ezs0WVaMuOCc&libraries=places&callback=initMap">
    </script>
</body>
</html>