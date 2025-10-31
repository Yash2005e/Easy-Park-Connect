<?php include('header.php'); ?>

<div class="container-fluid">
    <?php include('notification.php'); ?>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-3 px-0" style="position:fixed">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body m-0 p-0">
                    <?php include('sidebar.php'); ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-9 offset-3 mt-5">
            <div class="row">

                <!-- Vehicles Parked -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-info text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1><?= $this->datawork->count_data('add_vehicle', ['status' => 0]); ?></h1>
                                    <h6 class="my-3">Vehicles Parked</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <i class="fas fa-parking fa-4x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departed Vehicles -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-dark text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1><?= $this->datawork->count_data('add_vehicle', ['status' => 1]); ?></h1>
                                    <h6 class="my-3">Departed Vehicles</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <i class="fas fa-car fa-4x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Category -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-danger text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1><?= $this->datawork->count_data('category', ['cat_id!=' => NULL]); ?></h1>
                                    <h6 class="my-3">Available Category</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <i class="fas fa-box fa-4x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Earnings -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-warning text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1>
                                        <!-- <i class="fas fa-rupee-sign fa-xs"></i>&nbsp; -->
                                        <?= number_format($this->datawork->column_sum('parking_charge', 'add_vehicle') * 10, 2); ?>
                                    </h1>
                                    <h6 class="my-3">Total Earnings</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <i class="fas fa-money-check-alt fa-4x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Records -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-secondary text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1><?= $this->datawork->count_data('add_vehicle', ['id!=' => 0]); ?></h1>
                                    <h6 class="my-3">Total Records</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <i class="fas fa-layer-group fa-4x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Parking Slots -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card dashboard-card bg-primary text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h1><?= $this->datawork->column_sum('vehicle_limit', 'category'); ?></h1>
                                    <h6 class="my-3">Total Parking Slots</h6>
                                </div>
                                <!-- <div class="col-5 text-end"> -->
                                    <!-- <i class="fas fa-check-double fa-4x"></i> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End of stats row -->

            <!-- =============================================================== -->
            <!-- Parking Slots Visualizer (Square Grid) -->
            <!-- =============================================================== -->
            <?php
            	$totalSlots = 74;
            	$occupiedSlots = $this->datawork->count_data('add_vehicle', ['status' => 0]);
            	$occupiedSlots = min(max((int)$occupiedSlots, 0), $totalSlots);
            	$freeSlots = $totalSlots - $occupiedSlots;
            ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <h5 class="mb-0">Parking Status</h5>
                            <div class="d-flex align-items-center gap-2">
                                <div class="btn-group" role="group" aria-label="Floor filter">
                                    <button type="button" class="btn btn-outline-primary btn-sm floor-btn active" data-floor="G">Ground (1-30)</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm floor-btn" data-floor="S">Second (31-50)</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm floor-btn" data-floor="T">Third (51-74)</button>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" aria-label="View toggle">
                                    <button type="button" class="btn btn-outline-secondary view-btn active" data-view="10">First 10</button>
                                    <button type="button" class="btn btn-outline-secondary view-btn" data-view="all">View All</button>
                                </div>
                            </div>
                            <div class="small text-muted ms-auto">Filled: <?= $occupiedSlots; ?> / <?= $totalSlots; ?> &nbsp;|&nbsp; Empty: <?= $freeSlots; ?></div>
                        </div>
                        <div class="card-body">
                            <!-- Legend -->
                            <div class="legend">
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #c8e6c9;"></div>
                                    <span>Empty</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #ffcdd2;"></div>
                                    <span>Filled</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #e9ecef;"></div>
                                    <span>Non-parking area</span>
                                </div>
                            </div>

                            <!-- Parking Slots Grid -->
                            <div id="parking-lot-visual"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============================================================== -->

        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .dashboard-card {
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 15px rgba(0,0,0,0.2);
    }
    .dashboard-card h1 { font-weight: bold; }
    .dashboard-card h6 { opacity: 0.9; }

    /* Parking Visualizer */
    #parking-lot-visual {
        display: grid;
        grid-template-columns: repeat(10, minmax(50px, 1fr));
        gap: 10px;
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-top: 15px;
        position: relative;
    }
    .parking-slot {
        border: 2px solid #adb5bd;
        border-radius: 6px;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        color: #495057;
        transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        user-select: none;
    }
    .parking-slot.free {
        background-color: #c8e6c9;
        border-color: #4caf50;
    }
    .parking-slot.booked {
        background-color: #ffcdd2;
        border-color: #f44336;
        color: #b71c1c;
    }
    .legend {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-bottom: 10px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .legend-color {
        width: 20px;
        height: 20px;
        border: 1px solid #adb5bd;
        border-radius: 4px;
    }
    .void {
        background-color: #e9ecef;
        border: 1px dashed #adb5bd;
    }
</style>

<!-- Scripts -->
<script>
(function() {
    const totalSlots = 74;
    const occupiedCount = <?= (int)$occupiedSlots ?>;

    const floorRanges = {
        G: { start: 1, end: 30 },
        S: { start: 31, end: 50 },
        T: { start: 51, end: 74 }
    };

    const grid = document.getElementById('parking-lot-visual');
    const floorButtons = document.querySelectorAll('.floor-btn');
    const viewButtons = document.querySelectorAll('.view-btn');

    let activeFloor = 'G';
    let viewMode = '10'; // '10' or 'all'

    function isOccupied(slotNum) {
        return slotNum <= occupiedCount; // placeholder logic based on count only
    }

    function buildSlotsForFloor(floorKey) {
        const { start, end } = floorRanges[floorKey];
        const slots = [];
        for (let i = start; i <= end; i++) {
            slots.push({
                num: i,
                label: 'S' + String(i).padStart(2, '0'),
                occupied: isOccupied(i)
            });
        }
        return slots;
    }

    function getVoidCellsForFloor(floorKey) {
        // Grid is 10xN columns. We'll mark an upper-middle void spanning columns 4-7 for 2 rows.
        // Represent void as array of indices (0-based) within the grid of current floor's slots.
        // We'll approximate a visual void by inserting placeholder divs with class 'void'.
        // For consistent layout, create a 10-column grid and place voids at positions 33-36 (row 4, cols 4-7) by using CSS grid auto-flow.
        // We'll return an array of positions to inject void placeholders when rendering 'all' or first 10 as applicable.
        // Since each floor has its own grid instance, we define positions within the floor block:
        return [33,34,35,36];
    }

    function render() {
        grid.innerHTML = '';
        const floorSlots = buildSlotsForFloor(activeFloor);
        const maxToShow = viewMode === '10' ? 10 : floorSlots.length;
        const voidCells = getVoidCellsForFloor(activeFloor);

        for (let i = 0; i < maxToShow; i++) {
            // Inject void cells when in range for better building shape; only do if showing more than 20 to avoid crowding in first 10.
            if (viewMode === 'all' && voidCells.includes(i)) {
                const v = document.createElement('div');
                v.className = 'void';
                grid.appendChild(v);
            }
            const slot = floorSlots[i];
            if (!slot) break;
            const div = document.createElement('div');
            div.className = 'parking-slot ' + (slot.occupied ? 'booked' : 'free');
            div.textContent = slot.label;
            grid.appendChild(div);
        }
    }

    floorButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            floorButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeFloor = btn.dataset.floor;
            render();
        });
    });

    viewButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            viewButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            viewMode = btn.dataset.view;
            render();
        });
    });

    render();
})();
</script>



