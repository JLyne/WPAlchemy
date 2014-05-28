<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">
	<label>Standard field</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Grouped field</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Media access</label>
    <p>
		<?php $mb->the_field('mediaccess'); ?>
	    <?php $wpalchemy_media_access->setGroupName('mediaccess')->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
    </p>

	<h2>have_fields 3 item group</h2>
	<?php while($metabox->have_fields('fixed-group', 3)): ?>
	<?php $metabox->the_group_open(); ?>
	<p>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
	<?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>

	<h2>have_fields 3 item group with child fields</h2>
	<?php while($metabox->have_fields('fixed-group-children', 3)): ?>
	<?php $metabox->the_group_open(); ?>
	<label>Standard field</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Grouped field</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Media access</label>
    <p>
		<?php $mb->the_field('mediaccess'); ?>
	    <?php $wpalchemy_media_access->setGroupName('mediaccess')->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
    </p>
    <?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>

	<h2>have_fields_and_multi group</h2>
	<?php while($metabox->have_fields_and_multi('multi-group', array('length' => 1))): ?>
	<?php $metabox->the_group_open(); ?>
	<p>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
		<?=$mb->get_the_delete_button(null, 'Remove field', array('data-test' => 'test'))?>
	</p>
	<?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?=$mb->get_the_copy_button('multi-group', 'Add new field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('multi-group', 'Remove all fields', array('data-test' => 'test'))?>

	<h2>have_fields_and_multi group with child fields</h2>
	<?php while($metabox->have_fields_and_multi('multi-group-children', array('length' => 3))): ?>
	<?php $metabox->the_group_open(); ?>
	<label>Standard field</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Grouped field</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Media access</label>
    <p>
		<?php $mb->the_field('mediaccess'); ?>
	    <?php $wpalchemy_media_access->setGroupName('mediaccess')->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
    </p>

    <h2>nested have_fields_and_multi group with child fields</h2>
	<?php while($metabox->have_fields_and_multi('nested-multi-group-children', array('length' => 1, 'limit' => 5))): ?>
	<?php $metabox->the_group_open(); ?>
	<label>Standard field</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Grouped field</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Media access</label>
    <p>
		<?php $mb->the_field('mediaccess'); ?>
	    <?php $wpalchemy_media_access->setGroupName('mediaccess')->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
    </p>
	<?=$mb->get_the_delete_button(null, 'Remove nested field', array('data-test' => 'test'))?>
    <?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?=$mb->get_the_copy_button('nested-multi-group-children', 'Add new nested field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('nested-multi-group-children', 'Remove all nested fields', array('data-test' => 'test'))?>

	<?=$mb->get_the_delete_button(null, 'Remove field', array('data-test' => 'test'))?>
    <?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?=$mb->get_the_copy_button('multi-group-children', 'Add new field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('multi-group-children', 'Remove all fields', array('data-test' => 'test'))?>

	<h2>have_fields wp_editor</h2>
	<?php while($metabox->have_fields_and_multi('wp-editor-group')): ?>
	<?php $metabox->the_group_open(); ?>
	<p>
		<?= $mb->get_the_wp_editor($mb->get_the_value(), 'test'); ?>
	</p>
	<?= $mb->get_the_delete_button('wp-editor-group', 'Remove all wp editor') ?>
	<?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?= $mb->get_the_copy_button('wp-editor-group', 'Add new wp editor') ?>
</div>