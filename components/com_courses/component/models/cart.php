﻿<?php 

/**
 * Joomla! 1.5 component courses
 * Code generated by : Danny's Joomla! 1.5 MVC Component Code Generator
 * http://www.joomlafreak.be
 * date generated:  
 * @version 0.8
 * @author Danny Buytaert 
 * @package com_courses
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport('joomla.application.component.model');

/**
  * Courses Component Categories Model
  *
  * @package Courses
  */
  class CoursesModelCart extends JModel
  {
  /**
  * Categories data array
  *
  * @var array
  */
  var $_data = null;
 /**
  * Categories total
  *
  * @var integer
  */
  var $_total = null;
 /**
  * Constructor
  *
  * @since 1.5
  */
 function __construct()
  {
  parent::__construct();
 }
 /**
  * Method to get item item data for the category
  *
  * @access public
  * @return array
  */
  function getData()
  {
  // Lets load the content if it doesn't already exist
  if (empty($this->_data))
  {
  $query = $this->_buildQuery();
  $this->_data = $this->_getList($query);
  }
 return $this->_data;
  }
 /**
  * Method to get the total number of item items for the category
  *
  * @access public
  * @return integer
  */
  function getTotal()
  {
  // Lets load the content if it doesn't already exist
  if (empty($this->_total))
  {
  $query = $this->_buildQuery();
  $this->_total = $this->_getListCount($query);
  }
 return $this->_total;
  }
 function _buildQuery()
  {
  $user =& JFactory::getUser();
  $aid = $user->get('aid', 0);
 //Query to retrieve all categories that belong under the courses section and that are published.
  $query = 'SELECT cc.*, COUNT(a.id) AS numlinks,'
  .' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as slug'
  .' FROM #__categories AS cc'
  .' LEFT JOIN #__courses AS a ON a.catid = cc.id'
  .' WHERE a.published = 1'
  .' AND section = \'com_courses\''
  .' AND cc.published = 1'
  .' AND cc.access <= '.(int) $aid
  .' GROUP BY cc.id'
  .' ORDER BY cc.ordering';
 return $query;
  }
  
  function getSelection( $selection = array()){
	if (!empty($selection)) {
		$query = 'SELECT * FROM #__courses' .
		' WHERE id' .
		' IN (' . implode(" ,",$selection) . ')';
		return $this->_getList($query);
	}
	return array();
  }
  
  function setSelection( $order_code, $reference = null, $selection = array()){
	if (!empty($selection)) {
		foreach ($selection as $course_id) {
			$query = 'INSERT INTO `#__courses_orders` (`id`, `course_id`, `order_id`, `order_code`, `reference`) ' .
			'VALUES (NULL, \''. $course_id .'\', 0,\''. $order_code .'\',\''.$reference . '\')';
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	return false;
  }
  
  function addOrder($code = null, $status, $reference = null){
	$user =& JFactory::getUser();
	$date =& JFactory::getDate();
	if ($code || $reference) {
		$query = 'INSERT INTO `#__orders` (`id`, `code`, `created`, `user_id`, `status`, `reference`)' .
		' VALUES (NULL, ' .
		'\'' . $code. '\', ' .
		'\'' . $date->toFormat(). '\', ' .
		'\'' . $user->id.'\', ' . 
		'\'' . $status .'\', ' . 
		'\'' .  $reference .'\')';
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	}
	return false;
  }
  
  function setUsersVideos($courses = null, $reference = null) {
	if ($courses) {
		$courses = '('.implode(" ,",$courses).')';
		$user =& JFactory::getUser();
		$query =
		//'SET @user_id = ' . (int) $user->id . '; ' .
		'INSERT INTO ' .
		'#__users_videos ' .
		'( ' .
		'user_id, ' .
		'course_id, ' .
		'video_id, ' .
		'reference ' .
		') ' .
		'Select ' .
		'  ' . (int) $user->id . ', ' .
		'  #__courses.id As course_id, ' .
		'  #__videos.id As video_id, ' .
		'  \'' . $reference . '\' ' .
		'From ' .
		'  #__courses Left Join ' .
		'  #__videos On #__courses.id = #__videos.course_id ' .
		'Where ' .
		  '#__courses.id In ' . $courses ;
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
	return false;
  }
  
  function unsetUsersVideos($course = null) {
	if ($course) {
		$user =& JFactory::getUser();
		$query = 'SET @COURSE = ' . (int) $course . ';' .
		'SET @USERID = ' . (int) $user->id . ';' .
		'SET @REFERENCE = (SELECT reference FROM #__users_videos WHERE user_id = @USERID AND course_id = @COURSE LIMIT 1); ';// .
		//'DELETE FROM #__users_videos WHERE user_id =@USERID AND course_id = @COURSE; ' .
		//'DELETE FROM #__courses_orders WHERE course_id =@COURSE AND reference = @REFERENCE; ';
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			print_r($this->_db->getErrorMsg());exit;
			return false;
		}
				return true;
	}
	return false;
  }
  
  function setStatus($code = null, $reference= null, $status = null) {
	if ($status){
		if ($reference) {
			$query = 'UPDATE `#__orders` SET `status` = \''. (int) $status .'\' WHERE `#__orders`.`reference` = \'' . $reference . '\'';
		} elseif ($code) {
			$query = 'UPDATE `#__orders` SET `status` = \''. (int) $status .'\' WHERE `#__orders`.`code` = \'' . $code . '\'';
		}
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
	return false;
  }
  
  function setNotifications($url = null, $referrer = null) {
	$date =& JFactory::getDate();
	$query = 'INSERT INTO `#__notifications` ( `id` , `date` , `params` , `referrer` ) VALUES ( NULL , \''. $date->toFormat() . '\', \''.$url.'\', \''.$referrer . '\')';
	$this->_db->setQuery( $query );
	$this->_db->query();
  }
  
  }
  ?>