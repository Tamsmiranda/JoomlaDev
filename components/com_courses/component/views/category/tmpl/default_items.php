<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<script language="javascript" type="text/javascript">
function tableOrdering( order, dir, task ) {
var form = document.adminForm;
 form.filter_order.value = order;
  form.filter_order_Dir.value = dir;
  document.adminForm.submit( task );
  }
</script>
<div id="category_list">
<form action="index.php?option=com_courses&view=category" method="post" name="adminForm">
	<div id="show_limit">
	<?php if ($this->params->get('show_limit', 1)): ?>
	<?php
	  echo JText::_('Display Num') .'';
	  echo $this->pagination->getLimitBox();
	  ?>
	<?php endif; ?>
	</div>
</div>
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>
<div class="catlist">
<!-- <a href="<?php //echo $category->link; ?>" class="category_title">asdasdasd</a> -->
<?php foreach ($this->items as $item) : ?>
	<div class="category_list_item">
<div class="course_title"><?php echo $item->link; ?></div>
		<div class="course_desc"><?php echo $item->description; ?></div>
		<div class="course_info">
			<ul>
				<li>
				  <spam><strong><?php echo JText::_('Investimento');?>:</strong></spam>
<spam>R$ </spam><?php echo number_format($item->price, 2, '.', ''); ?></li>
				<li><spam><strong><?php echo JText::_('Este curso foi acessado');?>:</strong></spam>
					<?php switch($item->hits) {
							case 0:
									echo JText::_('nunca');
									break;
							case 1:
									echo $item->hits.' '.JText::_('vez');
									break;
							default:
									echo $item->hits.' '.JText::_('vezes');
									break;
						}
					?>
				</li>
			<ul>
			<?php 
				//$StrItemid = '';
				//$Itemid = JRequest::getVar('Itemid',null);
				//if ($Itemid) {
			//		$StrItemid = '&Itemid='.$Itemid;
				//}
			?>
			
		</div>
	</div>
<?php endforeach;?>
</div>
