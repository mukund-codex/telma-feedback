<?php echo form_open("$controller/modify",array('class'=>'save-form')); ?>
<input type="hidden" name="division_id" value="<?php echo $info[0]['division_id']; ?>" />

<div class="form-group">
    <div class="form-line">
        <input type="text" id="division_name" name="division_name"  value="<?php echo $info[0]['division_name']; ?>" class="form-control" autocomplete="off" placeholder="Division Name">
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        <input type="text" id="sender_id" name="sender_id" value="<?php echo $info[0]['sender_id']; ?>" class="form-control" autocomplete="off" placeholder="Sender Id." maxlength="6">
    </div>
</div>

<button type="submit" class="btn btn-primary m-t-15 waves-effect">
    <i class="material-icons">save</i>
    <span>Save</span>
</button>

<a href="<?php echo base_url("$controller/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">
    <i class="material-icons">reply_all</i>	
    <span>Cancel</span>
</a>
<?php echo form_close(); ?>