<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">
	<h2>Standard inputs</h2>
	<label>Text Input</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Textarea</label>
	<p>
		<?php $metabox->the_field('textarea'); ?>
		<textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
	</p>

	<label>Select</label>
	<p>
		<?php $metabox->the_field('select'); ?>
		<select name="<?php $metabox->the_name(); ?>">
			<option value="">Nothing</option>
			<option value="one" <?php $mb->the_select_state('one') ?>>Option 1</option>
			<option value="two" <?php $mb->the_select_state('two') ?>>Option 2</option>
			<option value="three" <?php $mb->the_select_state('three') ?>>Option 3</option>
			<option value="four" <?php $mb->the_select_state('four') ?>>Option 4</option>
		</select>
	</p>

	<label>Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-1'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<?php $metabox->the_field('checkbox-2'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<?php $metabox->the_field('checkbox-3'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Grouped Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Radio Buttons</label>
	<p>
		<?php $metabox->the_field('radio-group', WPALCHEMY_FIELD_HINT_RADIO); ?>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_radio_state('1') ?>/>Radio Button 1<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_radio_state('2') ?>/>Radio Button 2<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_radio_state('3') ?>/>Radio Button 3<br/>
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
	<label>Text Input</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Textarea</label>
	<p>
		<?php $metabox->the_field('textarea'); ?>
		<textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
	</p>

	<label>Select</label>
	<p>
		<?php $metabox->the_field('select'); ?>
		<select name="<?php $metabox->the_name(); ?>">
			<option value="">Nothing</option>
			<option value="one" <?php $mb->the_select_state('one') ?>>Option 1</option>
			<option value="two" <?php $mb->the_select_state('two') ?>>Option 2</option>
			<option value="three" <?php $mb->the_select_state('three') ?>>Option 3</option>
			<option value="four" <?php $mb->the_select_state('four') ?>>Option 4</option>
		</select>
	</p>

	<label>Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-1'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<?php $metabox->the_field('checkbox-2'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<?php $metabox->the_field('checkbox-3'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Grouped Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Radio Buttons</label>
	<p>
		<?php $metabox->the_field('radio-group', WPALCHEMY_FIELD_HINT_RADIO); ?>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_radio_state('1') ?>/>Radio Button 1<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_radio_state('2') ?>/>Radio Button 2<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_radio_state('3') ?>/>Radio Button 3<br/>
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
	<?php while($metabox->have_fields_and_multi('multi-group', array('length' => 3))): ?>
	<?php $metabox->the_group_open(); ?>
	<p>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
	<?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?=$mb->get_the_copy_button('multi-group', 'Add new field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('multi-group', 'Remove all fields', array('data-test' => 'test'))?>

	<h2>have_fields_and_multi group with child fields</h2>
	<?php while($metabox->have_fields_and_multi('multi-group-children', array('length' => 3))): ?>
	<?php $metabox->the_group_open(); ?>
	<label>Text Input</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Textarea</label>
	<p>
		<?php $metabox->the_field('textarea'); ?>
		<textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
	</p>

	<label>Select</label>
	<p>
		<?php $metabox->the_field('select'); ?>
		<select name="<?php $metabox->the_name(); ?>">
			<option value="">Nothing</option>
			<option value="one" <?php $mb->the_select_state('one') ?>>Option 1</option>
			<option value="two" <?php $mb->the_select_state('two') ?>>Option 2</option>
			<option value="three" <?php $mb->the_select_state('three') ?>>Option 3</option>
			<option value="four" <?php $mb->the_select_state('four') ?>>Option 4</option>
		</select>
	</p>

	<label>Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-1'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<?php $metabox->the_field('checkbox-2'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<?php $metabox->the_field('checkbox-3'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Grouped Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Radio Buttons</label>
	<p>
		<?php $metabox->the_field('radio-group', WPALCHEMY_FIELD_HINT_RADIO); ?>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_radio_state('1') ?>/>Radio Button 1<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_radio_state('2') ?>/>Radio Button 2<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_radio_state('3') ?>/>Radio Button 3<br/>
	</p>

	<label>Media access</label>
    <p>
		<?php $mb->the_field('mediaccess'); ?>
	    <?php $wpalchemy_media_access->setGroupName('mediaccess')->setInsertButtonLabel('Insert'); ?>
        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
        <?php echo $wpalchemy_media_access->getButton(); ?>
    </p>

    <h2>nested have_fields_and_multi group with child fields</h2>
	<?php while($metabox->have_fields_and_multi('nested-multi-group-children', array('length' => 3))): ?>
	<?php $metabox->the_group_open(); ?>
	<label>Text Input</label>
	<p>
		<?php $metabox->the_field('text-input'); ?>
		<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
	</p>
 
	<label>Textarea</label>
	<p>
		<?php $metabox->the_field('textarea'); ?>
		<textarea name="<?php $metabox->the_name(); ?>" rows="3"><?php $metabox->the_value(); ?></textarea>
	</p>

	<label>Select</label>
	<p>
		<?php $metabox->the_field('select'); ?>
		<select name="<?php $metabox->the_name(); ?>">
			<option value="">Nothing</option>
			<option value="one" <?php $mb->the_select_state('one') ?>>Option 1</option>
			<option value="two" <?php $mb->the_select_state('two') ?>>Option 2</option>
			<option value="three" <?php $mb->the_select_state('three') ?>>Option 3</option>
			<option value="four" <?php $mb->the_select_state('four') ?>>Option 4</option>
		</select>
	</p>

	<label>Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-1'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<?php $metabox->the_field('checkbox-2'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<?php $metabox->the_field('checkbox-3'); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Grouped Checkboxes</label>
	<p>
		<?php $metabox->the_field('checkbox-group', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1') ?>/>Checkbox 1<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_checkbox_state('2') ?>/>Checkbox 2<br/>
		<input type="checkbox" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_checkbox_state('3') ?>/>Checkbox 3<br/>
	</p>

	<label>Radio Buttons</label>
	<p>
		<?php $metabox->the_field('radio-group', WPALCHEMY_FIELD_HINT_RADIO); ?>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="1" <?php $mb->the_radio_state('1') ?>/>Radio Button 1<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="2" <?php $mb->the_radio_state('2') ?>/>Radio Button 2<br/>
		<input type="radio" name="<?php $metabox->the_name(); ?>" value="3" <?php $mb->the_radio_state('3') ?>/>Radio Button 3<br/>
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
	<?=$mb->get_the_copy_button('nested-multi-group-children', 'Add new nested field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('nested-multi-group-children', 'Remove all nested fields', array('data-test' => 'test'))?>

    <?php $metabox->the_group_close(); ?>
	<?php endwhile; ?>
	<?=$mb->get_the_copy_button('multi-group-children', 'Add new field', array('data-test' => 'test'))?>
	<?=$mb->get_the_delete_button('multi-group-children', 'Remove all fields', array('data-test' => 'test'))?>
</div>