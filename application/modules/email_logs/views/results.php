<?php $i = 1; if(sizeof($collection)) : foreach ($collection as $record) { $id = $record['id']; ?>
<tr>
	<td><?php echo $record['name'] ?></td>
	<td><?php echo $record['doctor_email'] ?></td>
	<td><?php echo $record['subject'] ?></td>
	<td><?php echo wordwrap($record['content'], '30', '<br>\n') ?></td>
	<td><?php echo ($record['is_success'] == 0) ? 'Failed' : 'Success'; ?> </td>
	<td><?php echo $record['insert_dt']; ?></td>
</tr>
<?php $i++;  } ?>

<?php else: ?>
	<tr><td colspan="<?= (count($columns) + 2) ?>"><center><i>No Record Found</i></center></td><tr>
<?php endif; ?>
<tr>
	<td colspan="<?= (count($columns) + 2) ?>"><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>