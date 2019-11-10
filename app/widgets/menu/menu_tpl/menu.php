<li>
	<a href="?id=<?=$id;?>"><?=$category['title'];?></a>
	<?php if(isset($category['children'])): ?>
		<ul>
			<?=$this->getMenuHtml($category['children']);?>
		</ul>
	<?php endif; ?>
</li>