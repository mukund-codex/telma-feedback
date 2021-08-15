<?php echo form_open("$controller/modify",array('class'=>'save-form')); ?>
<input type="hidden" name="id" value="<?php echo $info[0]['id']; ?>" />

<label class="form-label">Name<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="name" name="name" value="<?php echo $info[0]['fullname']; ?>" class="form-control" autocomplete="off" placeholder="Name">
    </div>
</div>

<label class="form-label">Designation<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="designation" value="<?php echo $info[0]['designation']; ?>" name="designation" class="form-control" autocomplete="off" placeholder="Designation">
    </div>
</div>

<label class="form-label">Organisation<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="organisation" value="<?php echo $info[0]['organisation']; ?>" name="organisation" class="form-control" autocomplete="off" placeholder="Organisation">
    </div>
</div>

<label class="form-label">Profession<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <select name="profession_id" class="form-control" data-placeholder="Select Profession" id="profession_id">
        <option value="<?php echo $info[0]['profession_id']; ?>" selected="selected"><?php echo $info[0]['profession_name']; ?></option>
        </select>
    </div>
</div>

<label class="form-label">Email ID<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="email" value="<?php echo $info[0]['email']; ?>" name="email" class="form-control" autocomplete="off" placeholder="Email ID">
    </div>
</div>

<label class="form-label">User Type<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <select name="user_type" class="form-control" data-placeholder="Select Profession" id="user_type">
            <option value="job_seeker" <?php if($info[0]['user_type']=="job_seeker") echo 'selected="selected"'; ?>>Job Seeker</option>
            <option value="job_provider" <?php if($info[0]['user_type']=="job_provider") echo 'selected="selected"'; ?>>Job Provider</option>
        </select>
    </div>
</div>

<label class="form-label">User Name<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="username" value="<?php echo $info[0]['username']; ?>" name="username" class="form-control" autocomplete="off" placeholder="User Name">
    </div>
</div>

<label class="form-label">Password<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="password" value="<?php echo $info[0]['password']; ?>" name="password" class="form-control" autocomplete="off" placeholder="Password">
    </div>
</div>

<label class="form-label">Referral Code<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="referral_code" value="<?php echo $info[0]['referral_code']; ?>" name="referral_code" class="form-control" autocomplete="off" placeholder="Referral Code">
    </div>
</div>

<label class="form-label">Date of Birth<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="dob" name="dob" value="<?php echo $info[0]['dob']; ?>" class="form-control" autocomplete="off" placeholder="Date OF Birth">
    </div>
</div>

<label class="form-label">Gender<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="gender" name="gender" value="<?php echo $info[0]['gender']; ?>" class="form-control" autocomplete="off" placeholder="Gender">
    </div>
</div>

<label class="form-label">Number<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="number" name="number" value="<?php echo $info[0]['number']; ?>" class="form-control" autocomplete="off" placeholder="Number">
    </div>
</div>

<label class="form-label">Address<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="address" name="address" value="<?php echo $info[0]['address']; ?>" class="form-control" autocomplete="off" placeholder="Address">
    </div>
</div>

<label class="form-label">State<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <select name="state_id" class="form-control" data-placeholder="Select State" id="state_id">
        <option value="<?php echo $info[0]['state_id']; ?>" selected="selected"><?php echo $info[0]['state_name']; ?></option>
        </select>
    </div>
</div>

<label class="form-label">City<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <select name="city_id" class="form-control" data-placeholder="Select City" id="city_id">
        <option value="<?php echo $info[0]['city_id']; ?>" selected="selected"><?php echo $info[0]['city_name']; ?></option>
        </select>
    </div>
</div>

<label class="form-label">Professions<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="professions" name="professions" value="<?php echo $info[0]['professions']; ?>" class="form-control" autocomplete="off" placeholder="Professions">
    </div>
</div>

<label class="form-label">Need to check what is this user type is in data base<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <select name="user_type" class="form-control" data-placeholder="Select Profession" id="user_type">
        <option value="job_seeker" <?php if($info[0]['user_type']=="job_seeker") echo 'selected="selected"'; ?>>Job Seeker</option>
            <option value="job_provider" <?php if($info[0]['user_type']=="job_provider") echo 'selected="selected"'; ?>>Job Provider</option>
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