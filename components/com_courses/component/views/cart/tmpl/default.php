<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
	$Itemid = JRequest::getVar('Itemid', null);
	$location = 'index.php?option=com_courses';
	if ($Itemid) {
		$Itemid = '&Itemid='.$Itemid;
	} else {
		$Itemid = '';
	}
  ?>
<div class="componentheading verde">Carrinho de Compras</div>
<?php if (!empty($this->courses)): ?>
 <table width="685" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th align="left"  COLSPAN="2" style="padding:10px; border-bottom:2px solid #E4E4E4; color:#476000 !important"><?php echo JText::_('Curso');?></th>
			
			<th width="140" align="left" style="width:120px; padding:10px; border-bottom:2px solid #E4E4E4; color:#476000 !important"><?php echo JText::_('Preço');?></th>
		</tr>
	</thead>
	<?php $order_total =0;?>
	<tbody>
	<?php foreach($this->courses as $course): ?>
	<tr>
		<td width="71" align="left" style="width:10px; border-bottom:1px dotted #CCC; padding:10px"><input type="image" src="http://www.h8si.com.br/clientes/master/images/excluir.png" onclick="location.href='index.php?option=com_courses&view=cart&task=cart&action=remove&course=<?php echo $course->id;?>'" /></td>
		<td width="474" align="left" style="border-bottom:1px dotted #CCC; padding:10px"><?php echo $course->title;?></td>
		<td align="left"  style="border-bottom:1px dotted #CCC; padding:10px"><spam>R$</spam><?php echo number_format($course->price, 2, '.', '');?></td>
	</tr>
	<?php $order_total += $course->price;?>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<button onClick="location.href='<?php echo $location . '&view=cart&task=cart&action=clear&course=' . $course->id . $Itemid;?>'"><?php echo JText::_('Esvaziar carrinho');?></button>
				<button onClick="location.href='<?php echo $location . $Itemid;?>'"><?php echo JText::_('Continuar comprando');?></button>
			</td>
			<td>
				<button class="btCheckout" onClick="location.href='index.php?option=com_courses&view=cart&task=cart&action=checkout&course=<?php echo $course->id.$Itemid;?>'"><?php echo JText::_('Finalizar');?></button>
			</td>
			<td><spam><?php echo JText::_('Total');?></spam>:<spam>R$</spam><?php echo number_format($order_total, 2, '.', '');?></td>
		</tr>
	</tfoot>
 </table>
 <?php else : ?>
	<div class="empty">
		<p class="msgInfo"><?php echo JText::_('Carrinho vazio');?></p>
	</div>
 <?php endif;?>