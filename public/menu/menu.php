<?php $parent = isset($category['children']); ?>
<li>
	<a href="category/<?=$category['alias'];?>"><?=$category['title'];?></a>
	<?php if(isset($category['children'])): ?>
		<ul>
			<?= $this->getMenuHtml($category['children']);?>
		</ul>
	<?php endif; ?>
</li>