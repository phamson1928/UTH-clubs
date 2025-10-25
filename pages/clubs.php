<?php
// Fetch clubs with leader name and member count
try {
    $stmt = $pdo->query("SELECT c.id, c.name, c.description, c.category, c.schedule_meeting, c.activities, c.club_image, c.leader_id,
                                u.name AS leader_name,
                                (SELECT COUNT(*) FROM club_members cm WHERE cm.club_id = c.id) AS member_count
                         FROM clubs c
                         LEFT JOIN users u ON u.id = c.leader_id
                         ORDER BY c.created_at DESC");
    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $clubs = [];
}
?>
<!-- Clubs Section -->
<div id="clubs" class="section<?php echo ($activeSection === 'clubs') ? ' active' : ''; ?>">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Student Clubs</h1>
        
        <div class="filters">
            <div class="filter-group">
                <label>Search Clubs</label>
                <input type="text" id="clubSearch" placeholder="Search by name..." onkeyup="filterClubs()">
            </div>
            <div class="filter-group">
                <label>Category</label>
                <input type="text" id="clubCategory" placeholder="Type category..." onkeyup="filterClubs()">
            </div>
        </div>

        <div class="card-grid" id="clubsList">
            <?php foreach ($clubs as $club): ?>
            <?php
                $category = htmlspecialchars($club['category'] ?: '');
                $leaderName = htmlspecialchars($club['leader_name'] ?: 'N/A');
                $memberCount = (int)($club['member_count'] ?: 0);
                $schedule = htmlspecialchars($club['schedule_meeting'] ?: '');
            ?>
            <div class="card" data-category="<?php echo strtolower($category); ?>">
                <div class="card-header">
                    <div class="card-title"><?php echo htmlspecialchars($club['name']); ?></div>
                    <span class="badge badge-info"><?php echo $memberCount; ?> Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> <?php echo $leaderName; ?></p>
                    <p><strong>Category:</strong> <?php echo ucfirst($category); ?></p>
                    <p><?php echo htmlspecialchars($club['description']); ?></p>
                    <?php if ($schedule): ?>
                    <p><strong>Meeting Schedule:</strong> <?php echo $schedule; ?></p>
                    <?php endif; ?>
                    <button class="btn btn-success" onclick="joinClub(<?php echo (int)$club['id']; ?>)">Join Club</button>
                    <a class="btn btn-secondary" href="?section=clubDetails&club_id=<?php echo (int)$club['id']; ?>">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($clubs)): ?>
            <div>No clubs available.</div>
            <?php endif; ?>
        </div>
    </div>
</div>