<?php $i = 1; if(sizeof($collection)) : foreach ($collection as $record) { ?>
<tr>
    <td><?php echo $record['division_name'] ?></td> 
    <td><?php echo $record['name'] ?></td>  
    <td><?php echo $record['mobile'] ?></td>  
    <td><?php if($record['question1']=='1' || $record['question1']=='2'){ echo "Terrible"; }
    else if($record['question1']=='3' || $record['question1']=='4'){ echo "Bad"; } 
    else if($record['question1']=='5' || $record['question1']=='6'){ echo "Okay"; }
    else if($record['question1']=='7' || $record['question1']=='8'){ echo "Good"; }else{ echo "Great"; } ?></td>  
    <td><?php if($record['question2'] =='1'){ echo "Terrible"; }
    else if($record['question2'] =='2'){ echo "Bad"; }
    else if($record['question2'] =='3'){ echo "Okay"; }
    else if($record['question2'] =='4'){ echo "Good"; }
    else if($record['question2'] =='5'){ echo "Great"; } ?></td>   
    <td><?php if($record['question3']== 'Y') { echo 'Yes'; }else{ echo 'No'; } ?></td>
    <td><?php echo $record['email_id'] ?></td>   
    <td><?php echo $record['insert_dt'] ?></td>    
</tr>
<?php $i++;  } ?>

<?php else: ?>
    <tr><td colspan="<?= count($columns)  ?>"><center><i>No Record Found</i></center></td><tr>
<?php endif; ?>
<tr>
    <td colspan="<?= count($columns) ?>"><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>