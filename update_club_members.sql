-- Add status column to club_members table
ALTER TABLE club_members ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending';

-- Update existing members to approved status
UPDATE club_members SET status = 'approved' WHERE status = 'pending';