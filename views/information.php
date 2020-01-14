<form action="<?php $action ?>" method="post">
	<input type="hidden" name="form_state" value="<?php echo $form_state ?>">
	<?php if (isset($hidden_datas)) echo createHiddenInputs($hidden_datas) ?>
	<?php echo $message ?>
	<button type="submit" name="btn_ok" value="ok">OK</button>
</form>
