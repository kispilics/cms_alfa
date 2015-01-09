<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
		<base href="{$URL}" target="_self">
		<title>{$title}</title>
		<link rel="stylesheet" type="text/css" href="detail/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="detail/css/navi.css" media="screen" />
		
		<link rel="stylesheet" type="text/css" href="detail/my/my_style.css" media="screen" />
		
		<!--
		<script type="text/javascript" src="detail/js/jquery-1.7.2.min.js"></script>
		-->
		
		<!-- ============== fancyBox ===================== -->
		<!-- Add jQuery library -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="detail/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

		<!-- Add fancyBox -->
		<link rel="stylesheet" href="detail/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="detail/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

		<!-- Optionally add helpers - button, thumbnail and/or media -->
		<link rel="stylesheet" href="detail/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="detail/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="detail/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

		<link rel="stylesheet" href="detail/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="detail/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		<!-- ================================ -->

		<!-- ==== TINYMCE ==== -->
		<script src="detail/tinymce/tinymce.min.js"></script>
		<script src="detail/tinymce/tinymce.js"></script>
		<!-- ================= -->
		
		<!--
		<script type="text/javascript" src="detail/js/jquery-1.11.1.min.js"></script>
		-->
		<script type="text/javascript" src="detail/js/script.js"></script>
		<script type="text/javascript" src="detail/my/delete.js"></script>
		
		<script type="text/javascript">{$form->java}</script>
		
	</head>
	
	<body>
		<div class="wrap">
			<div id="header">
				<div id="top">
					<div class="left">
						<p>Welcome, <strong><span style="text-transform: uppercase;">{$log_username}</span></strong> [ <a href="admin_log/click_logout/">logout</a> ]</p>
					</div>
					<div class="right">
						<div class="align-right">
							<p>[ Last login: <strong>{$last_log_date}</strong> ]</p>
						</div>
					</div>
				</div>
				<div id="nav">
					<ul>
						
						<li class="upp"><a href="admin_newsletter/show/">Newsletter</a>
							<ul>
								<li>&#8250; <a href="admin_newsletter/show/">Show All Newsletter</a></li>
								{if $disableAddNewsletter}
								<li>&#8250; <a href="admin_newsletter/addNew/">Add New Newsletter</a></li>
								{/if}
							</ul>
						</li>
						<li class="upp"><a href="admin_articleType/show/">Articles</a>
							<ul>
								<li>&#8250; <a href="admin_articleType/show/">Show all articles</a></li>
								{if $disableAddArticle}
								<li>&#8250; <a href="admin_articleType/addNew/">Add new article</a></li>
								{/if}
							</ul>
						</li>
						<li class="upp"><a href="admin_user/show/">Users</a>
							<ul>
								<li>&#8250; <a href="admin_user/show/">Show all uses</a></li>
								{if $disableAddUser}
								<li>&#8250; <a href="admin_user/addNew/">Add new user</a></li>
								{/if}
							</ul>
						</li>
						<li class="upp"><a href="admin_contact/show/">Contact</a>
							<ul>
								<li>&#8250; <a href="admin_contact/show/">Show contact</a></li>
								{if $disableAddContact}
								<li>&#8250; <a href="admin_contact/addNew/">Add contact</a></li>
								{/if}
							</ul>
						</li>
						<li class="upp"><a href="admin_news/show/">News</a>
							<ul>
								<li>&#8250; <a href="admin_news/show/">Show news</a></li>
								{if $disableAddNews}
								<li>&#8250; <a href="admin_news/addNew/">Add new news</a></li>
								{/if}
							</ul>
						</li>
						<li class="upp"><a href="admin_header_rotator/show/">Header images</a>
							<ul>
								<li>&#8250; <a href="admin_header_rotator/show/">Show images</a></li>
								{if $disableAddHeader}
								<li>&#8250; <a href="admin_header_rotator/addNew/">Add new images</a></li>
								{/if}
							</ul>
						</li>
					</ul>
				</div>
			</div>
	<div id="content">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; Newsletter</div>
				<ul id="home">
					<li>&#8250; <a href="admin_newsletter/show/">Show All Newsletter</a></li>
					{if $disableAddNewsletter}
					<li>&#8250; <a href="admin_newsletter/addNew/">Add New Newsletter</a></li>
					{/if}
				</ul>
			</div>
			
			<div class="box">
				<div class="h_title">&#8250; Articles</div>
				<ul>
					<li>&#8250; <a href="admin_articleType/show/">Show all articles</a></li>
					{if $disableAddArticle}
					<li>&#8250; <a href="admin_articleType/addNew/">Add new article</a></li>
					{/if}
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Users</div>
				<ul>
					<li class="b1"><a class="icon users" href="admin_user/show/">Show all users</a></li>
					{if $disableAddUser}
					<li class="b2"><a class="icon add_user" href="admin_user/addNew/">Add new user</a></li>
					{/if}
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Contact</div>
				<ul>
					<li>&#8250; <a href="admin_contact/show/">Show contact</a></li>
					{if $disable_link}
					<li>&#8250; <a href="admin_contact/addNew/">Add contact</a></li>
					{/if}
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; News</div>
				<ul>
					<li>&#8250; <a href="admin_news/show/">Show news</a></li>
					{if $disableAddNews}
					<li>&#8250; <a href="admin_news/addNew/">Add new news</a></li>
					{/if}
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Header images</div>
				<ul>
					<li>&#8250; <a href="admin_header_rotator/show/">Show images</a></li>
					{if $disableAddHeader}
					<li>&#8250; <a href="admin_header_rotator/addNew/">Add new images</a></li>
					{/if}
				</ul>
			</div>
		</div>
		
		<p style="display:none;font-size:20px;font-weight:bold;width:300px;text-align:center;padding-top:24px;" id="error_popup">Proba</p>
		