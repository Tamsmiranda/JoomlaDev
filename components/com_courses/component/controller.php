<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once ( JPATH_BASE .DS.'libraries'.DS.'pagseguro'.DS.'PagSeguroLibrary.php' );
//JLoader::load('PagSeguroLibrary', JPATH_BASE .DS.'libraries'.DS.'pagseguro'.DS);
//require(JPATH_BASE .DS.'includes'.DS.'pagseguro'.DS.'PagSeguroLibrary.php');
//JLoader::import('PagSeguroLibrary', JPATH_BASE .DS.'libraries'.DS.'pagseguro'.DS);

jimport( 'joomla.application.component.controller' );
//

 /**
  * Courses Component Controller
  *
  * @package Courses
  */

  class coursesController extends JController
  {
		/**
		 * Method to show a courses view
		 */
		function display()
		{
			global $mainframe;
			//echo "<pre>";var_dump($this->getView());echo "</pre>";
			$user =& JFactory::getUser();
			switch($this->getTask()) {
				case 'cart':
						JRequest::setVar('view', 'cart' );
						JRequest::setVar( 'layout', 'cart' );
						$Itemid = JRequest::getVar( 'Itemid', null );
						$course = JRequest::getVar( 'course', null );
						$action = JRequest::getVar( 'action', 'add' );
						$session = JFactory::getSession();
						if ($Itemid) {
						$Itemid = '&Itemid='.$Itemid;
						} else {
							$Itemid = '';
						}
						$link = 'index.php?option=com_courses' . $Itemid;
							switch ($action) {
								case 'add':
										if ($course!=null) {
											$cart = $session->get('cart', array(), 'course_cart');
											foreach($cart as $key=>&$value){
												if($value==$course){
													$msg = /*JText::_(*/'Este curso já está adicionado!'/*)*/;
													//$link = 'index.php?option=com_courses';
													$this->setRedirect( $link, $msg);
												}
											}
											$cart[] = $course;
											$session->set('cart', $cart, 'course_cart');
										} else {
											$msg = JText::_('Curso incorreto!');
											//$link = 'index.php?option=com_courses';
											$this->setRedirect( $link, $msg);
										}
										break;
								case 'renew':
										if ($user->id == 0) {
											JRequest::setVar('view', 'video' );
											JRequest::setVar( 'layout', 'login' );
											break;
										}
										if ($course!=null) {
											$cart = $session->get('cart', array(), 'course_cart');
											foreach($cart as $key=>&$value){
												if($value==$course){
													$msg = /*JText::_(*/'Este curso já está adicionado!'/*)*/;
													//$link = 'index.php?option=com_courses';
													$this->setRedirect( $link, $msg);
												}
											}
											$model = &$this->getModel('cart');
											$model->unsetUsersVideos($course);
											$cart[] = $course;
											$session->set('cart', $cart, 'course_cart');
										} else {
											$msg = JText::_('Curso incorreto!');
											//$link = 'index.php?option=com_courses';
											$this->setRedirect( $link, $msg);
										}
										break;
								case 'remove':
										if ($course!=null) {
											$cart = $session->get('cart', array(), 'course_cart');
											foreach($cart as $key=>&$value){
												if($value==$course){
													unset($cart[$key]);
												}
											}
											$session->set('cart', $cart, 'course_cart');
										} else {
											$msg = JText::_('Curso incorreto!');
											//$link = 'index.php?option=com_courses';
											$this->setRedirect( $link, $msg);
										}
										break;
								case 'clear':
										$session->clear('cart', 'course_cart');
										break;
								case 'checkout':
										/*
											Se usuário estiver deslogado redireciona para o login
										*/
										if ($user->id == 0) {
											JRequest::setVar('view', 'video' );
											JRequest::setVar( 'layout', 'login' );
											break;
										}
										$cart = $session->get('cart', array(), 'course_cart');
										$model = &$this->getModel('cart');
										$courses = $model->getSelection($cart);
										$reference = uniqid();
										$paymentRequest = new PaymentRequest();
										// Sets the currency
										$paymentRequest->setCurrency("BRL");
										// Add an item for this payment request
										foreach ($courses as $course) {
											$paymentRequest->addItem($course->id, $course->title, /*$course->items*/ '1',number_format($course->price, 2, '.', ''));
										}
										$Shipping = ShippingType::getCodeByType('NOT_SPECIFIED');
										$paymentRequest->setShippingType($Shipping);
										//echo "<pre>";print_r($user);exit;
										//$paymentRequest->setShippingAddress('01452002',  'Av. Brig. Faria Lima',  '1384', 'apto. 114', 'Jardim Paulistano', 'São Paulo', 'SP', 'BRA');
										
										// Sets your customer information.
										//$paymentRequest->setSender($user->name, $user->email);
										$paymentRequest->setReference($reference);
										
										//$paymentRequest->setRedirectUrl("http://www.google.com.br");
										//$paymentRequest->UrlPagSeguro = "http://localhost:9090/checkout/checkout.jhtml";
										//print_r($paymentRequest);exit;
										
										//$order = $model->addOrder($transactionCode,$transaction->getStatus()->getValue());
											//$model->setSelection($transactionCode, $cart);
										$model->addOrder(null, null, $reference);
										$model->setUsersVideos($cart,$reference);
										$model->setSelection($transactionCode, $reference, $cart);
										try {
			
											/*
											* #### Crendencials ##### 
											* Substitute the parameters below with your credentials (e-mail and token)
											* You can also get your credentails from a config file. See an example:
											* $credentials = PagSeguroConfig::getAccountCredentials();
											*/			
											$credentials = new AccountCredentials("pagseguro@masterjuris.com.br", "213D83DB03CE44278D4E56D6C0E0D948");
											
											// Register this payment request in PagSeguro, to obtain the payment URL for redirect your customer.
											$url = $paymentRequest->register($credentials);
											header("location:$url");
											//self::printPaymentUrl($url);
											
										} catch (PagSeguroServiceException $e) {
											//die($e->getMessage());
											$msg = JText::_($e->getMessage());
											//$link = 'index.php?option=com_courses';
											$this->setRedirect( $link, $msg);
										}
										break;
								case 'notification':
										JRequest::setVar( 'layout', 'notification' );
										$notificationCode = JRequest::getVar( 'notificationCode', null );
										$transactionCode = JRequest::getVar( 'transactionCode', null );
										$type = JRequest::getVar( 'notificationType', 'transaction' );
										$model = &$this->getModel('cart');
										$params = print_r(array('GET'=>$_GET,'POST'=>$_POST),true);
										$model->setNotifications($params,$_SERVER["HTTP_referer"]);
										if ( $notificationCode && $type ) {
											$notificationType = new NotificationType($type);
											$strType = $notificationType->getTypeFromValue();
											switch($strType) {
												case 'TRANSACTION':
													$credentials = new AccountCredentials("pagseguro@masterjuris.com.br", "213D83DB03CE44278D4E56D6C0E0D948");
													try {
														$transaction = NotificationService::checkTransaction($credentials, $notificationCode);
														$model->setStatus(null, $transaction.getReference(), $transaction->getStatus()->getValue());
													} catch (PagSeguroServiceException $e) {
														$msg = $e->getMessage();
														//$link = 'index.php?option=com_courses';
														$this->setRedirect( $link, $msg);
													}
													break;
												
												default:
													$msg = JText::_('Unknown notification type [') . $notificationType->getValue() . "]";
													//$link = 'index.php?option=com_courses';
													$this->setRedirect( $link, $msg);
													break;
											}
										} elseif ($transactionCode) {
											//Atualizar #__courses_orders
											//Atualizar #__orders.status
											$credentials = new AccountCredentials("pagseguro@masterjuris.com.br", "213D83DB03CE44278D4E56D6C0E0D948");
											try {
												$transaction = TransactionSearchService::searchByCode($credentials, $transactionCode);
												$cart = $session->get('cart', array(), 'course_cart');
												$model = &$this->getModel('cart');
												$model->setStatus(null, $transaction->getReference(), $transaction->getStatus()->getValue());
												switch ($transaction->getStatus()->getValue()) {
													/* Aguardando Pagamento */
													case '1':
															//break;
													/* Em Análise */
													case '2':
															$session->clear('cart', 'course_cart');
															break;
													/* Paga */
													case '3':
															break;
													/* Disponível */
													case '4':
															break;
													/* Em Disputa */
													case '5':
															break;
													/* Devolvida */
													case '6':
															break;
													/* Cancelada */
													case '7':
															break;
													default :
															break;
												}
											} catch (PagSeguroServiceException $e) {
												$msg = $e->getMessage();
												//$link = 'index.php?option=com_courses';
												$this->setRedirect( $link, $msg);
											}											
										} else {
											$msg = JText::_('Parâmetros de notificação inválidos');
											//$link = 'index.php?option=com_courses';
											$this->setRedirect( $link, $msg);
										}
										break;
								default:
										break;
							}
						break;
				
				default:
				 // Set a default view if none exists
				 if ( ! JRequest::getCmd( 'view' ) ) {
						JRequest::setVar('view', 'categories' );
				 }
				 //update the hit count for the item
				 if(JRequest::getCmd('view') == 'item')
				 {
					$model =& $this->getModel('item');
					$model->hit();
				 }
				 // Error messages
				 if(JRequest::getCmd('view') == 'video')
				 {
						$model =& $this->getModel('video');
						$access = $model->access();
						//if ($user->id == 0) {
						// Gambiarra
						$video_id = JRequest::getVar( 'cid', null );
						if ($user->id == 0 && $video_id[0]!=63) {
							JRequest::setVar( 'layout', 'login' );
						} else {
						if ($access) {
							switch ($access) {
								/* Aguardando Pagamento */
								case '1':
										JRequest::setVar( 'layout', 'aguardandopgt' );
										break;
								/* Em Análise */
								case '2':
										JRequest::setVar( 'layout', 'emanalise' );
										break;
								/* Paga */
								case '3':
										JRequest::setVar( 'layout', 'default' );
										break;
								/* Disponível */
								case '4':
										JRequest::setVar( 'layout', 'default' );
										break;
								/* Em Disputa */
								case '5':
										JRequest::setVar( 'layout', 'emdisputa' );
										break;
								/* Devolvida */
								case '6':
										JRequest::setVar( 'layout', 'devolvida' );
										break;
								/* Cancelada */
								case '7':
										JRequest::setVar( 'layout', 'cancelado' );
										break;
								/* Área Restrita */
								case '8':
										// Gambiarra
										//JRequest::setVar( 'layout', 'login' );
										if ($video_id[0]!=63) {
											JRequest::setVar( 'layout', 'login' );
										}
										break;
								/* Número máximo de visualizações */
								case '9':
										JRequest::setVar( 'layout', 'maxview' );
										break;
								/* Período de visualizações expirado */
								case '10':
										JRequest::setVar( 'layout', 'expirado' );
										break;
								case '11':
										JRequest::setVar( 'layout', 'indisponivel' );
										break;
								default :
										break;
							}
						} else {
								$model->hit();
						}
						}
				 }
				 break;
			}
 		parent::display();
  		}
  }