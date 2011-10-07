<?php 

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
  * Courses Component Item Model
  * @package Courses
  */
  class CoursesModelItem extends JModel
  {
  /**
  * Item id
  *
  * @var int
  */
  var $_id = null;
 /**
  * Item data
  *
  * @var array
  */
  var $_data = null;
 /**
  * Constructor
  *
  * @since 1.5
  */
  function __construct()
  {
  parent::__construct();
 $id = JRequest::getVar('id', 0, '', 'int');
  $this->setId((int)$id);
  }
 /**
  * Method to set the item identifier
  *
  * @access public
  * @param int Item identifier
  */
  function setId($id)
  {
  // Set item id and wipe data
  $this->_id = $id;
  $this->_data = null;
  }
 /**
  * Method to get a item
  *
  * @since 1.5
  */
  function &getData()
  {
  // Load the item data
  if ($this->_loadData())
  {
  // Initialize some variables
  $user = &JFactory::getUser();
 // Make sure the item is published
  if (!$this->_data->published) {
  JError::raiseError(404, JText::_("Resource Not Found"));
  return false;
  }
 // Check to see if the category is published
  if (!$this->_data->cat_pub) {
  JError::raiseError( 404, JText::_("Resource Not Found") );
  return;
  }
 // Check whether category access level allows access
  if ($this->_data->cat_access > $user->get('aid', 0)) {
  JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
  return;
  }
  }
  //else $this->_initData();
 return $this->_data;
  }
  
/**
* Method to increment the hit counter for the item
*
* @access public
* @return boolean True on success
* @since 1.5
*/
function hit()
{
global $mainframe;

 if ($this->_id)
  {
  $item = & $this->getTable();
  $item->hit($this->_id);
  return true;
  }
  return false;
  }
 
 /**
  * Method to load content item data
  *
  * @access private
  * @return boolean True on success
  */
  function _loadData()
  {
  // Lets load the content if it doesn't already exist
  if (empty($this->_data))
  {
  $query = 'SELECT w.*, cc.title AS category, ' .
  ' cc.published AS cat_pub, cc.access AS cat_access'.
  ' FROM #__courses AS w' .
  ' LEFT JOIN #__categories AS cc ON cc.id = w.catid' .
  ' WHERE w.id = '. (int) $this->_id;
  $this->_db->setQuery($query);
  $this->_data = $this->_db->loadObject();
  return (boolean) $this->_data;
  }
  return true;
  }
  
  function getCourseUserOrder()
    {
        // get a reference to the database
		if ($this->_id) {
			$user =& JFactory::getUser();
			$query = 'SELECT #__courses.title, #__orders.status FROM #__courses LEFT JOIN #__courses_orders ON #__courses_orders.course_id = #__courses.id RIGHT ' . 
			'JOIN #__orders ON #__courses_orders.reference = #__orders.reference WHERE #__orders.status In (1, 2, 3, 4) And #__orders.user_id = ' . (int) $user->id . ' AND #__courses.id = ' . (int) $this->_id . ' LIMIT 1';
			$this->_db->setQuery($query);
			$course = ($course = $this->_db->loadObjectList())?$course:array(); 
			return $course;
		}
		return array();
    } 
}