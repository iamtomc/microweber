<script type="text/javascript">
    $(document).ready(function () {
        mw.options.form('.<?php print $config['module_class'] ?>', function () {
            mw.notification.success("<?php _ejs("Saved"); ?>.");
            mw.reload_module('#<?php print $params['id'];?>');
        });
    });
</script>
<?php

$maintenance_mode = get_option('maintenance_mode', 'website');
$maintenance_mode_text = get_option('maintenance_mode_text', 'website');

?>

<div class="form-group">
    <label class="form-label d-block"><?php _e("Maintenance mode"); ?></label>
    <small class="text-muted d-block mb-2"><?php _e("Turn on Under construction mode of your site"); ?></small>

    <label class="form-check form-switch">
        <input name="maintenance_mode" class="form-check-input mw_option_field " data-option-group="website" data-value-checked="y" data-value-unchecked="n" type="checkbox" <?php if (get_option('maintenance_mode', 'website') !== "n"): ?> checked="checked" checked="checked" <?php endif; ?>>
    </label>



</div>
<?php if($maintenance_mode == 'y'){ ?>
<div class="form-group mb-t">
    <label class="form-label"><?php _e("Maintenance mode text"); ?></label>
    <textarea autocomplete="off" name="maintenance_mode_text" class="mw_option_field form-control" rows="3" type="text" option-group="website"><?php print $maintenance_mode_text ?></textarea>
</div>
<?php } ?>

