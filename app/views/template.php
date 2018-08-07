<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $title;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<meta content="Kementerian Kelautan dan Perikanan" name="Kementerian Kelautan dan Perikanan"/>
		<meta content="Kementerian Kelautan dan Perikanan" name="Kementerian Kelautan dan Perikanan"/>
		<?php $this->load->view('css');?>
		<link rel="shortcut icon" href="assets/favicon.ico"/>
	</head>
	<body class="page-header-fixed">
		
		<div class="header navbar navbar-fixed-top">
			
			<div class="header-inner">
				
				<a class="navbar-brand" href="index.html">
				<img src="assets/img/logo-big.png" alt="logo" class="img-responsive"/>
				</a>
				
				<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<img src="assets/img/menu-toggler.png" alt=""/>
				</a>
				
				<ul class="nav navbar-nav pull-right">
					
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-warning"></i>
						<span class="badge">
							6
						</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>
									You have 14 new notifications
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;">
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-success">
											<i class="fa fa-plus"></i>
										</span>
										New user registered.
										<span class="time">
											Just now
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Server #12 overloaded.
										<span class="time">
											15 mins
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell-o"></i>
										</span>
										Server #2 not responding.
										<span class="time">
											22 mins
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
										</span>
										Application error.
										<span class="time">
											40 mins
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%.
										<span class="time">
											2 hrs
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										2 user IP blocked.
										<span class="time">
											5 hrs
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell-o"></i>
										</span>
										Storage Server #4 not responding.
										<span class="time">
											45 mins
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
										</span>
										System Error.
										<span class="time">
											55 mins
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%.
										<span class="time">
											2 hrs
										</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="#">
								See all notifications <i class="m-icon-swapright"></i>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-envelope"></i>
						<span class="badge">
							5
						</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>
									You have 12 new messages
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;">
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<img src="<?php echo base_url();?>assets/img/avatar2.jpg" alt=""/>
										</span>
										<span class="subject">
											<span class="from">
												Lisa Wong
											</span>
											<span class="time">
												Just Now
											</span>
										</span>
										<span class="message">
											Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh...
										</span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<img src="<?php echo base_url();?>assets/img/avatar3.jpg" alt=""/>
										</span>
										<span class="subject">
											<span class="from">
												Richard Doe
											</span>
											<span class="time">
												16 mins
											</span>
										</span>
										<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
										</span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<img src="<?php echo base_url();?>assets/img/avatar1.jpg" alt=""/>
										</span>
										<span class="subject">
											<span class="from">
												Bob Nilson
											</span>
											<span class="time">
												2 hrs
											</span>
										</span>
										<span class="message">
											Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh...
										</span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<img src="<?php echo base_url();?>assets/img/avatar2.jpg" alt=""/>
										</span>
										<span class="subject">
											<span class="from">
												Lisa Wong
											</span>
											<span class="time">
												40 mins
											</span>
										</span>
										<span class="message">
											Vivamus sed auctor 40% nibh congue nibh...
										</span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<img src="<?php echo base_url();?>assets/img/avatar3.jpg" alt=""/>
										</span>
										<span class="subject">
											<span class="from">
												Richard Doe
											</span>
											<span class="time">
												46 mins
											</span>
										</span>
										<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
										</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="inbox.html">
								See all messages <i class="m-icon-swapright"></i>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="dropdown" id="header_task_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-tasks"></i>
						<span class="badge">
							5
						</span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li>
								<p>
									You have 12 pending tasks
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;">
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												New release v1.2
											</span>
											<span class="percent">
												30%
											</span>
										</span>
										<span class="progress">
											<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													40% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												Application deployment
											</span>
											<span class="percent">
												65%
											</span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													65% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												Mobile app release
											</span>
											<span class="percent">
												98%
											</span>
										</span>
										<span class="progress">
											<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													98% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												Database migration
											</span>
											<span class="percent">
												10%
											</span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													10% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												Web server upgrade
											</span>
											<span class="percent">
												58%
											</span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													58% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												Mobile development
											</span>
											<span class="percent">
												85%
											</span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													85% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="task">
											<span class="desc">
												New UI release
											</span>
											<span class="percent">
												18%
											</span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 18%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													18% Complete
												</span>
											</span>
										</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="#">
								See all tasks <i class="m-icon-swapright"></i>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username">
							<?php echo $username; ?>
						</span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('profile');?>">
								<i class="fa fa-user"></i> Profil
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('user-log');?>">
								<i class="fa fa-tasks"></i> Aktivitas
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="javascript:;" id="trigger_fullscreen">
								<i class="fa fa-arrows"></i> Layar Penuh
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('auth/logout');?>">
								<i class="fa fa-key"></i> keluar
								</a>
							</li>
						</ul>
					</li>
					
				</ul>
				
			</div>
			
		</div>
		
		<div class="clearfix">
		</div>
		
		<div class="page-container">
			
			<div class="page-sidebar-wrapper">
				<div class="page-sidebar navbar-collapse collapse">
					
					<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
						<li class="sidebar-toggler-wrapper">
							
							<div class="sidebar-toggler hidden-phone">
							</div>
							
						</li>
						<li class="sidebar-search-wrapper">
							
							<form class="sidebar-search" action="extra_search.html" method="POST">
								<div class="form-container">
									<div class="input-box">
										<a href="javascript:;" class="remove">
										</a>
										<input type="text" placeholder="Search..."/>
										<input type="button" class="submit" value=" "/>
									</div>
								</div>
							</form>
							
						</li>
						<li <?php if(isset($active_icon_home))echo $active_icon_home;?>>
							<a href="<?php echo site_url();?>">
							<i class="fa fa-home"></i>
							<span class="title">
								Beranda
							</span>
							<?php if(isset($active_icon_home))echo '<span class="selected"></span>';?>
							</a>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-shopping-cart"></i>
							<span class="title">
								E-Commerce
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="ecommerce_index.html">
									<i class="fa fa-bullhorn"></i>
									Dashboard
									</a>
								</li>
								<li>
									<a href="ecommerce_orders.html">
									<i class="fa fa-shopping-cart"></i>
									Orders
									</a>
								</li>
								<li>
									<a href="ecommerce_orders_view.html">
									<i class="fa fa-tags"></i>
									Order View
									</a>
								</li>
								<li>
									<a href="ecommerce_products.html">
									<i class="fa fa-sitemap"></i>
									Products
									</a>
								</li>
								<li>
									<a href="ecommerce_products_edit.html">
									<i class="fa fa-file-o"></i>
									Product Edit
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-gift"></i>
							<span class="title">
								Frontend Themes
							</span>
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete E-Commerce Frontend Theme For Metronic Admin">
									<a href="http://keenthemes.com/preview/index.php?theme=metronic_ecommerce" target="_blank">
									<span class="title">
										E-Commerce Frontend
									</span>
									</a>
								</li>
								<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
									<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
									<span class="title">
										Corporate Frontend
									</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-cogs"></i>
							<span class="title">
								Page Layouts
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="index_horizontal_menu.html">
									Dashboard & Mega Menu
									</a>
								</li>
								<li>
									<a href="layout_horizontal_sidebar_menu.html">
									Horizontal & Sidebar Menu
									</a>
								</li>
								<li>
									<a href="layout_horizontal_menu1.html">
									Horizontal Mega Menu 1
									</a>
								</li>
								<li>
									<a href="layout_horizontal_menu2.html">
									Horizontal Mega Menu 2
									</a>
								</li>
								<li>
									<a href="layout_search_on_header.html">
									Searchbar On Header
									</a>
								</li>
								<li>
									<a href="layout_sidebar_toggler_on_header.html">
									Sidebar Toggler On Header
									</a>
								</li>
								<li>
									<a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-success">
										new
									</span>
									Right Sidebar Page
									</a>
								</li>
								<li>
									<a href="layout_sidebar_fixed.html">
									Sidebar Fixed Page
									</a>
								</li>
								<li>
									<a href="layout_sidebar_closed.html">
									Sidebar Closed Page
									</a>
								</li>
								<li>
									<a href="layout_ajax.html">
									Content Loading via Ajax
									</a>
								</li>
								<li>
									<a href="layout_disabled_menu.html">
									Disabled Menu Links
									</a>
								</li>
								<li>
									<a href="layout_blank_page.html">
									Blank Page
									</a>
								</li>
								<li>
									<a href="layout_boxed_page.html">
									Boxed Page
									</a>
								</li>
								<li>
									<a href="layout_language_bar.html">
									Language Switch Bar
									</a>
								</li>
								<li>
									<a href="layout_promo.html">
									Promo Page
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-bookmark-o"></i>
							<span class="title">
								UI Features
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="ui_general.html">
									General
									</a>
								</li>
								<li>
									<a href="ui_buttons.html">
									Buttons & Icons
									</a>
								</li>
								<li>
									<a href="ui_typography.html">
									Typography
									</a>
								</li>
								<li>
									<a href="ui_tabs_accordions_navs.html">
									Tabs, Accordions & Navs
									</a>
								</li>
								<li>
									<a href="ui_tree.html">
									<span class="badge badge-roundless badge-important">
										new
									</span>
									Tree View
									</a>
								</li>
								<li>
									<a href="ui_page_progress_style_1.html">
									<span class="badge badge-roundless badge-warning">
										new
									</span>
									Page Progress Bar
									</a>
								</li>
								<li>
									<a href="ui_blockui.html">
									Block UI
									</a>
								</li>
								<li>
									<a href="ui_notific8.html">
									Notific8 Notifications
									</a>
								</li>
								<li>
									<a href="ui_toastr.html">
									Toastr Notifications
									</a>
								</li>
								<li>
									<a href="ui_alert_dialog_api.html">
									<span class="badge badge-roundless badge-important">
										new
									</span>
									Alerts & Dialogs API
									</a>
								</li>
								<li>
									<a href="ui_session_timeout.html">
									Session Timeout
									</a>
								</li>
								<li>
									<a href="ui_idle_timeout.html">
									User Idle Timeout
									</a>
								</li>
								<li>
									<a href="ui_modals.html">
									Modals
									</a>
								</li>
								<li>
									<a href="ui_extended_modals.html">
									Extended Modals
									</a>
								</li>
								<li>
									<a href="ui_tiles.html">
									Tiles
									</a>
								</li>
								<li>
									<a href="ui_datepaginator.html">
									<span class="badge badge-roundless badge-success">
										new
									</span>
									Date Paginator
									</a>
								</li>
								<li>
									<a href="ui_nestable.html">
									Nestable List
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-puzzle-piece"></i>
							<span class="title">
								UI Components
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="components_pickers.html">
									Pickers
									</a>
								</li>
								<li>
									<a href="components_dropdowns.html">
									Custom Dropdowns
									</a>
								</li>
								<li>
									<a href="components_form_tools.html">
									Form Tools
									</a>
								</li>
								<li>
									<a href="components_editors.html">
									Markdown & WYSIWYG Editors
									</a>
								</li>
								<li>
									<a href="components_ion_sliders.html">
									Ion Range Sliders
									</a>
								</li>
								<li>
									<a href="components_noui_sliders.html">
									NoUI Range Sliders
									</a>
								</li>
								<li>
									<a href="components_jqueryui_sliders.html">
									jQuery UI Sliders
									</a>
								</li>
								<li>
									<a href="components_knob_dials.html">
									Knob Circle Dials
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-table"></i>
							<span class="title">
								Form Stuff
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="form_controls.html">
									Form Controls
									</a>
								</li>
								<li>
									<a href="form_layouts.html">
									Form Layouts
									</a>
								</li>
								<li>
									<a href="form_editable.html">
									<span class="badge badge-roundless badge-warning">
										new
									</span>
									Form X-editable
									</a>
								</li>
								<li>
									<a href="form_wizard.html">
									Form Wizard
									</a>
								</li>
								<li>
									<a href="form_validation.html">
									Form Validation
									</a>
								</li>
								<li>
									<a href="form_image_crop.html">
									<span class="badge badge-roundless badge-important">
										new
									</span>
									Image Cropping
									</a>
								</li>
								<li>
									<a href="form_fileupload.html">
									Multiple File Upload
									</a>
								</li>
								<li>
									<a href="form_dropzone.html">
									Dropzone File Upload
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i>
							<span class="title">
								Email Templates
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="email_newsletter.html">
									Responsive Newsletter<br>
									Email Template
									</a>
								</li>
								<li>
									<a href="email_system.html">
									Responsive System<br>
									Email Template
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-sitemap"></i>
							<span class="title">
								Pages
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="page_portfolio.html">
									<i class="fa fa-briefcase"></i>
									<span class="badge badge-warning badge-roundless">
										new
									</span>
									Portfolio
									</a>
								</li>
								<li>
									<a href="page_timeline.html">
									<i class="fa fa-clock-o"></i>
									<span class="badge badge-info">
										4
									</span>
									Timeline
									</a>
								</li>
								<li>
									<a href="page_coming_soon.html">
									<i class="fa fa-cogs"></i>
									Coming Soon
									</a>
								</li>
								<li>
									<a href="page_blog.html">
									<i class="fa fa-comments"></i>
									Blog
									</a>
								</li>
								<li>
									<a href="page_blog_item.html">
									<i class="fa fa-font"></i>
									Blog Post
									</a>
								</li>
								<li>
									<a href="page_news.html">
									<i class="fa fa-coffee"></i>
									<span class="badge badge-success">
										9
									</span>
									News
									</a>
								</li>
								<li>
									<a href="page_news_item.html">
									<i class="fa fa-bell"></i>
									News View
									</a>
								</li>
								<li>
									<a href="page_about.html">
									<i class="fa fa-group"></i>
									About Us
									</a>
								</li>
								<li>
									<a href="page_contact.html">
									<i class="fa fa-envelope-o"></i>
									Contact Us
									</a>
								</li>
								<li>
									<a href="page_calendar.html">
									<i class="fa fa-calendar"></i>
									<span class="badge badge-important">
										14
									</span>
									Calendar
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-gift"></i>
							<span class="title">
								Extra
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="extra_profile.html">
									User Profile
									</a>
								</li>
								<li>
									<a href="extra_lock.html">
									Lock Screen
									</a>
								</li>
								<li>
									<a href="extra_faq.html">
									FAQ
									</a>
								</li>
								<li>
									<a href="inbox.html">
									<span class="badge badge-important">
										4
									</span>
									Inbox
									</a>
								</li>
								<li>
									<a href="extra_search.html">
									Search Results
									</a>
								</li>
								<li>
									<a href="extra_invoice.html">
									Invoice
									</a>
								</li>
								<li>
									<a href="extra_pricing_table.html">
									Pricing Tables
									</a>
								</li>
								<li>
									<a href="extra_404_option1.html">
									404 Page Option 1
									</a>
								</li>
								<li>
									<a href="extra_404_option2.html">
									404 Page Option 2
									</a>
								</li>
								<li>
									<a href="extra_404_option3.html">
									404 Page Option 3
									</a>
								</li>
								<li>
									<a href="extra_500_option1.html">
									500 Page Option 1
									</a>
								</li>
								<li>
									<a href="extra_500_option2.html">
									500 Page Option 2
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-folder-open"></i>
							<span class="title">
								Multi Level Menu
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="fa fa-cogs"></i> Item 1
									<span class="arrow">
									</span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="javascript:;">
											<i class="fa fa-user"></i>
											Sample Link 1
											<span class="arrow">
											</span>
											</a>
											<ul class="sub-menu">
												<li>
													<a href="#">
													<i class="fa fa-remove"></i> Sample Link 1
													</a>
												</li>
												<li>
													<a href="#">
													<i class="fa fa-pencil"></i> Sample Link 1
													</a>
												</li>
												<li>
													<a href="#">
													<i class="fa fa-edit"></i> Sample Link 1
													</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-user"></i> Sample Link 1
											</a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-external-link"></i> Sample Link 2
											</a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-bell"></i> Sample Link 3
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="javascript:;">
									<i class="fa fa-globe"></i> Item 2
									<span class="arrow">
									</span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#">
											<i class="fa fa-user"></i> Sample Link 1
											</a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-external-link"></i> Sample Link 1
											</a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-bell"></i> Sample Link 1
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">
									<i class="fa fa-folder-open"></i>
									Item 3
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-user"></i>
							<span class="title">
								Login Options
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="login.html">
									Login Form 1
									</a>
								</li>
								<li>
									<a href="login_soft.html">
									Login Form 2
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-th"></i>
							<span class="title">
								Data Tables
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="table_basic.html">
									Basic Datatables
									</a>
								</li>
								<li>
									<a href="table_responsive.html">
									Responsive Datatables
									</a>
								</li>
								<li>
									<a href="table_managed.html">
									Managed Datatables
									</a>
								</li>
								<li>
									<a href="table_editable.html">
									Editable Datatables
									</a>
								</li>
								<li>
									<a href="table_advanced.html">
									Advanced Datatables
									</a>
								</li>
								<li>
									<a href="table_ajax.html">
									Ajax Datatables
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-file-text"></i>
							<span class="title">
								Portlets
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="portlet_general.html">
									General Portlets
									</a>
								</li>
								<li>
									<a href="portlet_ajax.html">
									Ajax Portlets
									</a>
								</li>
								<li>
									<a href="portlet_draggable.html">
									Draggable Portlets
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-map-marker"></i>
							<span class="title">
								Maps
							</span>
							<span class="arrow ">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="maps_google.html">
									Google Maps
									</a>
								</li>
								<li>
									<a href="maps_vector.html">
									Vector Maps
									</a>
								</li>
							</ul>
						</li>
						<li class="last ">
							<a href="charts.html">
							<i class="fa fa-bar-chart-o"></i>
							<span class="title">
								Visual Charts
							</span>
							</a>
						</li>
					</ul>
					
				</div>
			</div>
			<div class="page-content-wrapper">
				<div id="preloader">
				<div id="status"></div>
			</div>
				<?php if(!empty($contents)) echo $contents;
					else redirect('error');
				?>
			</div>
			
		</div>
		
		<div class="footer">
			<div class="footer-inner">
				<?php 
					if(date('Y')==2015) echo '2015 &copy; Kementerian Kelautan dan Perikanan Republik Indonesia.';
					else 
					{
						echo '2015 - '.date('Y').' &copy; Kementerian Kelautan dan Perikanan Republik Indonesia.';	
					}
				?>
			</div>
			<div class="footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>
		<?php $this->load->view('js');?>
		
	</body>
	
</html>