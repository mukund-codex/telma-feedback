<?php echo form_open_multipart("article/save",array('class'=>'save-form')); ?>
<label class="form-label">Title <span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Title">
    </div>
</div>

<label class="form-label">Description </label>
<div class="form-group">
    <div class="form-line">
        <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
    </div>
</div>

<label class="form-label">Files</label>
<div class="form-group">
    <div class="form-line">
        <input type="file" name="file" id="file" class="form-control" accept="application/pdf">
    </div>
    <span class="required">Only Upload PDF.</span>
</div>

<button type="submit" class="btn btn-primary m-t-15 waves-effect">
    <i class="material-icons">save</i>
    <span>Save</span>
</button>

<a href="<?php echo base_url("article/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">
    <i class="material-icons">reply_all</i>	
    <span>Cancel</span>
</a>
<?php echo form_close(); ?>

<?php echo $this->load->view('template/popup/popup-box') ?>