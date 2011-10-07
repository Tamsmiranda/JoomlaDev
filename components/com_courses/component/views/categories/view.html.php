<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );



jimport('joomla.application.component.view');
/**
  * HTML View class for the courses component
  * @package Courses
  */
  class CoursesViewCategories extends JView
  {
function display( $tpl = null)
{
global $mainframe;
 $document =& JFactory::getDocument();
 $categories =& $this->get('data');
  $total =& $this->get('total');
  $state =& $this->get('state');
  $Itemid = JRequest::getVar('Itemid',null);
  if ($Itemid) {
	$Itemid = '&Itemid=' . $Itemid;
  }
 // Get the page/component configuration
  $params = &$mainframe->getParams();
 $menus = &JSite::getMenu();
  $menu = $menus->getActive();
 // because the application sets a default page title, we need to get it
  // right from the menu item itself
  if (is_object( $menu )) {
  $menu_params = new JParameter( $menu->params );
  if (!$menu_params->get( 'page_title')) {
  $params->set('page_title', JText::_( 'COURSES' ));
  }
  } else {
  $params->set('page_title', JText::_( 'COURSES' ));
  }
 $document->setTitle( $params->get( 'page_title' ) );
 // Set some defaults if not set for params
  $params->def('comp_description', JText::_('COURSES_DESC'));
 // Define image tag attributes
  if ($params->get('image') != -1)
  {
  if($params->get('image_align')!="")
  $attribs['align'] = $params->get('image_align');
  else
  $attribs['align'] = '';
  $attribs['hspace'] = 6;
 // Use the static HTML library to build the image tag
  $image = JHTML::_('image', 'images/stories/'.$params->get('image'), JText::_('COURSES'), $attribs);
  }
 for($i = 0; $i < count($categories); $i++)
  {
  $category =& $categories[$i];
  $category->link = JRoute::_('index.php?option=com_courses&view=category&id='. $category->slug);
 // Prepare category description
  $category->description = JHTML::_('content.prepare', $category->description);
  }
  $this->assignRef('Itemid', $Itemid);
 $this->assignRef('image', $image);
  $this->assignRef('params', $params);
  $this->assignRef('categories', $categories);
 parent::display($tpl);
  }
  }
  ?>