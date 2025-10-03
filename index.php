<?php
include 'config/database.php';
// Determine initial section and selected club (for server-side rendering and JS bootstrapping)
$activeSection = isset($_GET['section']) ? $_GET['section'] : 'home';
$activeClubId = isset($_GET['club_id']) ? intval($_GET['club_id']) : null;
include 'includes/header.php';
?>

<?php include 'pages/home.php'; ?>

<?php include 'pages/clubs.php'; ?>

<?php include 'pages/events.php'; ?>

<?php include 'pages/club-details.php'; ?>

<?php include 'pages/dashboard.php'; ?>

<?php include 'components/modals.php'; ?>

<?php include 'includes/footer.php'; ?>