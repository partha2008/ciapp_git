	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">					
				<li>
					<a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-users fa-fw"></i> User Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/user-list');?>"><i class="fa fa-th-list fa-fw"></i> User List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/user-add');?>"><i class="fa fa-plus fa-fw"></i> Add User</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-cogs fa-fw"></i> Category Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/category-list');?>"><i class="fa fa-th-list fa-fw"></i> Category List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/category-add');?>"><i class="fa fa-plus fa-fw"></i> Add Category</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-retweet fa-fw"></i> Product Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/product-list');?>"><i class="fa fa-th-list fa-fw"></i> Product List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/product-add');?>"><i class="fa fa-plus fa-fw"></i> Add Product</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Order Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/order-list');?>" style="color:green;"><i class="fa fa-th-list fa-fw"></i> Order List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/failed-order-list');?>" style="color:red;"><i class="fa fa-th-list fa-fw"></i> Failed Order List</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-lock fa-fw"></i> Coupon Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/coupon-list');?>"><i class="fa fa-th-list fa-fw"></i> Coupon List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/coupon-add');?>"><i class="fa fa-plus fa-fw"></i> Add Coupon</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-th fa-fw"></i> Content Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/term');?>"><i class="fa fa-hand-o-right fa-fw"></i> Terms & Conditions</a>
							<a href="<?php echo base_url('admin/privacy');?>"><i class="fa fa-hand-o-right fa-fw"></i> Privacy & Policy</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->