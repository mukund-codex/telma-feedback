<?php $i = 1; if(sizeof($collection)) : foreach ($collection as $record) { $id = $record['sms_data_id']; ?>
<tr>
	<td>
		<input type="checkbox" name="ids[]" value="<?php echo $id ?>" id="check_<?= $id ?>" class=" filled-in" />
		<label for="check_<?= $id ?>"></label>
	</td>
	<td><?php echo $record['division_name'] ?></td>
	<td><?php echo $record['title'] ?></td>
	<td><?php echo $record['article_link'];  ?></td>
	<td><?php echo $record['message'] ?></td>
	<td><?php echo $record['sms_date_time'] ?></td>
	<td><?php echo $record['sms_sts'] ?></td>
	<td><?php echo $record['insert_dt'] ?></td>
</tr>
<?php $i++;  } ?>

<?php else: ?>
	<tr><td colspan="<?= (count($columns) + 2) ?>"><center><i>No Record Found</i></center></td><tr>
<?php endif; ?>
<tr>
	<td colspan="<?= (count($columns) + 2) ?>"><?php //echo $this->ajax_pagination->create_links(); ?></td>
</tr>