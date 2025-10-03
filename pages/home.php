<?php
// Featured: show 3 most recent events (representative, no date filtering)
try {
    $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
    $upStmt = $pdo->prepare("SELECT e.id, e.name, e.date, e.location, e.max_participants, e.event_image,
                                  c.name AS club_name,
                                  (e.max_participants - (SELECT COUNT(*) FROM event_registrations er WHERE er.event_id = e.id)) AS seats_left,
                                  (SELECT COUNT(*) FROM event_registrations er WHERE er.event_id = e.id AND er.user_id = ?) AS is_registered
                           FROM events e
                           LEFT JOIN clubs c ON c.id = e.club_id
                           ORDER BY e.date DESC
                           LIMIT 3");
    $upStmt->execute([$userId]);
    $upcoming = $upStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $upcoming = [];
}
// Featured clubs (top 3 by members)
try {
    $fcStmt = $pdo->query("SELECT c.id, c.name, c.description, c.category, c.schedule_meeting,
                                  (SELECT COUNT(*) FROM club_members cm WHERE cm.club_id = c.id) AS member_count,
                                  u.name AS leader_name
                           FROM clubs c
                           LEFT JOIN users u ON u.id = c.leader_id
                           ORDER BY member_count DESC
                           LIMIT 3");
    $featuredClubs = $fcStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $featuredClubs = [];
}
?>
<!-- Home Section -->
<div id="home" class="section<?php echo ($activeSection === 'home') ? ' active' : ''; ?>">
    <div class="hero">
        <h1>Welcome to UTH Clubs</h1>
        <p>Discover clubs, join events, and connect with your university community</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="#" class="btn btn-primary" onclick="showSection('clubs'); return false;">Explore Clubs</a>
            <a href="#" class="btn btn-secondary" onclick="showSection('events'); return false;">View Events</a>
        </div>
    </div>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Featured Events</h2>
        <div class="card-grid" id="upcomingEvents">
            <?php foreach ($upcoming as $ev): ?>
            <div class="card">
                <div class="card-header">
                    <div style="display:flex; gap:1rem; align-items:center;">
                        <?php if (!empty($ev['event_image'])): ?>
                            <?php $imgFile = basename($ev['event_image']); ?>
                            <img src="uploads/events/<?php echo htmlspecialchars($imgFile); ?>" alt="<?php echo htmlspecialchars($ev['name']); ?>" style="width:72px; height:56px; object-fit:cover; border-radius:6px; cursor:pointer;" onclick="showImageModal('uploads/events/<?php echo htmlspecialchars($imgFile); ?>','<?php echo htmlspecialchars($ev['name']); ?>')">
                        <?php else: ?>
                            <div style="width:72px; height:56px; background:#f3f4f6; display:flex; align-items:center; justify-content:center; border-radius:6px; color:#6b7280;">No image</div>
                        <?php endif; ?>
                        <div>
                            <div class="card-title"><?php echo htmlspecialchars($ev['name']); ?></div>
                            <span class="badge badge-info"><?php echo htmlspecialchars($ev['club_name']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> <?php echo htmlspecialchars($ev['date']); ?></p>
                    <p><strong>📍 Location:</strong> <?php echo htmlspecialchars($ev['location']); ?></p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available"><?php echo max(0, (int)$ev['seats_left']); ?></span>/<?php echo (int)$ev['max_participants']; ?></p>
                    <?php if ((int)$ev['is_registered'] > 0): ?>
                        <button class="btn btn-secondary" disabled>Already Registered</button>
                    <?php elseif ((int)$ev['seats_left'] <= 0): ?>
                        <button class="btn btn-secondary" disabled>Event Full</button>
                    <?php else: ?>
                        <button class="btn btn-primary" onclick="registerForEvent(<?php echo (int)$ev['id']; ?>)">Register Now</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($upcoming)): ?>
            <div>No events to show.</div>
            <?php endif; ?>
        </div>

        <h2 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Featured Clubs</h2>
        <div class="card-grid">
            <?php foreach ($featuredClubs as $fc): ?>
            <?php
                $category = htmlspecialchars($fc['category'] ?: '');
                $schedule = htmlspecialchars($fc['schedule_meeting'] ?: '');
                $desc = trim($fc['description']);
                $desc = $desc ? htmlspecialchars(mb_strimwidth($desc, 0, 160, '...')) : '';
            ?>
            <div class="card" data-category="<?php echo strtolower($category); ?>">
                <div class="card-header">
                    <div class="card-title"><?php echo htmlspecialchars($fc['name']); ?></div>
                    <div style="display:flex; gap:.5rem; align-items:center;">
                        <?php if ($category): ?>
                        <span class="badge badge-warning"><?php echo ucfirst($category); ?></span>
                        <?php endif; ?>
                        <span class="badge badge-info"><?php echo (int)$fc['member_count']; ?> Members</span>
                    </div>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> <?php echo htmlspecialchars($fc['leader_name'] ?: 'N/A'); ?></p>
                    <?php if ($schedule): ?>
                    <p><strong>Schedule:</strong> <?php echo $schedule; ?></p>
                    <?php endif; ?>
                    <?php if ($desc): ?>
                    <p><?php echo $desc; ?></p>
                    <?php endif; ?>
                    <div style="display:flex; gap:.5rem; flex-wrap:wrap;">
                        <button class="btn btn-success" onclick="joinClub(<?php echo (int)$fc['id']; ?>)">Join Club</button>
                        <a class="btn btn-secondary" href="?section=clubDetails&club_id=<?php echo (int)$fc['id']; ?>">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($featuredClubs)): ?>
            <div>No clubs to show.</div>
            <?php endif; ?>
        </div>
    </div>
</div>