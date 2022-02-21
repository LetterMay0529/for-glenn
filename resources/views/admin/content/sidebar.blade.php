<aside id="left-panel">

<!-- User info -->
<div class="login-info">
    <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
        
        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
            <?php 
            
            $profile_img = 'profile_img/'.auth()->user()->profile_img;
            if(auth()->user()->profile_img == 'none'){
                $profile_img = 'profile_img/avatar-agent.jpg';
            }
            
            
            ?>
            <img src="{{ asset( $profile_img); }}" alt="me" class="online" /> 
            <span>
                <?php echo strtoupper(auth()->user()->firstname)." ".strtoupper(auth()->user()->lastname); ?> 
            </span> 
        </a> 
        
    </span>
</div>
<!-- end user info -->

<!-- NAVIGATION : This navigation is also responsive-->
<nav>
    <ul>
        
        @if(auth()->user()->rank == '1')
            <li class="{{ (request()->is('agent/dashboard*')) ? 'active' : '' }}">
                <a href="{{ route('admin.agent'); }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li class="{{ (request()->is('agent/properties*')) ? 'active' : '' }}">
                <a href="{{ route('agent.properties'); }}" title="Properties"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Properties</span></a>
            </li> 
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-calendar-o"></i> <span class="menu-item-parent">Appointments</span></a>
                <ul>
                            <!-- <li class="active"> -->
                            <li class="{{ (request()->is('agent/add_appointments*')) ? 'active' : '' }}">
                                <a href="{{ route('agent.add_appointments'); }}">Create Appointments</a>
                            </li>
                            <li class="{{ (request()->is('agent/view_appointment*')) ? 'active' : '' }}">
                                <a href="{{ route('agent.view_appointment'); }}">List of Appointments Created</a>
                            </li>
                </ul> 
            </li>
            <li class="{{ (request()->is('agent/view_subscription*')) ? 'active' : '' }}">
                <a href="{{ route('agent.view_subscription'); }}" title="Subscription"><i class="fa fa-lg fa-fw fa-money"></i> <span class="menu-item-parent">Manage Subscription</span></a>
            </li> 

            <li class="{{ (request()->is('agent/agent_profile*')) ? 'active' : '' }}">
                <a href="{{ route('agent.agent_profile'); }}" title="profile"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Profile</span></a>
            </li> 
        @endif

        @if(auth()->user()->rank == '2')
            <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                <a href="{{ route('admin.home'); }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li>
                <a href="#" title="Agents"><i class="fa fa-users"></i> <span class="menu-item-parent">Agents</span></a>
                <ul>
                            <!-- <li class="active"> -->
                            <li class="{{ (request()->is('admin/view_request_approval*')) ? 'active' : '' }}">
                                <a href="{{ route('admin.view_request_approval'); }}">Agents Requests for Approval</a>
                            </li>
                            <li class="{{ (request()->is('admin/view_agent_list*')) ? 'active' : '' }}">
                                <a href="{{ route('admin.view_agent_list'); }}">Agents List</a>
                            </li>
                </ul> 
            </li>
            <li class="{{ (request()->is('admin/view_customer_list*')) ? 'active' : '' }}">
                <a href="{{ route('admin.view_customer_list'); }}" title="Dashboard"><i class="glyphicon glyphicon-user"></i> <span class="menu-item-parent">Seekers</span></a>
            </li> 
            <li>
                <a href="#" title="Investigation Request"><i class="glyphicon glyphicon-folder-close"></i> <span class="menu-item-parent">Investigation Request </span></a>
                <ul>
                            <!-- <li class="active"> -->
                            <li class="{{ (request()->is('admin/view_new_request_list/new*')) ? 'active' : '' }}">
                                <a href="/admin/view_new_request_list/new">New Request <?php if($data['new'] < 0){ ?><span class="badge bg-color-orange"><?php echo $data['new']; ?></span> <?php } ?></a>
                            </li>
                            <li class="{{ (request()->is('admin/view_new_request_list/pending*')) ? 'active' : '' }}">
                                <a href="/admin/view_new_request_list/pending">Pending Request <?php if($data['pending'] < 0){ ?><span class="badge bg-color-blue"><?php echo $data['pending']; ?></</span> <?php } ?></a>
                            </li>
                            <li class="{{ (request()->is('admin/view_new_request_list/completed*')) ? 'active' : '' }}">
                                <a href="/admin/view_new_request_list/completed">Completed Request <?php if($data['completed'] < 0){ ?><span class="badge bg-color-greenLight"><?php echo $data['completed']; ?></</span> <?php } ?></a>
                            </li>
                            <li class="{{ (request()->is('admin/view_new_request_list/closed*')) ? 'active' : '' }}">
                                <a href="/admin/view_new_request_list/closed">Closed Request <?php if($data['closed'] < 0){ ?><span class="badge bg-color-default"><?php echo $data['closed']; ?></</span> <?php } ?></a>
                            </li>
                </ul> 
            </li>

            <li>
                <a href="#" title="Notified Agent/Customer"><i class="glyphicon glyphicon-bell"></i> <span class="menu-item-parent">Notified Agent/Customer</span></a>
                <ul>
                            <!-- <li class="active"> -->
                            <li class="{{ (request()->is('admin/create_announcement*')) ? 'active' : '' }}">
                                <a href="{{ route('admin.create_announcement'); }}" > Create Announcement</a>
                            </li>
                            <li class="{{ (request()->is('admin/view_announcement_list*')) ? 'active' : '' }}" > 
                                <a href="{{ route('admin.view_announcement_list'); }}">Prev Announcement</a>
                            </li> 
                </ul> 
            </li>
            <li class="{{ (request()->is('admin/admin_profile_settings*')) ? 'active' : '' }}">
                <a href="{{ route('admin.admin_profile_settings'); }}" title="Profile Settings"><i class="fa fa-cogs"></i> <span class="menu-item-parent">Profile Settings</span></a>
            </li>

            <?php if($super_admin == 'exist'){?>
                <li class="{{ (request()->is('admin/view_create_admin*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.view_create_admin'); }}" title="Create Admin Account"><i class="glyphicon glyphicon-floppy-save"></i> <span class="menu-item-parent">Create Admin Account</span></a>
                </li>
            <?php } ?>

        @endif
        
    </ul>
</nav>
<span class="minifyme" data-action="minifyMenu"> 
    <i class="fa fa-arrow-circle-left hit"></i> 
</span>

</aside>
<!-- END NAVIGATION -->