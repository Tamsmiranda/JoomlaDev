<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$cparams =& JComponentHelper::getParams('com_media');


?>
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?> verde">
<?php echo $this->escape($this->params->get('page_title')); ?>
</div>
<?php endif; ?>
<?php if ( ($this->params->def('image', -1) != -1) || $this->params->def('show_comp_description', 1) ) : ?>
<?php endif; ?>
<div class="categories">
<!-- <ul> -->
<?php foreach ( $this->categories as $category ) : ?>
<div class="categoryTitle">
	<div><a href="<?php echo $category->link.$this->Itemid; ?>" class="category_title"><?php echo $category->title;?></a>
	</div>

	<div class="textoCourses">
<?php echo $category->description;?>
	</div>
<!-- <a href="<?php //echo $category->link; ?>" class="category<?php //echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php //echo $this->escape($category->title);?></a> -->
<div class="contagem">
<strong><?php echo JText::_('Total de cursos');?>:</strong> <span class="small"><?php echo $category->numlinks;?></span>
</div>
<!-- </li> -->
</div>
<?php endforeach; ?>
<!-- </ul> -->
</div>
