<?php 

/**
 * Joomla! 1.5 component videos
 * Code generated by : Danny's Joomla! 1.5 MVC Component Code Generator
 * http://www.joomlafreak.be
 * date generated:  
 * @version 0.8
 * @author Danny Buytaert 
 * @package com_videos
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.controller' );
  require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );
  /**
  * Videos Controller
  *
  * @package Videos
  */
  class CoursesControllerVideos extends JController
  {
  function __construct()
  {
  parent::__construct();
 // Register Extra tasks
  $this->registerTask( 'add', 'display' );
  $this->registerTask( 'edit', 'display' );
  }
	function display( ) {
		switch($this->getTask())
		{
			case 'add' :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form' );
				JRequest::setVar( 'view' , 'video');
				JRequest::setVar( 'edit', false );
				// Checkout the video
				$model = $this->getModel('video');
				$model->checkout();
			} break;
			case 'edit' :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form' );
				JRequest::setVar( 'view' , 'video');
				JRequest::setVar( 'edit', true );
				// Checkout the video
				$model = $this->getModel('video');
				$model->checkout();
			} break;
		   case '' :
			{
				//JRequest::setVar( 'hidemainmenu', 1 );
				//JRequest::setVar( 'layout', 'form' );
				JRequest::setVar( 'view' , 'videos');
				JRequest::setVar( 'edit', true );
				// Checkout the video
				$model = $this->getModel('video');
				$model->checkout();
			} break;
		}
		parent::display();
	}
 function store()
  {
  $post = JRequest::get('post');
  $cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
  $post['id'] = (int)$cid[0];
  $this->id = $post['id'] ;
  //$post['text'] = JRequest::getVar('text', '', 'post', 'string', JREQUEST_ALLOWRAW);
 $model = $this->getModel('video');
 if ($model->store($post)) {
  $this->msg = JText::_( 'video Saved' );
  } else {
  $this->msg = JText::_( 'Error Saving video' );
  }
 // Check the table in so it can be edited.... we are done with it anyway
  $model->checkin();
  }
 function save()
  {
  $this->store() ;
  $link = 'index.php?option=com_courses&controller=videos';
  $this->setRedirect( $link, $this->msg);
  }
 function apply()
  {
  $this->store() ;
  $link = 'index.php?option=com_courses&controller=videos&view=video&task=edit&cid[]=' . $this->id ;
  $this->setRedirect($link, $this->msg);
  }
 function remove()
  {
  $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
  JArrayHelper::toInteger($cid);
 if (count( $cid ) < 1) {
  JError::raiseError(500, JText::_( 'Select an video to delete' ) );
  }
 $model = $this->getModel('video');
  if(!$model->delete($cid)) {
  echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>
";
  }
 $this->setRedirect( 'index.php?option=com_courses&controller=videos' );
  }

 function publish()
  {
  $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
  JArrayHelper::toInteger($cid);
 if (count( $cid ) < 1) {
  JError::raiseError(500, JText::_( 'Select an video to publish' ) );
  }
 $model = $this->getModel('video');
  if(!$model->publish($cid, 1)) {
  echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>
";
  }
 $this->setRedirect( 'index.php?option=com_courses&controller=videos' );
  }

 function unpublish()
  {
  $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
  JArrayHelper::toInteger($cid);
 if (count( $cid ) < 1) {
  JError::raiseError(500, JText::_( 'Select an video to unpublish' ) );
  }
 $model = $this->getModel('video');
  if(!$model->publish($cid, 0)) {
 echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>
";
  }
 $this->setRedirect( 'index.php?option=com_courses&controller=videos' );
  }
 function cancel()
  {
  // Checkin the video
  $model = $this->getModel('video');
  $model->checkin();
 $this->setRedirect( 'index.php?option=com_courses&controller=videos' );
  }

 function orderup()
  {
  $model = $this->getModel('video');
  $model->move(-1);
 $this->setRedirect( 'index.php?option=com_courses&controller=videos');
  }
 function orderdown()
  {
  $model = $this->getModel('video');
  $model->move(1);
 $this->setRedirect( 'index.php?option=com_courses&controller=videos');
  }
 function saveorder()
  {
  $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
  $order = JRequest::getVar( 'order', array(), 'post', 'array' );
  JArrayHelper::toInteger($cid);
  JArrayHelper::toInteger($order);
 $model = $this->getModel('video');
  $model->saveorder($cid, $order);
 $msg = 'New ordering saved';
  $this->setRedirect( 'index.php?option=com_courses&controller=videos', $msg );
  }
  }
  