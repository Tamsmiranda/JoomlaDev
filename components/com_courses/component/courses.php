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


jimport('joomla.application.component.helper');
require_once(JPATH_COMPONENT.DS.'controller.php');
// Create the controller
  $controller = new coursesController();
// Perform the Request task
  $controller->execute(JRequest::getVar('task', null, 'default', 'cmd'));
// Redirect if set by the controller
  $controller->redirect();