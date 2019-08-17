<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                
                <li <?php echo ($mainmenu == 'dashboard') ? 'class="active"': ''; ?>>
                    <a href="<?php echo base_url('dashboard/admin') ?>">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>

                <?php if($role == 'SA'): ?>
                    <li <?php echo ($mainmenu == 'admin') ? 'class="active"': ''; ?>>
                        <a href="<?php echo base_url("admin/lists?t=$timestamp") ?>">
                            <i class="material-icons">assignment_ind</i>
                            <span>Admins</span>
                        </a>
                    </li>

                    <li <?php echo (in_array($menu, ['basic'])) ? 'class="active"': ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings_applications</i>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo (isset($menu) && $menu == 'basic') ? 'class="active"': ''; ?>>
                                <a href="<?php echo base_url("settings/basic?t=$timestamp") ?>">Basic Settings</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li <?php echo ($mainmenu == 'divisions') ? 'class="active"': ''; ?>>
                    <a href="<?php echo base_url("divisions/lists?t=$timestamp") ?>">
                        <i class="material-icons">assignment_ind</i>
                        <span>Divisions</span>
                    </a>
                </li>

                <li <?php echo ($mainmenu == 'doctor') ? 'class="active"': ''; ?>>
                    <a href="<?php echo base_url("doctor/lists?t=$timestamp") ?>">
                        <i class="material-icons">assignment_ind</i>
                        <span>Doctor</span>
                    </a>
                </li>

                <li <?php echo ($mainmenu == 'sms') ? 'class="active"': ''; ?>>
                    <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">receipt</i>
                        <span>Logs</span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php echo ($menu == 'scheduledsms') ? 'class="active"': ''; ?>>
                            <a href="<?php echo base_url("scheduledsms/lists?t=$timestamp") ?>">Scheduled SMS Log</a>
                        </li>

                        <li <?php echo ($menu == 'pdf_download_log') ? 'class="active"': ''; ?>>
                            <a href="<?php echo base_url("reports/view/type/pdf_download_log") ?>">PDF Download Count Log</a>
                        </li>

                        <li <?php echo ($menu == 'sms_list') ? 'class="active"': ''; ?>>
                            <a href="<?php echo base_url("sms/lists?t=$timestamp") ?>">SMS Log</a>
                        </li>
                        <li <?php echo ($menu == 'unsub_list') ? 'class="active"': ''; ?>>
                            <a href="<?php echo base_url("unsubscribe/lists?t=$timestamp") ?>">Unsubscribe Log</a>
                        </li>
                        <li <?php echo ($menu == 'send_sms') ? 'class="active"': ''; ?>>
                            <a href="<?php echo base_url("sms/add?t=$timestamp") ?>">Send SMS</a>
                        </li> 
                    </ul>
                </li>

                <li <?php echo ($mainmenu == 'feedback_records') ? 'class="active"': ''; ?>>
                    <a href="<?php echo base_url("reports/feedback_records?t=$timestamp") ?>"><i class="material-icons">receipt</i>
                        <span>Feedback Records</span></a>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 
                <?= (date('Y') - 1) ?> - <?= date('Y') ?>
                <a href="javascript:void(0);">
                    <?php echo $this->session->get_field_from_session('role_label') ?> Panel - <?= config_item('title') ?></a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>