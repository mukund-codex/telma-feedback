<?php echo form_open("doctor/save",array('class'=>'save-form')); ?>
<label class="form-label">Doctor Name<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="name" name="name" class="form-control" autocomplete="off" placeholder="Doctor Name">
    </div>
</div>

<label class="form-label">Doctor Mobile No.<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="tel" id="mobile" name="mobile" class="form-control" autocomplete="off" placeholder="Doctor Mobile No." maxlength="10">
    </div>
</div>

<label for="division">Division <span class="required">*</span></label>
<div class="form-group">
    <div class="form-group">
        <select name="division_id" class="form-control" data-placeholder="Select Division" id="division_id">
            <option value="">Select Division</option>
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary m-t-15 waves-effect">
    <i class="material-icons">save</i>
    <span>Save</span>
</button>

<a href="<?php echo base_url("doctor/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">
    <i class="material-icons">reply_all</i>	
    <span>Cancel</span>
</a>
<?php echo form_close(); ?>

<?php echo $this->load->view('template/popup/popup-box') ?>