<?php include('footer.php'); ?>
<?php if($this->session->flashdata('just_logged_in_admin')): ?>
<!-- Post-login audio & visual (admin) -->
<audio id="postLoginAudioAdmin" preload="auto">
    <source src="https://assets.mixkit.co/sfx/preview/mixkit-futuristic-arcade-bleep-2103.mp3" type="audio/mpeg">
</audio>
<div id="postLoginOverlayAdmin" style="position:fixed;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;z-index:3000;">
    <div id="pulseAdmin" style="width:260px;height:260px;border-radius:50%;background:radial-gradient(circle at 30% 30%, rgba(99,102,241,0.25), rgba(99,102,241,0.06) 40%, transparent 60%);box-shadow:0 0 40px rgba(99,102,241,0.45);display:flex;align-items:center;justify-content:center;backdrop-filter: blur(6px);">
        <div style="width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,#7c3aed,#06b6d4);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:18px;transform:scale(.6);animation:pulseAdmin 1200ms ease-out 0s 1;">WELCOME</div>
    </div>
</div>
<style>
@keyframes pulseAdmin{0%{transform:scale(.6);opacity:0}40%{transform:scale(1.05);opacity:1}100%{transform:scale(1);opacity:0}}
#postLoginOverlayAdmin{animation:fadeOverlay 2200ms ease-out 0s 1}
@keyframes fadeOverlay{0%{opacity:0}10%{opacity:1}80%{opacity:1}100%{opacity:0}}
</style>
<script>
    (function(){
        try{
            const audio = document.getElementById('postLoginAudioAdmin');
            const overlay = document.getElementById('postLoginOverlayAdmin');
            // play audio then remove overlay after duration
            audio.play().catch(()=>{
                // user gesture required - show overlay briefly
            });
            setTimeout(()=>{ if(overlay) overlay.remove(); }, 2400);
        }catch(e){console.warn(e)}
    })();
</script>
<?php endif; ?>
    