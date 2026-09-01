<?php 
$DatabaseCoCount = new DatabaseConn();
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu">
      <li id="dashy">
            <a href="dashboard">
            	<i class="fa fa-dashboard"></i><span>My Dashboard</span>
            </a>
         </li>
      <li class="treeview" id="members"> 
        <a href="javascript:;">
          <i class="fa fa-users">
          </i>
          <span>Members
          </span>
          <i class="fa fa-angle-left pull-right">
          </i>
        </a>
        <ul class="treeview-menu">
          <li id="all-members">
            <a href="members">
              <i class="fa fa-square">
              </i>All Members
            </a>
          </li>
        </ul>
      </li>
     <li class="treeview" id="payment"> 
        <a href="javascript:;">
          <i class="fa fa-users">
          </i>
          <span>Payments
          </span>
          <i class="fa fa-angle-left pull-right">
          </i>
        </a>
        <ul class="treeview-menu">
          <li id="total_payment">
            <a href="total_payment">
              <i class="fa fa-square">
              </i>Request For Payment
            </a>
          </li>
          <li id="payment_approved">
            <a href="payment_approved">
              <i class="fa fa-square">
              </i>Payment Req Approved
            </a>
          </li>
          <li id="payment_pending">
            <a href="payment_pending">
              <i class="fa fa-square">
              </i>Payment Req Pending
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview" id="user"> 
        <a href="javascript:;">
          <i class="fa fa-user">
          </i>
          <span>My Profile
          </span>
          <i class="fa fa-angle-left pull-right">
          </i>
        </a>
        <ul class="treeview-menu">
          <li id="user_edit">
            <a href="usereditprofile">
              <i class="fa fa-square">
              </i> 
              <span>Edit Profile
              </span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
