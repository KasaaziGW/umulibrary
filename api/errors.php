<?php if (count($errors) > 0) : ?>
	<div class="text-danger text-center fs-5">
		<?php foreach ($errors as $error) : ?>
			<p><?= $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>