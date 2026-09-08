<!-- Slide-Out Filter Drawer Overlay -->
<div class="filter-drawer-overlay" id="filter_drawer_overlay"></div>

<!-- Slide-Out Filter Drawer (Pure HR Filters matching Screenshot 2) -->
<div class="filter-drawer-wrapper" id="filter_drawer_wrapper">
    <div class="filter-drawer-header">
        <h3 class="filter-drawer-title">Filter</h3>
        <button type="button" class="close-filter-btn" id="close_filter_btn" title="Close Filter">&times;</button>
    </div>

    <div class="filter-drawer-body">
        <!-- 1. Sorting -->
        <div class="filter-group-card">
            <h4 class="filter-group-title">Sorting</h4>
            <div class="filter-options-grid">
                <label class="filter-radio-label">
                    <input type="radio" name="hr_sort_order" value="default" checked>
                    <span class="custom-radio-mark"></span>
                    <span class="filter-opt-text">Default (Recent Created)</span>
                </label>
                <label class="filter-radio-label">
                    <input type="radio" name="hr_sort_order" value="older">
                    <span class="custom-radio-mark"></span>
                    <span class="filter-opt-text">Show Older First</span>
                </label>
                <label class="filter-radio-label">
                    <input type="radio" name="hr_sort_order" value="asc">
                    <span class="custom-radio-mark"></span>
                    <span class="filter-opt-text">Alphabetical (A - Z)</span>
                </label>
                <label class="filter-radio-label">
                    <input type="radio" name="hr_sort_order" value="desc">
                    <span class="custom-radio-mark"></span>
                    <span class="filter-opt-text">Alphabetical (Z - A)</span>
                </label>
            </div>
        </div>

        <!-- 2. Department -->
        <div class="filter-group-card">
            <h4 class="filter-group-title">Department</h4>
            <div class="filter-options-grid">
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="Web Department">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Web Department</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="IT Management">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">IT Management</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="Marketing">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Marketing</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="Human Resources">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Human Resources</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="Finance">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Finance & Accounting</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_department[]" value="Product & UX">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Product & UX</span>
                </label>
            </div>
        </div>

        <!-- 3. Status -->
        <div class="filter-group-card">
            <h4 class="filter-group-title">Status</h4>
            <div class="filter-options-grid">
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_status[]" value="Active">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Active / Open</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_status[]" value="Inactive">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Inactive / Closed</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_status[]" value="Approved">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Approved</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_status[]" value="Pending">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Pending</span>
                </label>
            </div>
        </div>

        <!-- 4. Employment / Job Type -->
        <div class="filter-group-card">
            <h4 class="filter-group-title">Employment / Job Type</h4>
            <div class="filter-options-grid">
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_job_type[]" value="Full Time">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Full Time</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_job_type[]" value="Part Time">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Part Time</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_job_type[]" value="Internship">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Internship</span>
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="hr_job_type[]" value="Remote">
                    <span class="custom-checkbox-mark"></span>
                    <span class="filter-opt-text">Remote</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Fixed Footer Action Buttons -->
    <div class="filter-drawer-footer">
        <button type="button" class="btn-clear-filter" id="btn_clear_hr_filter">Clear Filter</button>
        <button type="button" class="btn-apply-filter" id="btn_apply_hr_filter">Apply</button>
    </div>
</div>
