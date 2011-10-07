CREATE TABLE IF NOT EXISTS `#__courses` (
`id` int(11) unsigned NOT NULL auto_increment,
`catid` int(11) unsigned NOT NULL default '0',
`sid` int(11) unsigned NOT NULL default '0',
`title` varchar(255) NOT NULL default '',
`alias` varchar(255) NOT NULL default '',
`price` FLOAT NOT NULL,
`description` varchar(255) NOT NULL default '',
`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
`created` datetime NOT NULL default '0000-00-00 00:00:00',
`created_by` int(11) unsigned NOT NULL default '0',
`created_by_alias` varchar(255) NOT NULL default '',
`modified` datetime NOT NULL default '0000-00-00 00:00:00',
`modified_by` int(11) unsigned NOT NULL default '0',
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
`published` tinyint(1)  NOT NULL default '0',
`ordering` int(11) NOT NULL default '0',
`params` text NOT NULL,
`hits` int(11) unsigned NOT NULL default '0',
PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__videos` (
`id` int(11) unsigned NOT NULL auto_increment,
`catid` int(11) unsigned NOT NULL default '0',
`sid` int(11) unsigned NOT NULL default '0',
`title` varchar(255) NOT NULL default '',
`alias` varchar(255) NOT NULL default '',
`max_hit` int(11) unsigned NOT NULL default '0',
`course_id` int(11) unsigned NOT NULL default '0',
`url` varchar(255) NOT NULL default '',
`created` datetime NOT NULL default '0000-00-00 00:00:00',
`created_by` int(11) unsigned NOT NULL default '0',
`created_by_alias` varchar(255) NOT NULL default '',
`modified` datetime NOT NULL default '0000-00-00 00:00:00',
`modified_by` int(11) unsigned NOT NULL default '0',
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
`published` tinyint(1)  NOT NULL default '0',
`ordering` int(11) NOT NULL default '0',
`params` text NOT NULL,
`hits` int(11) unsigned NOT NULL default '0',
PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__users_videos` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);


CREATE TABLE IF NOT EXISTS `#__courses_orders` (
  `id` int(11) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_code` varchar(36) NOT NULL,
  `reference` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__orders` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(36) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL default '',
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

--
-- Insert Categories
--

-- Insert Category
INSERT INTO `#__categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES
(NULL, 0, 'Concursos', '', 'concursos', '', 'com_courses', 'left', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget felis  nibh. Aenean posuere lorem ac diam luctus faucibus. Donec malesuada,  metus id accumsan posuere, dolor risus accumsan tortor, vel facilisis  elit odio a nisi. Cras blandit augue non enim scelerisque scelerisque.  Sed a ligula sed metus elementum elementum ac sed est. In auctor dapibus  lobortis. Nunc accumsan ultrices velit nec congue. Maecenas euismod  lacinia vulputate. Donec egestas justo vel turpis mattis in ultricies  sapien iaculis. Pellentesque fermentum luctus arcu, non eleifend massa  congue non.</p>', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
SET @categoryId = last_insert_id();
-- Insert Category Courses
INSERT INTO `#__courses` (`id`, `catid`, `sid`, `title`, `alias`, `price`, `description`, `publish_up`, `publish_down`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, @categoryId, '0', 'Banco do Brasil', 'banco-do-brasil', '235.25', '<p>Ut quam enim, semper quis imperdiet a, eleifend sed nibh. In eu dolor ligula. Praesent eget felis a nulla lacinia viverra. Morbi vel dolor nec ligula dignissim tincidunt hendrerit eu magna. Integer mattis, libero eu malesuada laoreet, libero nisl elementum nisl, a eleifend neque nisi eu turpis. Curabitur quis quam id turpis tincidunt interdum. Ut urna tellus, iaculis id gravida quis, porta non nisl.</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '1', '0', '', '0');
-- Insert Videos
SET @courseId = last_insert_id();
INSERT INTO `#__videos` (`id`, `catid`, `sid`, `title`, `alias`, `max_hit`, `course_id`, `url`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES
(NULL, 0, 0, 'Video Aula Teste 1', 'video-aula-teste-1', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 2', 'video-aula-teste-2', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 3', 'video-aula-teste-3', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 4', 'video-aula-teste-4', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 5', 'video-aula-teste-5', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 6', 'video-aula-aula-teste-6', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 7', 'video-aula-teste-7', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 8', 'video-aula-teste-8', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 9', 'video-aula-teste-9', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 10', 'video-aula-teste-10', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 11', 'video-aula-teste-11', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0);

-- Insert Category
INSERT INTO `#__categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES 
(NULL, 0, 'Pós-Graduação', '', 'pos-graduacao', '', 'com_courses', 'left', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget felis  nibh. Aenean posuere lorem ac diam luctus faucibus. Donec malesuada,  metus id accumsan posuere, dolor risus accumsan tortor, vel facilisis  elit odio a nisi. Cras blandit augue non enim scelerisque scelerisque.  Sed a ligula sed metus elementum elementum ac sed est. In auctor dapibus  lobortis. Nunc accumsan ultrices velit nec congue. Maecenas euismod  lacinia vulputate. Donec egestas justo vel turpis mattis in ultricies  sapien iaculis. Pellentesque fermentum luctus arcu, non eleifend massa  congue non.</p>', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
SET @categoryId = last_insert_id();
-- Insert Category Courses
INSERT INTO `#__courses` (`id`, `catid`, `sid`, `title`, `alias`, `price`, `description`, `publish_up`, `publish_down`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, @categoryId, '0', 'Carreiras Fiscais', 'carreiras-fiscais', '235.25', '<p>Integer ultrices metus in turpis facilisis nec sollicitudin lacus sodales. Maecenas posuere nisi non lectus tristique feugiat. Phasellus et aliquam ipsum. Aenean ac massa neque. Nulla accumsan, leo ultrices ornare congue, urna justo tempor urna, non eleifend risus neque ac nunc. Vivamus et dui tortor. Morbi at posuere arcu. Nam non massa mauris. Etiam pretium magna ac orci ullamcorper et dignissim ipsum gravida. Duis imperdiet semper pharetra. Nam iaculis, risus sit amet imperdiet facilisis, risus mi aliquam magna, et porta elit orci a diam. Suspendisse mi justo, auctor eget condimentum ut, tempus at turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris pretium pellentesque leo non dignissim. Maecenas sit amet massa elit, vitae facilisis dui. Curabitur adipiscing mi in nibh commodo porttitor.</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '1', '0', '', '0');
-- Insert Videos
SET @courseId = last_insert_id();
INSERT INTO `#__videos` (`id`, `catid`, `sid`, `title`, `alias`, `max_hit`, `course_id`, `url`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES
(NULL, 0, 0, 'Video Aula Teste 1', 'video-aula-teste-1', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 2', 'video-aula-teste-2', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 3', 'video-aula-teste-3', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 4', 'video-aula-teste-4', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 5', 'video-aula-teste-5', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 6', 'video-aula-aula-teste-6', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 7', 'video-aula-teste-7', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0);
INSERT INTO `#__courses` (`id`, `catid`, `sid`, `title`, `alias`, `price`, `description`, `publish_up`, `publish_down`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, @categoryId, '0', 'Curso teste 2', 'curso-teste-2', '235.25', '<p>Integer ultrices metus in turpis facilisis nec sollicitudin lacus sodales. Maecenas posuere nisi non lectus tristique feugiat. Phasellus et aliquam ipsum. Aenean ac massa neque. Nulla accumsan, leo ultrices ornare congue, urna justo tempor urna, non eleifend risus neque ac nunc. Vivamus et dui tortor. Morbi at posuere arcu. Nam non massa mauris. Etiam pretium magna ac orci ullamcorper et dignissim ipsum gravida. Duis imperdiet semper pharetra. Nam iaculis, risus sit amet imperdiet facilisis, risus mi aliquam magna, et porta elit orci a diam. Suspendisse mi justo, auctor eget condimentum ut, tempus at turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris pretium pellentesque leo non dignissim. Maecenas sit amet massa elit, vitae facilisis dui. Curabitur adipiscing mi in nibh commodo porttitor.</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '1', '0', '', '0');
-- Insert Videos
SET @courseId = last_insert_id();
INSERT INTO `#__videos` (`id`, `catid`, `sid`, `title`, `alias`, `max_hit`, `course_id`, `url`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, 0, 0, 'Video Aula Teste 1', 'video-aula-teste-1', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 2', 'video-aula-teste-2', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 3', 'video-aula-teste-3', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 4', 'video-aula-teste-4', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 5', 'video-aula-teste-5', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 6', 'video-aula-aula-teste-6', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 7', 'video-aula-teste-7', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0);

INSERT INTO `#__courses` (`id`, `catid`, `sid`, `title`, `alias`, `price`, `description`, `publish_up`, `publish_down`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, @categoryId, '0', 'Curso Teste 3', 'curso-teste-3', '235.25', '<p>Integer ultrices metus in turpis facilisis nec sollicitudin lacus sodales. Maecenas posuere nisi non lectus tristique feugiat. Phasellus et aliquam ipsum. Aenean ac massa neque. Nulla accumsan, leo ultrices ornare congue, urna justo tempor urna, non eleifend risus neque ac nunc. Vivamus et dui tortor. Morbi at posuere arcu. Nam non massa mauris. Etiam pretium magna ac orci ullamcorper et dignissim ipsum gravida. Duis imperdiet semper pharetra. Nam iaculis, risus sit amet imperdiet facilisis, risus mi aliquam magna, et porta elit orci a diam. Suspendisse mi justo, auctor eget condimentum ut, tempus at turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris pretium pellentesque leo non dignissim. Maecenas sit amet massa elit, vitae facilisis dui. Curabitur adipiscing mi in nibh commodo porttitor.</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '1', '0', '', '0');
-- Insert Videos
SET @courseId = last_insert_id();
INSERT INTO `#__videos` (`id`, `catid`, `sid`, `title`, `alias`, `max_hit`, `course_id`, `url`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, 0, 0, 'Video Aula Teste 1', 'video-aula-teste-1', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 2', 'video-aula-teste-2', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 3', 'video-aula-teste-3', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 4', 'video-aula-teste-4', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 5', 'video-aula-teste-5', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 6', 'video-aula-aula-teste-6', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 7', 'video-aula-teste-7', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0);

-- Insert Category
INSERT INTO `#__categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES 
(NULL, 0, 'OAB', '', 'oab', '', 'com_courses', 'left', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget felis  nibh. Aenean posuere lorem ac diam luctus faucibus. Donec malesuada,  metus id accumsan posuere, dolor risus accumsan tortor, vel facilisis  elit odio a nisi. Cras blandit augue non enim scelerisque scelerisque.  Sed a ligula sed metus elementum elementum ac sed est. In auctor dapibus  lobortis. Nunc accumsan ultrices velit nec congue. Maecenas euismod  lacinia vulputate. Donec egestas justo vel turpis mattis in ultricies  sapien iaculis. Pellentesque fermentum luctus arcu, non eleifend massa  congue non.</p>', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
SET @categoryId = last_insert_id();
-- Insert Category Courses
INSERT INTO `#__courses` (`id`, `catid`, `sid`, `title`, `alias`, `price`, `description`, `publish_up`, `publish_down`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES 
(NULL, @categoryId, '0', 'Cartórios', 'cartorios', '235.25', '<p>Sed vel dolor et risus pulvinar feugiat. Fusce eget lacinia tellus. Donec luctus, erat et eleifend dictum, tortor augue suscipit arcu, quis sollicitudin elit libero et lorem. Donec vel venenatis lorem. Nulla facilisi. In pulvinar, arcu nec auctor pellentesque, enim elit mattis mauris, quis dignissim enim mi a felis. Nulla varius fermentum dictum. Mauris porttitor commodo dolor, non eleifend turpis vehicula ac. Pellentesque lorem nisi, mollis euismod adipiscing vel, imperdiet vehicula ligula. Pellentesque sit amet hendrerit odio. Donec lobortis, velit malesuada suscipit pretium, quam nunc aliquet tortor, vel laoreet velit elit nec lorem. Proin libero justo, lacinia a sollicitudin in, luctus id arcu. Aenean diam leo, feugiat et auctor vel, vestibulum in erat. </p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '1', '0', '', '0');
-- Insert Videos
SET @courseId = last_insert_id();
INSERT INTO `#__videos` (`id`, `catid`, `sid`, `title`, `alias`, `max_hit`, `course_id`, `url`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`, `hits`) VALUES
(NULL, 0, 0, 'Video Aula Teste 1', 'video-aula-teste-1', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 2', 'video-aula-teste-2', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 3', 'video-aula-teste-3', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 4', 'video-aula-teste-4', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 5', 'video-aula-teste-5', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 6', 'video-aula-aula-teste-6', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 7', 'video-aula-teste-7', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 8', 'video-aula-teste-8', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 9', 'video-aula-teste-9', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 10', 'video-aula-teste-10', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0),
(NULL, 0, 0, 'Video Aula Teste 11', 'video-aula-teste-11', 3, @courseId, 'http://pseudo01.hddn.com/vod/demo.flowplayervod/flowplayer-700.flv', '2011-08-18 15:03:31', 62, 'Administrator', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '', 0);
--
-- Insert Sample Relationships
--