<?php echo form_open("$controller/modify",array('class'=>'save-form')); ?>
<input type="hidden" name="doctor_id" value="<?php echo $info[0]['doctor_id']; ?>" />
<!-- <input type="hidden" name="doctor_users_id" id="doctor_users_id" class="form-control" maxlength="50" value="<?php echo $info[0]['doctor_users_id']; ?>" /> -->

<div class="form-group">
    <div class="form-line">
        <input type="text" id="name" name="name"  value="<?php echo $info[0]['name']; ?>" class="form-control" autocomplete="off" placeholder="Doctor Name">
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        <input type="text" id="mobile" name="mobile" value="<?php echo $info[0]['mobile']; ?>" class="form-control" autocomplete="off" placeholder="Doctor Mobile No." maxlength="10">
    </div>
</div>

<label for="division">Division <span class="required">*</span></label>
<div class="form-group">
    <div class="form-group">
        <select name="division_id" class="form-control" data-placeholder="Select Division" id="division_id">
            <option value="<?php echo $info[0]['division_id']; ?>" selected="selected"><?php echo $info[0]['division_name']; ?></option>
        </select>
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