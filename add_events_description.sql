-- Migration script to add description column to events table
-- Run this script to fix the "Unknown column 'e.description'" error

USE uth_clubs;

-- Add description column to events table
ALTER TABLE events ADD COLUMN description TEXT AFTER max_participants;

-- Verify the column was added
DESCRIBE events;