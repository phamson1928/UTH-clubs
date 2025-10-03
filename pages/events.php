<?php
// Fetch events with club names and available seats (max_participants - registrations)
try {
    $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
    $stmt = $pdo->prepare("SELECT e.id, e.name, e.date, e.location, e.max_participants, e.club_id, e.event_image,
                                c.name AS club_name,
                                (e.max_participants - (SELECT COUNT(*) FROM event_registrations er WHERE er.event_id = e.id)) AS seats_left,
                                (SELECT COUNT(*) FROM event_registrations er WHERE er.event_id = e.id AND er.user_id = ?) AS is_registered
                         FROM events e
                         LEFT JOIN clubs c ON c.id = e.club_id
                         ORDER BY e.date ASC");
    $stmt->execute([$userId]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $events = [];
}
// Fetch clubs for filter dropdown
try {
    $clubStmt = $pdo->query("SELECT id, name FROM clubs ORDER BY name ASC");
    $clubsForFilter = $clubStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $clubsForFilter = [];
}
?>
<!-- Events Section -->
<div id="events" class="section<?php echo ($activeSection === 'events') ? ' active' : ''; ?>">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Upcoming Events</h1>
        
        <div class="filters">
            <div class="filter-group">
                <label>Search Events</label>
                <input type="text" id="eventSearch" placeholder="Search by name..." onkeyup="filterEvents()">
            </div>
            <div class="filter-group">
                <label>Club</label>
                <select id="eventClub" onchange="filterEvents()">
                    <option value="">All Clubs</option>
                    <?php foreach ($clubsForFilter as $c): ?>
                    <option value="<?php echo (int)$c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label>Date From</label>
                <input type="date" id="eventDateFrom" onchange="filterEvents()">
            </div>
            <div class="filter-group">
                <label>Date To</label>
                <input type="date" id="eventDateTo" onchange="filterEvents()">
            </div>
        </div>

        <div class="card-grid" id="eventsList">
            <?php foreach ($events as $event): ?>
            <div class="card" data-club-id="<?php echo (int)$event['club_id']; ?>" data-date="<?php echo htmlspecialchars($event['date']); ?>">
                <div class="card-header">
                    <div style="display:flex; gap:1rem; align-items:center;">
                        <?php if (!empty($event['event_image'])): ?>
                            <?php $imgFile = basename($event['event_image']); ?>
                            <img src="uploads/events/<?php echo htmlspecialchars($imgFile); ?>" alt="<?php echo htmlspecialchars($event['name']); ?>" style="width:72px; height:56px; object-fit:cover; border-radius:6px; cursor:pointer;" onclick="showImageModal('uploads/events/<?php echo htmlspecialchars($imgFile); ?>','<?php echo htmlspecialchars($event['name']); ?>')">
                        <?php else: ?>
                            <div style="width:72px; height:56px; background:#f3f4f6; display:flex; align-items:center; justify-content:center; border-radius:6px; color:#6b7280;">No image</div>
                        <?php endif; ?>
                        <div>
                            <div class="card-title"><?php echo htmlspecialchars($event['name']); ?></div>
                            <span class="badge badge-info"><?php echo htmlspecialchars($event['club_name']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                    <p><strong>📍 Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available"><?php echo max(0, (int)$event['seats_left']); ?></span>/<?php echo (int)$event['max_participants']; ?></p>
                    <?php if ((int)$event['is_registered'] > 0): ?>
                        <button class="btn btn-secondary" disabled>Already Registered</button>
                    <?php elseif ((int)$event['seats_left'] <= 0): ?>
                        <button class="btn btn-secondary" disabled>Event Full</button>
                    <?php else: ?>
                        <button class="btn btn-primary" onclick="registerForEvent(<?php echo (int)$event['id']; ?>)">Register Now</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($events)): ?>
            <div>No events available.</div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        // Adjust filterEvents to work with club-id values
        function filterEvents() {
            const searchTerm = document.getElementById('eventSearch').value.toLowerCase();
            const clubId = document.getElementById('eventClub').value;
            const dateFrom = document.getElementById('eventDateFrom').value;
            const dateTo = document.getElementById('eventDateTo').value;
            const events = document.querySelectorAll('#eventsList .card');
            events.forEach(event => {
                const title = event.querySelector('.card-title').textContent.toLowerCase();
                const eventClubId = event.getAttribute('data-club-id');
                const eventDate = event.getAttribute('data-date');
                const matchesSearch = title.includes(searchTerm);
                const matchesClub = !clubId || eventClubId === clubId;
                const matchesDateFrom = !dateFrom || eventDate >= dateFrom;
                const matchesDateTo = !dateTo || eventDate <= dateTo;
                event.style.display = (matchesSearch && matchesClub && matchesDateFrom && matchesDateTo) ? 'block' : 'none';
            });
        }
    </script>
</div>