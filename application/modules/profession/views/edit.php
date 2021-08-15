<?php echo form_open("$controller/modify",array('class'=>'save-form')); ?>
<input type="hidden" name="id" value="<?php echo $info[0]['id']; ?>" />

<label class="form-label">Profession Name<span class="required">*</span></label>

<div class="form-group">
    <div class="form-line">
        <input type="text" id="name" name="name"  value="<?php echo $info[0]['name']; ?>" class="form-control" autocomplete="off" placeholder="Profession Name">
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