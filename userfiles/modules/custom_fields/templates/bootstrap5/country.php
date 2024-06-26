<div class="col-sm-<?php echo $settings['field_size_mobile']; ?> col-md-<?php echo $settings['field_size_tablet']; ?> col-lg-<?php echo $settings['field_size_desktop']; ?>">
    <div class="mw-text-start my-2">

        <?php if($settings['show_label']): ?>
            <label class="form-label my-3">
                <?php echo $data['name']; ?>
                <?php if ($settings['required']): ?>
                    <span style="color: red;">*</span>
                <?php endif; ?>
            </label>
        <?php endif; ?>


        <select class="form-select">
            <option><?php _e($data['placeholder']) ?></option>
            <option><?php foreach ($data['values'] as $country): ?>
            <option value="<?php echo $country ?>"><?php echo $country ?></option>
            <?php endforeach; ?></option>
        </select>


        <?php if ($data['help']): ?>
            <small class="form-text text-muted"><?php echo $data['help']; ?></small>
        <?php endif; ?>
    </div>
</div>
