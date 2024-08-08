<?php if (count($messages) > 0) : ?>
	<div class="text-info text-center fs-5">
		<?php foreach ($messages as $message) : ?>
			<p><?php echo $message ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>