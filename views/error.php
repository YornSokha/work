<form action="<?php echo $action ?>" method="post">
    <input type="hidden" name="form_state" value="<?php echo $form_state ?>">
    <?php if (isset($hidden_datas)) echo createHiddenInputs($hidden_datas) ?>
    <?php echo $errors ?>
    <button type="submit" name="btn_return" value="return">Return</button>
</form>
