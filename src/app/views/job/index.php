<?php
if (isset($_SESSION['user_id'])) {
    require APPROOT . '/views/inc/jobs_header.php';
} else
if (isset($_SESSION['business_id'])) {
    require APPROOT . '/views/inc/jobs_header.php';
} else {
    require APPROOT . '/views/inc/jobs_header.php';
}
?>
<div class="col-lg-8 col-md-12">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
        <span class="woocommerce-result-count-left">Showing 10 jobs</span>
        <form class="woocommerce-ordering twm-filter-select" method="get">
            <span class="woocommerce-result-count">Sort By</span>

            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="category">
                <option>Most Recent</option>
                <option>Category</option>
                <option>Price</option>
            </select>

            <span class="woocommerce-result-count">Per Page</span>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>8</option>
                <option>15</option>
                <option>20</option>
            </select>
        </form>
    </div>
    <div class="row" id="jobs">
    </div>

    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="pagination-list clearfix">
                <!-- Pagination links will be dynamically generated here -->
                
            </ul>
        </div>
    </div>


</div>

<script>
    function redirectToJobDetail(url) {
        window.location.href = url;
    }
</script>

<script src="<?php echo URLROOT ?>/js/jobs/pagination.js"></script>

<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>