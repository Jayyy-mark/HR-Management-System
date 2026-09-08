<script>
	// =====================================================================
	// SCREENSHOT-1 MATCHING UI ORCHESTRATOR
	// =====================================================================
	(function () {
		// --- Emoji / icon lookup by page keyword ---
		const titleIcon = {
			department: 'ðŸ¢', designation: 'ðŸ·ï¸', employee: 'ðŸ‘¥', attendance: 'â°',
			timesheet: 'ðŸ“…', overtime: 'â³', holiday: 'ðŸŒ´', shift: 'ðŸ”„', leaves: 'ðŸ“†',
			job: 'ðŸ’¼', candidate: 'ðŸ‘¤', resume: 'ðŸ“„', interview: 'ðŸ—£ï¸', offer: 'ðŸ¤',
			payroll: 'ðŸ’°', salary: 'ðŸ’µ', report: 'ðŸ“Š', invoice: 'ðŸ§¾', expense: 'ðŸ’¸',
			payment: 'ðŸ’³', trainer: 'ðŸ‘¨â€ðŸ«', training: 'ðŸŽ“', performance: 'ðŸ“ˆ', user: 'ðŸ”',
			setting: 'âš™ï¸', asset: 'ðŸ› ï¸'
		};
		function iconForPage() {
			const path = (window.location.pathname || '').toLowerCase();
			const title = $('.page-title').first().text().trim().toLowerCase();
			for (const k in titleIcon) {
				if (path.indexOf(k) !== -1 || title.indexOf(k) !== -1) return titleIcon[k];
			}
			return 'ðŸ“„';
		}

				// --- 0. Auto-wrap legacy tables into a card container (if not already modern) ---
		function wrapTables() {
			$('table.datatable, table.dataTable, .custom-table').each(function () {
				const $t = $(this);
				if ($t.closest('.datatable-card-container').length) return;
				const $trResp = $t.closest('.table-responsive');
				if ($trResp.length && !$trResp.closest('.datatable-card-container').length) {
					$trResp.wrap('<div class="datatable-card-container"></div>');
				} else {
					$t.wrap('<div class="datatable-card-container"><div class="table-responsive"></div></div>');
				}
			});
		}
		wrapTables();

		// --- 1. Wrap page title with icon chip + count pill ---
				function buildPageTitle() {
			const $pt = $('.page-title').first();
			if (!$pt.length || $pt.parent('.page-title-badge-wrapper').length) return;
			const icon = $pt.data('icon') || iconForPage();
			$pt.wrap('<div class="page-title-badge-wrapper"></div>');
			const $wrapper = $pt.parent();
			$('<span class="page-title-icon-badge" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:10px;background:#eff6ff;color:#2563eb;font-size:18px;">' + icon + '</span>').prependTo($wrapper);
			$('<span class="page-title-count-pill">0</span>').insertAfter($pt);
		}
		buildPageTitle();

		// --- 2. Inject "+ Add new" button into toolbar ---
		function attachAddButton() {
			const $toolbar = $('.datatable-btn-actions').first();
			if (!$toolbar.length || $toolbar.find('.btn-add-primary').length) return;
			const $addSource = $('.page-add-action').filter(':first').length
				? $('.page-add-action').filter(':first')
				: $('.page-header .add-btn').filter(':first');
			if (!$addSource.length) return;
			const pageTitle = $('.page-title').first().text().replace(/[0-9]/g, '').trim() || 'Record';
			const addText = $addSource.text().trim().replace(/^Add\s*/i, '') || pageTitle;
			const $addBtn = $('<a>', {
				href: $addSource.attr('href') || '#',
				'class': 'btn-add-primary',
				'data-toggle': $addSource.attr('data-toggle') || undefined,
				'data-target': $addSource.attr('data-target') || undefined
			}).html('<i class="fa fa-plus"></i> Add new ' + addText + '</a>');
			$toolbar.prepend($addBtn);
			$('.page-header .add-btn').hide();
			$('.page-add-action').hide();
		}
				// --- 3. Convert row dropdown menus into icon buttons ---
		function classifyAction(text) {
			text = (text || '').toLowerCase();
			if (text.indexOf('delete') !== -1) return { cls: 'btn-action-delete', icon: 'fa fa-trash' };
			if (text.indexOf('edit') !== -1) return { cls: 'btn-action-edit', icon: 'material-icons', label: 'edit' };
			if (text.indexOf('view') !== -1 || text.indexOf('eye') !== -1) return { cls: 'btn-action-view', icon: 'fa fa-eye' };
			if (text.indexOf('print') !== -1 || text.indexOf('barcode') !== -1) return { cls: 'btn-action-chart', icon: 'fa fa-barcode' };
			return { cls: 'btn-action-view', icon: 'fa fa-ellipsis-v' };
		}
		function convertRowActions() {
			$('table.dataTable tbody, .datatable tbody, .custom-table tbody').each(function () {
				$(this).find('tr').each(function () {
					const $tr = $(this);
					const $dropdown = $tr.find('.dropdown.dropdown-action').filter(':first');
					if (!$dropdown.length || $tr.find('.table-action-square-group').length) return;
					const $cell = $dropdown.closest('td, th');
					const preserved = [];
														const buttons = [];
					// 1. Always add a View (eye) button that opens the row-details drawer
					buttons.push('<a href="#" class="btn-action-square btn-action-view" title="View"><i class="fa fa-eye"></i></a>');
					$dropdown.find('.dropdown-item, a').each(function () {
						const $a = $(this);
						if ($a.hasClass('d-none')) return;
						const text = $a.text().trim();
						if (!text) return;
						const info = classifyAction(text);
						const $btn = $('<a>', {
							href: $a.attr('href') || '#',
							'class': 'btn-action-square ' + info.cls,
							'data-toggle': $a.attr('data-toggle') || undefined,
							'data-target': $a.attr('data-target') || undefined,
							'data-href': $a.attr('data-href') || undefined,
							title: text
						});
						// preserve original page-specific classes (e.g. edit_department) so per-page JS keeps working
						($a.attr('class') || '').split(' ').forEach(function (c) {
							if (c && !['dropdown-item', 'dropdown-toggle'].includes(c) && preserved.indexOf(c) === -1) preserved.push(c);
						});
						if (preserved.length) $btn.addClass(preserved.join(' '));
						const $icon = $a.find('i').filter(':first').clone();
						if ($icon.length) { $btn.append($icon); }
						else { $btn.append('<i class="' + info.icon + (info.label ? '">' + info.label + '</i>' : '"></i>')); }
						buttons.push($btn[0].outerHTML);
					});
					if (buttons.length) {
						$cell.html('<div class="table-action-square-group">' + buttons.join('') + '</div>');
					}
				});
			});
		}
		// View icon opens row-details drawer
		$(document).on('click', '.btn-action-view', function (e) {
			e.preventDefault();
			$(this).closest('tr').trigger('click');
		});

				// --- 4. Count pill updater ---
		function getActiveDataTable() {
			if ($.fn.dataTable.isDataTable('.datatable')) return $('.datatable').DataTable();
			if ($.fn.dataTable.isDataTable('table.dataTable')) return $('table.dataTable').DataTable();
			return null;
		}
		function updateCountPill() {
			const dt = getActiveDataTable();
			if (dt && dt.page && typeof dt.page.info === 'function') {
				try { $('.page-title-count-pill').text(dt.page.info().recordsTotal); } catch (err) { /* dt not ready */ }
			}
		}
		// Attach draw listener once DataTables are initialized by app.js
		function registerCountListener() {
			let $firstDt = $('table.datatable, table.dataTable').first();
			if ($firstDt.length && $.fn.dataTable.isDataTable($firstDt)) {
				const dtApi = $firstDt.DataTable();
				if (dtApi && typeof dtApi.on === 'function') dtApi.on('draw end page', updateCountPill);
				updateCountPill();
			} else if ($firstDt.length) {
				setTimeout(registerCountListener, 150);
			}
		}
		setTimeout(registerCountListener, 150);

		// --- 5. Optional iOS toggles in status columns ---
		function buildToggles() {
			$('table.dataTable tbody, .datatable tbody, .custom-table tbody').each(function () {
				$(this).find('tr').each(function () {
					const $tr = $(this);
					const $statusTd = $tr.find('td').filter(function () {
						return $(this).find('span.status-dot, .badge').length ||
							$(this).text().match(/^\s*(active|inactive|enabled|disabled|paid|unpaid|completed|pending)\s*$/i);
					}).filter(':first');
					if (!$statusTd.length || $statusTd.find('.dt-toggle-switch').length) return;
					const onState = /active|enabled|paid|completed/i.test($statusTd.text());
					const $editRef = $tr.find('[data-target*="edit"], .edit_btn, .edit_department').first();
					const $toggle = $('<label class="dt-toggle-switch"><input type="checkbox" ' + (onState ? 'checked' : '') + '><span class="dt-toggle-slider"></span></label>');
					$toggle.on('change', function () {
						if ($editRef.length) { $editRef[0].click(); $(this).prop('checked', !this.checked); }
					});
					$statusTd.html($toggle);
				});
			});
		}

		// Public hooks
		window.HRToggleConvert = function () { buildToggles(); };
		window.HRConvertActions = function () { convertRowActions(); attachAddButton(); updateCountPill(); };

		setTimeout(function () { convertRowActions(); attachAddButton(); buildToggles(); updateCountPill(); }, 300);
	})();
</script>
