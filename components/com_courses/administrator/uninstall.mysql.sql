DROP TABLE #__courses;
DROP TABLE #__videos;
DROP TABLE #__users_videos;
DROP TABLE #__courses_orders;
DROP TABLE #__orders;

-- CATEGORIES
DELETE FROM `#__categories` WHERE `section` LIKE 'com_courses'