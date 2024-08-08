<?php if (count($errors) > 0) : ?>
	<div class="text-danger text-center fs-6">
		<?php foreach ($errors as $error) : ?>
			<p><strong><?php echo $error ?></strong></p>
		<?php endforeach ?>
	</div>
<?php endif ?>