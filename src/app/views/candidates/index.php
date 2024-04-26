<?php require APPROOT . '/views/inc/explore_header.php'; ?>


<div class="col-lg-8 col-md-12">
    <!--Filter Short By-->
    <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
        <span class="woocommerce-result-count-left">Showing  Candidates</span>

        <form class="woocommerce-ordering twm-filter-select" method="get">
            <span class="woocommerce-result-count">Sort By</span>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="category">
                <option>Date Joined</option>
                <option>Profile Completion</option>
            </select>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>10</option>
                <option>20</option>
            </select>
        </form>

    </div>

    <div class="twm-candidates-grid-wrap">
        <div class="row">
            <!-- Candidates will be dynamically generated here -->
        </div>
    </div>

    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="pagination-list clearfix">
                <!-- Pagination links will be dynamically generated here -->
            </ul>
        </div>
    </div>

</div>

<script src="<?php echo URLROOT ?>/js/candidates/pagination.js"></script>

<?php require APPROOT . '/views/inc/explore_footer.php'; ?>