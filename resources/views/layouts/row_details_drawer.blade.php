<!-- Slide-Out Record Details Drawer Overlay (Screenshot 4) -->
<div class="row-details-drawer-overlay" id="row_details_drawer_overlay"></div>

<!-- Slide-Out Record Details Drawer (Matching Screenshot 4) -->
<div class="row-details-drawer-wrapper" id="row_details_drawer_wrapper">
    <div class="row-details-header">
        <h3 class="row-details-title" id="row_details_header_title">Record details</h3>
        <button type="button" class="close-row-details-btn" id="close_row_details_btn" title="Close Details">&times;</button>
    </div>

    <div class="row-details-body">
        <!-- 1. Entity Hero Block -->
        <div class="entity-hero-block">
            <div class="entity-avatar-circle" id="rd_avatar_circle">
                <span id="rd_avatar_char">D</span>
                <img id="rd_avatar_img" src="" alt="Avatar" style="display: none;">
            </div>
            <div class="entity-titles">
                <h2 class="entity-main-title" id="rd_main_title">Record Title</h2>
                <div class="entity-subtitle" id="rd_subtitle">Department / Role</div>
                <div class="entity-badges-row" id="rd_badges_row">
                    <span class="pill-badge-blue" id="rd_status_badge"><span class="dot"></span> Active</span>
                    <span class="pill-badge-amber" id="rd_type_badge">Standard</span>
                </div>
            </div>
        </div>

        <!-- 2. Highlight Stat Card (Screenshot 4) -->
        <div class="stat-highlight-card" id="rd_stat_card">
            <div class="stat-sub-label" id="rd_stat_label">STATUS & TIMELINE</div>
            <div class="stat-headline-value" id="rd_stat_value">Active Record</div>
        </div>

        <!-- 3. Key Contact & Meta Info List (Screenshot 4) -->
        <div class="meta-info-list" id="rd_meta_list">
            <div class="meta-info-item" id="rd_meta_email_wrap">
                <i class="fa fa-envelope-o meta-info-icon"></i>
                <span class="meta-info-text" id="rd_meta_email">contact@company.com</span>
            </div>
            <div class="meta-info-item" id="rd_meta_phone_wrap">
                <i class="fa fa-phone meta-info-icon"></i>
                <span class="meta-info-text" id="rd_meta_phone">+1 555 0100</span>
            </div>
            <div class="meta-info-item" id="rd_meta_dept_wrap">
                <i class="fa fa-building-o meta-info-icon"></i>
                <span class="meta-info-text" id="rd_meta_dept">Corporate Department</span>
            </div>
            <div class="meta-info-item" id="rd_meta_dates_wrap">
                <i class="fa fa-calendar-o meta-info-icon"></i>
                <span class="meta-info-text" id="rd_meta_dates">Date Range</span>
            </div>
        </div>

        <!-- 4. Notes / Description Section (Screenshot 4) -->
        <div class="notes-section-card" id="rd_notes_card">
            <div class="notes-header-label" id="rd_notes_label">NOTES & REASON</div>
            <p class="notes-body-text" id="rd_notes_text">No additional notes provided for this record.</p>
        </div>

        <!-- 5. AI Summary Card (Screenshot 4) -->
        <div class="ai-summary-card">
            <div class="ai-summary-left">
                <i class="fa fa-magic"></i>
                <span>AI Record Insights</span>
            </div>
            <button type="button" class="btn-ai-analyze" id="rd_ai_analyze_btn">Analyze</button>
        </div>

        <!-- 6. Secondary Action Button (Screenshot 4) -->
        <button type="button" class="btn-secondary-action-pill" id="rd_secondary_action_btn">
            <i class="fa fa-paper-plane-o"></i>
            <span>Send Record Notification</span>
        </button>
    </div>

    <!-- 7. Footer Action Buttons (Screenshot 4) -->
    <div class="row-details-drawer-footer">
        <button type="button" class="btn-drawer-edit" id="rd_btn_edit">
            <i class="fa fa-pencil"></i> Edit
        </button>
        <button type="button" class="btn-drawer-delete" id="rd_btn_delete">
            <i class="fa fa-trash-o"></i> Delete
        </button>
    </div>
</div>
