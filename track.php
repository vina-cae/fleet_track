<?php
include 'db.php';

$parcel = null;
$error = "";

if (isset($_GET['track_code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['track_code']);

    if (empty($code)) {
        $error = "Please enter a tracking code.";
    } else {
        $query = mysqli_query($conn, "SELECT * FROM parcels WHERE tracking_code = '$code' LIMIT 1");

        if (mysqli_num_rows($query) > 0) {
            $parcel = mysqli_fetch_assoc($query);
        } else {
            $error = "Tracking code not found. Please check and try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Parcel - Fleet Track</title>
    <link rel="stylesheet" href="track-style.css">
    
    <!-- LEAFLET MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body class="theme-blue"> <!-- DEFAULT THEME -->

<div class="container">
    
    <!-- HEADER -->
    <div class="header">
        <div class="header-brand">
            <h1>Fleet Track</h1>
            <p class="tagline">Your package, our priority.</p>
        </div>
        <div class="theme-control">
            <button type="button" id="blueBtn" class="theme-btn active" onclick="setTheme('blue')">Blue Theme</button>
            <button type="button" id="pinkBtn" class="theme-btn" onclick="setTheme('pink')">Pink Theme</button>
            <a href="index.php?logout=1" class="admin-btn">Admin Login</a>
        </div>
    </div>

    <!-- SEARCH PANEL -->
    <div class="panel">
        <h3 style="margin-bottom: 20px; margin-left: -5px; text-align: center; letter-spacing: 2px;" class="accent-text">Track Your Parcel</h3>
        <form action="track.php" method="GET" class="search-form">
            <input type="text" name="track_code" placeholder="Enter Tracking Code (e.g. TRK-XXXXXX)" value="<?php if(isset($_GET['track_code'])) echo htmlspecialchars($_GET['track_code']); ?>" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- ERROR MESSAGE -->
    <?php if ($error != ""): ?>
        <div class="error-msg">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- RESULT SECTION -->
    <?php if ($parcel): ?>
        <div class="panel">
            <h3 style="margin-bottom: 15px;" class="accent-text">Parcel Details: <?php echo htmlspecialchars($parcel['tracking_code']); ?></h3>
            
            <div class="result-grid">
                
                <div class="result-item">
                    <small>Status</small>
                    <div class="status-badge"><?php echo htmlspecialchars($parcel['status']); ?></div>
                </div>

                <div class="result-item">
                    <small>Sender</small>
                    <h3><?php echo htmlspecialchars($parcel['sender']); ?></h3>
                </div>

                <div class="result-item">
                    <small>Receiver</small>
                    <h3><?php echo htmlspecialchars($parcel['receiver']); ?></h3>
                </div>

                <div class="result-item">
                    <small>Weight</small>
                    <h3><?php echo htmlspecialchars($parcel['weight']); ?> kg</h3>
                </div>

                <div class="result-item">
                    <small>Origin</small>
                    <p><?php echo htmlspecialchars($parcel['origin']); ?></p>
                </div>

                <div class="result-item">
                    <small>Destination</small>
                    <p><?php echo htmlspecialchars($parcel['destination']); ?></p>
                </div>

            </div>
        </div>

        <!-- MAP SECTION -->
        <div class="panel">
            <h3 style="margin-bottom: 15px;" class="accent-text">Parcel Location</h3>
            <div id="map"></div>
        </div>
    <?php endif; ?>

    <!-- FOOTER -->
    <div class="footer">
        <p>© <?php echo date("Y"); ?> Fleet Track | Parcel Tracking System</p>
    </div>

</div>

<script>
    // ==================== THEME SWITCHER ====================
    function setTheme(theme) {
        const body = document.body;
        const blueBtn = document.getElementById('blueBtn');
        const pinkBtn = document.getElementById('pinkBtn');

        body.classList.remove('theme-blue', 'theme-pink');
        blueBtn.classList.remove('active');
        pinkBtn.classList.remove('active');

        if (theme === 'pink') {
            body.classList.add('theme-pink');
            pinkBtn.classList.add('active');
            localStorage.setItem('fleetTheme', 'pink');
        } else {
            body.classList.add('theme-blue');
            blueBtn.classList.add('active');
            localStorage.setItem('fleetTheme', 'blue');
        }
    }

    const savedTheme = localStorage.getItem('fleetTheme');
    if (savedTheme === 'pink') {
        setTheme('pink');
    }

    // ==================== MAP ====================
    <?php if ($parcel): ?>
    const originCity = "<?php echo $parcel['origin']; ?>";
    const destCity = "<?php echo $parcel['destination']; ?>";

    const map = L.map('map').setView([12.8797, 121.7740], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    async function getCoords(city) {
        const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city)}`);
        const data = await res.json();
        return data.length > 0 ? [parseFloat(data[0].lat), parseFloat(data[0].lon)] : null;
    }

    async function drawMap() {
        const origin = await getCoords(originCity);
        const dest = await getCoords(destCity);

        if (origin && dest) {
            L.circleMarker(origin, { radius: 8, color: '#fff', fillColor: '#00b04f', fillOpacity: 1, weight: 2 })
             .addTo(map).bindPopup('Origin: ' + originCity).openPopup();

            L.circleMarker(dest, { radius: 8, color: '#fff', fillColor: '#db2777', fillOpacity: 1, weight: 2 })
             .addTo(map).bindPopup('Destination: ' + destCity);

            L.polyline([origin, dest], { color: '#38bdf8', weight: 3, dashArray: '5, 5' }).addTo(map);

            const bounds = L.latLngBounds([origin, dest]);
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    }
    setTimeout(drawMap, 500);
    <?php endif; ?>
</script>

</body>
</html>