<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="SoengSouy Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="SoengSouy Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Dashboard - HRMS</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	<!-- Modern Dashboard UI Stylesheet -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/modern-dashboard.css') }}">
</head>

<body>
	@yield('style')
	<style>    
		.invalid-feedback{
			font-size: 14px;
		}
		.error{
			color: red;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<!-- Loader -->
		<div id="loader-wrapper">
			<div id="loader">
				<div class="loader-ellips">
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				</div>
			</div>
		</div>
		<!-- /Loader -->

		<!-- Modern Header -->
		<div class="header modern-header">
			<div class="topbar-left">
				<a href="{{ route('home') }}" class="topbar-brand" title="Apex Horizon HR Management">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
						<circle cx="9" cy="7" r="4"></circle>
						<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
						<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
					</svg>
				</a>
				<button type="button" class="drawer-toggle-btn" id="drawer_toggle_btn" title="Toggle Navigation Drawer">
					<span id="drawer_toggle_icon">&lt;|</span>
				</button>
				<div class="topbar-breadcrumb">
					<a href="{{ route('home') }}">Home</a>
					<span class="separator">›</span>
					<span class="current-page">@yield('page_title', 'Dashboard')</span>
				</div>
			</div>
			
			<div class="topbar-right">
				<!-- Language Selector -->
				<div class="dropdown">
					<a href="#" class="lang-selector dropdown-toggle" data-toggle="dropdown">
						<span>🌐</span>
						<span>🇺🇸 EN</span>
						<i class="fa fa-angle-down" style="font-size: 11px; color: #94a3b8;"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.08);">
						<a class="dropdown-item" href="#">🇺🇸 English</a>
						<a class="dropdown-item" href="#">🇰🇭 Khmer</a>
					</div>
				</div>

				<!-- Notifications Bell -->
				<a href="{{ route('form/leaves/new') }}" class="topbar-action-icon" title="Pending Approvals & Notifications">
					<i class="fa fa-bell-o"></i>
					<span class="badge-counter">3</span>
				</a>

				<!-- Messages / Chat -->
				<a href="{{ route('chat') }}" class="topbar-action-icon" title="Messages">
					<i class="fa fa-commenting-o"></i>
					<span class="badge-counter">1</span>
				</a>

				<!-- Fullscreen -->
				<button type="button" class="topbar-action-icon" id="fullscreen_toggle_btn" title="Toggle Fullscreen">
					<i class="fa fa-arrows-alt"></i>
				</button>

				<!-- User Profile Pill -->
				<div class="dropdown">
					<div class="profile-pill dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile-avatar-wrapper">
							<img src="{{ URL::to('/assets/images/'. (Auth::user()->avatar ?? 'photo_defaults.jpg')) }}" class="profile-avatar-img" alt="avatar">
							<span class="profile-online-badge"></span>
						</div>
						<div class="profile-info">
							<span class="profile-name">{{ Session::get('name') ?? Auth::user()->name ?? 'Jayy' }}</span>
							<span class="profile-email-masked">{{ Auth::user() ? substr(Auth::user()->email, 0, 1) . '*****@**' . substr(strstr(Auth::user()->email, '@'), -7) : 'j*****@**ail.com' }}</span>
						</div>
						<i class="fa fa-angle-down profile-chevron"></i>
					</div>
					<div class="dropdown-menu dropdown-menu-right" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 6px 20px rgba(0,0,0,0.08); padding: 8px 0;">
						<a class="dropdown-item" href="{{ route('profile_user') }}"><i class="fa fa-user mr-2 text-muted"></i> My Profile</a>
						<a class="dropdown-item" href="{{ route('company/settings/page') }}"><i class="fa fa-cog mr-2 text-muted"></i> Settings</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fa fa-power-off mr-2"></i> Logout</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modern Header -->
		<!-- Sidebar -->
		@include('sidebar.sidebar')
		<!-- /Sidebar -->
		<!-- Slide-Out Filter Drawer -->
		@include('layouts.filter_drawer')
		<!-- /Slide-Out Filter Drawer -->
		<!-- Slide-Out Record Details Drawer (Screenshot 4) -->
		@include('layouts.row_details_drawer')
		<!-- /Slide-Out Record Details Drawer -->
		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<!-- Chart JS -->
	<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/chart.js') }}"></script>
	<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/line-chart.js') }}"></script>

	<!-- Slimscroll JS -->
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<!-- Select2 JS -->
	<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>
	<!-- validation-->
	<script src="{{ URL::to('assets/js/jquery.validate.js') }}"></script>	
	<!-- Custom JS -->
	<script src="{{ URL::to('assets/js/app.js') }}"></script>
	<!-- Modern Dashboard Interactivity JS -->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const drawerToggleBtn = document.getElementById('drawer_toggle_btn');
			const sidebarWrapper = document.getElementById('dual_sidebar_wrapper');
			const drawerIcon = document.getElementById('drawer_toggle_icon');

			function applyCollapseState(isCollapsed) {
				if (isCollapsed) {
					if (sidebarWrapper) sidebarWrapper.classList.add('collapsed');
					document.body.classList.add('sidebar-collapsed');
					if (drawerIcon) drawerIcon.innerHTML = '&gt;|';
				} else {
					if (sidebarWrapper) sidebarWrapper.classList.remove('collapsed');
					document.body.classList.remove('sidebar-collapsed');
					if (drawerIcon) drawerIcon.innerHTML = '&lt;|';
				}
			}

			if (drawerToggleBtn && sidebarWrapper) {
				drawerToggleBtn.addEventListener('click', function() {
					const willCollapse = !sidebarWrapper.classList.contains('collapsed');
					applyCollapseState(willCollapse);
					localStorage.setItem('modern_sidebar_collapsed', willCollapse ? 'true' : 'false');
				});

				// Restore persisted collapsed state
				if (localStorage.getItem('modern_sidebar_collapsed') === 'true') {
					applyCollapseState(true);
				}
			}

			// Fullscreen toggle
			const fsBtn = document.getElementById('fullscreen_toggle_btn');
			if (fsBtn) {
				fsBtn.addEventListener('click', function() {
					if (!document.fullscreenElement) {
						document.documentElement.requestFullscreen().catch(() => {});
					} else {
						if (document.exitFullscreen) document.exitFullscreen().catch(() => {});
					}
				});
			}

			// Primary Rail Tab Switcher
			const railButtons = document.querySelectorAll('.rail-btn[data-target-drawer]');
			const drawerPanels = document.querySelectorAll('.drawer-category-panel');

			railButtons.forEach(btn => {
				btn.addEventListener('click', function(e) {
					const targetDrawerId = this.getAttribute('data-target-drawer');
					if (!targetDrawerId) return;

					// If drawer was collapsed, auto-expand on clicking a rail icon
					if (sidebarWrapper && sidebarWrapper.classList.contains('collapsed')) {
						applyCollapseState(false);
						localStorage.setItem('modern_sidebar_collapsed', 'false');
					}

					railButtons.forEach(b => b.classList.remove('active'));
					this.classList.add('active');

					drawerPanels.forEach(panel => {
						if (panel.id === targetDrawerId) {
							panel.style.display = 'block';
						} else {
							panel.style.display = 'none';
						}
					});
				});
			});

			// =====================================================================
			// SLIDE-OUT FILTER DRAWER & DATATABLES CONTROLLER (SCREENSHOT 1 & 2)
			// =====================================================================
			const filterDrawer = document.getElementById('filter_drawer_wrapper');
			const filterOverlay = document.getElementById('filter_drawer_overlay');
			const closeFilterBtn = document.getElementById('close_filter_btn');
			const btnApplyFilter = document.getElementById('btn_apply_hr_filter');
			const btnClearFilter = document.getElementById('btn_clear_hr_filter');

			function openFilterDrawer() {
				if (filterDrawer && filterOverlay) {
					filterDrawer.classList.add('opened');
					filterOverlay.classList.add('active');
					document.body.style.overflow = 'hidden';
				}
			}

			function closeFilterDrawer() {
				if (filterDrawer && filterOverlay) {
					filterDrawer.classList.remove('opened');
					filterOverlay.classList.remove('active');
					document.body.style.overflow = '';
				}
			}

			if (closeFilterBtn) {
				closeFilterBtn.addEventListener('click', closeFilterDrawer);
			}
			if (filterOverlay) {
				filterOverlay.addEventListener('click', closeFilterDrawer);
			}
			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape' && filterDrawer && filterDrawer.classList.contains('opened')) {
					closeFilterDrawer();
				}
			});

			// Delegate filter button clicks anywhere on the page
			$(document).on('click', '.btn-filter-toggle', function(e) {
				e.preventDefault();
				openFilterDrawer();
			});

			// Auto-enhance all datatables with Screenshot 1 toolbar if not already present
			$('.table-responsive').each(function() {
				const $resp = $(this);
				if ($resp.find('table.datatable, table.dataTable').length > 0 && $resp.find('.datatable-card-toolbar').length === 0) {
					const pageTitle = $('.page-title').first().text().replace(/[0-9]/g, '').trim() || 'Records';
					const toolbarHtml = `
						<div class="datatable-card-toolbar">
							<div class="datatable-search-box">
								<i class="fa fa-search search-icon"></i>
								<input type="text" placeholder="Search ${pageTitle}...">
								<button type="button" class="btn-datatable-search">Search</button>
							</div>
							<div class="datatable-btn-actions">
								<button type="button" class="btn-export-outline" title="Export as CSV">
									<i class="fa fa-download"></i> Export
								</button>
								<button type="button" class="btn-filter-toggle" title="Filter ${pageTitle}">
									<i class="fa fa-sliders"></i> Filter
								</button>
							</div>
						</div>
					`;
					$resp.prepend(toolbarHtml);
					// Hide legacy filter row when modern datatable toolbar is present
					$resp.closest('.content').find('.filter-row').hide();
				}
			});

			// Helper to get active DataTable instance
			function getActiveDataTable() {
				if ($.fn.dataTable.isDataTable('.datatable')) {
					return $('.datatable').DataTable();
				}
				if ($.fn.dataTable.isDataTable('table.dataTable')) {
					return $('table.dataTable').DataTable();
				}
				return null;
			}

			// Live Search Input Handler (Screenshot 1)
			$(document).on('input', '.datatable-search-box input', function() {
				const query = $(this).val();
				const dt = getActiveDataTable();
				if (dt) {
					dt.search(query).draw();
				}
			});

			$(document).on('click', '.btn-datatable-search', function(e) {
				e.preventDefault();
				const searchInput = $(this).closest('.datatable-search-box').find('input');
				const dt = getActiveDataTable();
				if (dt) {
					dt.search(searchInput.val()).draw();
				}
			});

			// Apply Filter Button Handler (Screenshot 2)
			if (btnApplyFilter) {
				btnApplyFilter.addEventListener('click', function() {
					const dt = getActiveDataTable();
					if (!dt) {
						closeFilterDrawer();
						return;
					}

					// 1. Sorting Order
					const sortVal = $('input[name="hr_sort_order"]:checked').val();
					if (sortVal === 'older') {
						dt.order([0, 'asc']);
					} else if (sortVal === 'asc') {
						dt.order([1, 'asc']);
					} else if (sortVal === 'desc') {
						dt.order([1, 'desc']);
					} else {
						dt.order([0, 'desc']);
					}

					// 2. Collect Checked Filters
					const selectedDepts = $('input[name="hr_department[]"]:checked').map(function() { return $(this).val(); }).get();
					const selectedStatuses = $('input[name="hr_status[]"]:checked').map(function() { return $(this).val(); }).get();
					const selectedTypes = $('input[name="hr_job_type[]"]:checked').map(function() { return $(this).val(); }).get();

					const totalFilters = selectedDepts.length + selectedStatuses.length + selectedTypes.length + (sortVal !== 'default' ? 1 : 0);

					// Clear previous custom search filter
					$.fn.dataTable.ext.search = [];

					if (totalFilters > 0) {
						$.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
							const rowText = data.join(' ').toLowerCase();

							if (selectedDepts.length > 0) {
								const matchDept = selectedDepts.some(d => rowText.indexOf(d.toLowerCase()) !== -1);
								if (!matchDept) return false;
							}
							if (selectedStatuses.length > 0) {
								const matchStatus = selectedStatuses.some(s => rowText.indexOf(s.toLowerCase()) !== -1);
								if (!matchStatus) return false;
							}
							if (selectedTypes.length > 0) {
								const matchType = selectedTypes.some(t => rowText.indexOf(t.toLowerCase()) !== -1);
								if (!matchType) return false;
							}
							return true;
						});

						$('.btn-filter-toggle').addClass('has-filter').html('<i class="fa fa-sliders"></i> Filter <span class="filter-active-dot"></span>');
					} else {
						$('.btn-filter-toggle').removeClass('has-filter').html('<i class="fa fa-sliders"></i> Filter');
					}

					dt.draw();
					closeFilterDrawer();
				});
			}

			// Clear Filter Button Handler
			if (btnClearFilter) {
				btnClearFilter.addEventListener('click', function() {
					$('input[name="hr_sort_order"][value="default"]').prop('checked', true);
					$('input[name="hr_department[]"]').prop('checked', false);
					$('input[name="hr_status[]"]').prop('checked', false);
					$('input[name="hr_job_type[]"]').prop('checked', false);

					$.fn.dataTable.ext.search = [];
					const dt = getActiveDataTable();
					if (dt) {
						dt.search('').order([0, 'asc']).draw();
					}
					$('.datatable-search-box input').val('');
					$('.btn-filter-toggle').removeClass('has-filter').html('<i class="fa fa-sliders"></i> Filter');
					closeFilterDrawer();
				});
			}

			// CSV Export Button Handler (Screenshot 1)
			$(document).on('click', '.btn-export-outline', function(e) {
				e.preventDefault();
				const dt = getActiveDataTable();
				const table = dt ? $(dt.table().node()) : $('table.dataTable, .custom-table').first();
				if (!table.length) return;

				let csv = [];
				// Headers
				let headers = [];
				table.find('thead th').each(function() {
					const text = $(this).text().trim();
					if (text && text.toLowerCase() !== 'action' && text.toLowerCase() !== 'actions') {
						headers.push('"' + text.replace(/"/g, '""') + '"');
					}
				});
				csv.push(headers.join(','));

				// Rows
				table.find('tbody tr').each(function() {
					if ($(this).find('td').length > 1 && !$(this).hasClass('dataTables_empty')) {
						let row = [];
						$(this).find('td').each(function(idx) {
							if (idx < headers.length) {
								let val = $(this).clone().children('span.status-dot, i').remove().end().text().trim();
								row.push('"' + val.replace(/\s+/g, ' ').replace(/"/g, '""') + '"');
							}
						});
						csv.push(row.join(','));
					}
				});

				// Download
				const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
				const link = document.createElement('a');
				link.href = URL.createObjectURL(blob);
				link.setAttribute('download', 'HR_Export_' + (new Date().toISOString().slice(0, 10)) + '.csv');
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			});

			// =====================================================================
			// SLIDE-OUT RECORD DETAILS DRAWER (SCREENSHOT 4)
			// =====================================================================
			const rdDrawer = document.getElementById('row_details_drawer_wrapper');
			const rdOverlay = document.getElementById('row_details_drawer_overlay');
			const rdCloseBtn = document.getElementById('close_row_details_btn');
			let activeRowElement = null;

			function openRowDetailsDrawer() {
				if (rdDrawer && rdOverlay) {
					rdDrawer.classList.add('opened');
					rdOverlay.classList.add('active');
					document.body.style.overflow = 'hidden';
				}
			}

			function closeRowDetailsDrawer() {
				if (rdDrawer && rdOverlay) {
					rdDrawer.classList.remove('opened');
					rdOverlay.classList.remove('active');
					document.body.style.overflow = '';
					$('tr.row-active-drawer').removeClass('row-active-drawer');
					activeRowElement = null;
				}
			}

			if (rdCloseBtn) rdCloseBtn.addEventListener('click', closeRowDetailsDrawer);
			if (rdOverlay) rdOverlay.addEventListener('click', closeRowDetailsDrawer);

			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape' && rdDrawer && rdDrawer.classList.contains('opened')) {
					closeRowDetailsDrawer();
				}
			});

			// Universal Click-on-Row Handler for all DataTables (Screenshot 4)
			$(document).on('click', 'table.dataTable tbody tr, .datatable tbody tr, .custom-table tbody tr', function(e) {
				// Don't trigger if clicked on a button, link, dropdown, or action control
				if ($(e.target).closest('a, button, input, select, .dropdown, .table-action-square-group, .btn-action-square, .status-toggle').length > 0) {
					return;
				}

				const $tr = $(this);
				if ($tr.hasClass('dataTables_empty') || $tr.children('td').length <= 1) return;

				activeRowElement = $tr;
				$('tr.row-active-drawer').removeClass('row-active-drawer');
				$tr.addClass('row-active-drawer');

				// 1. Determine Title & Page Context
				const pageTitle = $('.page-title').first().text().replace(/[0-9]/g, '').trim() || 'Record';
				$('#row_details_header_title').text(pageTitle.endsWith('s') ? pageTitle.slice(0, -1) + ' Details' : pageTitle + ' Details');

				// 2. Extract Avatar, Primary Name & Subtitle
				let avatarImg = $tr.find('.avatar img, .table-avatar img').attr('src');
				let mainTitle = '';
				let subtitle = '';

				if ($tr.find('.table-avatar a').length > 0) {
					const $avatarLink = $tr.find('.table-avatar a').last();
					mainTitle = $avatarLink.contents().filter(function() { return this.nodeType === 3; }).text().trim() || $avatarLink.text().trim();
					subtitle = $tr.find('.table-avatar span').text().trim();
				}

				if (!mainTitle) {
					// Fallback to first text cell
					mainTitle = $tr.find('td:visible').first().text().trim();
				}

				$('#rd_main_title').text(mainTitle || 'Selected Record');
				$('#rd_subtitle').text(subtitle || pageTitle);

				// Avatar Display
				if (avatarImg && avatarImg.indexOf('null') === -1) {
					$('#rd_avatar_img').attr('src', avatarImg).show();
					$('#rd_avatar_char').hide();
				} else {
					$('#rd_avatar_img').hide();
					const initialChar = mainTitle ? mainTitle.charAt(0).toUpperCase() : 'R';
					$('#rd_avatar_char').text(initialChar).show();
				}

				// 3. Badges Row
				let badgesHtml = '';
				const statusText = $tr.find('.badge, .status-dot, [class*="status"], .dropdown-toggle').first().text().trim();
				if (statusText) {
					badgesHtml += `<span class="pill-badge-blue"><span class="dot"></span> ${statusText}</span>`;
				}
				const roleOrType = $tr.find('.badge-info, .badge-purple, .badge-warning, .leave_type, .role_name').first().text().trim();
				if (roleOrType && roleOrType !== statusText) {
					badgesHtml += `<span class="pill-badge-amber">${roleOrType}</span>`;
				}
				if (!badgesHtml) {
					badgesHtml = '<span class="pill-badge-blue"><span class="dot"></span> Verified Active</span>';
				}
				$('#rd_badges_row').html(badgesHtml);

				// 4. Highlight Stat Card (Screenshot 4)
				let statLabel = 'RECORD OVERVIEW';
				let statValue = 'Active';

				const salaryText = $tr.find('.salary, td:contains("$")').first().text().trim();
				const daysText = $tr.find('.no_of_day, td:contains("Day")').first().text().trim();
				const leaveTypeText = $tr.find('.leave_type').first().text().trim();

				if (salaryText) {
					statLabel = 'COMPENSATION VALUE';
					statValue = salaryText.startsWith('$') ? salaryText : '$' + salaryText;
				} else if (daysText) {
					statLabel = 'LEAVE DURATION & TYPE';
					statValue = daysText + (leaveTypeText ? ' (' + leaveTypeText + ')' : '');
				} else if ($tr.find('td:contains("Full Time"), td:contains("Part Time")').length > 0) {
					statLabel = 'EMPLOYMENT TYPE';
					statValue = $tr.find('td:contains("Full Time"), td:contains("Part Time")').first().text().trim();
				} else {
					statLabel = 'STATUS & TIMELINE';
					statValue = statusText || 'Confirmed';
				}

				$('#rd_stat_label').text(statLabel);
				$('#rd_stat_value').text(statValue);

				// 5. Contact & Meta Details List
				let email = '';
				let phone = '';
				let dept = subtitle || '';
				let dates = '';

				$tr.find('td').each(function() {
					const text = $(this).text().trim();
					if (text.indexOf('@') !== -1 && !email) {
						email = text;
					} else if ((text.startsWith('+') || text.match(/\d{3}[-\s]\d{3}/)) && !phone) {
						phone = text;
					} else if ((text.match(/\d{4}/) || text.indexOf('Jan') !== -1 || text.indexOf('Feb') !== -1 || text.indexOf('Mar') !== -1) && !dates && text.length > 5) {
						dates = text;
					}
				});

				if (email) {
					$('#rd_meta_email').text(email);
					$('#rd_meta_email_wrap').show();
				} else {
					$('#rd_meta_email_wrap').hide();
				}

				if (phone) {
					$('#rd_meta_phone').text(phone);
					$('#rd_meta_phone_wrap').show();
				} else {
					$('#rd_meta_phone_wrap').hide();
				}

				if (dept) {
					$('#rd_meta_dept').text(dept);
					$('#rd_meta_dept_wrap').show();
				} else {
					$('#rd_meta_dept_wrap').hide();
				}

				if (dates) {
					$('#rd_meta_dates').text(dates);
					$('#rd_meta_dates_wrap').show();
				} else {
					$('#rd_meta_dates_wrap').hide();
				}

				// 6. Notes & Reason Box
				const reasonText = $tr.find('.leave_reason, [class*="reason"], td:contains("retreat"), td:contains("vacation"), td:contains("illness")').first().text().trim();
				if (reasonText) {
					$('#rd_notes_label').text('REASON & JUSTIFICATION');
					$('#rd_notes_text').text(reasonText);
					$('#rd_notes_card').show();
				} else {
					$('#rd_notes_label').text('RECORD DETAILS');
					$('#rd_notes_text').text('Standard record registered in ' + (dept || 'Human Resources') + ' system.');
				}

				openRowDetailsDrawer();
			});

			// Drawer Footer Action Buttons (Hooked to Row actual actions)
			$('#rd_btn_edit').on('click', function(e) {
				e.preventDefault();
				if (!activeRowElement) return;
				const $editBtn = activeRowElement.find('.btn-action-edit, .leaveUpdate, .userSalary, .edit_job, a[data-target*="edit"], a[href*="edit"]').first();
				if ($editBtn.length) {
					closeRowDetailsDrawer();
					$editBtn[0].click();
				} else {
					alert('Edit option available in table action menu.');
				}
			});

			$('#rd_btn_delete').on('click', function(e) {
				e.preventDefault();
				if (!activeRowElement) return;
				const $delBtn = activeRowElement.find('.btn-action-delete, .leaveDelete, .salaryDelete, .delete_job, a[data-target*="delete"], a[href*="delete"]').first();
				if ($delBtn.length) {
					closeRowDetailsDrawer();
					$delBtn[0].click();
				} else {
					alert('Delete option available in table action menu.');
				}
			});
		});
	</script>
	@include('layouts.partials.datatables_enhance')
@yield('script')
</body>
</html>