<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<!-- table to view transactions -->
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order Number</th>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td class="text-primary">123</td>
            <td>Social Media Expert</td>
            <td class="text-primary">$199</td>
            <td>18/08/2023</td>
            <td>Paypal</td>
            <td class="text-success">Success</td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td class="text-primary">123</td>
            <td>Social Media Expert</td>
            <td class="text-primary">$199</td>
            <td>18/08/2023</td>
            <td>Paypal</td>
            <td class="text-warning">Pending</td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td class="text-primary">123</td>
            <td>Social Media Expert</td>
            <td class="text-primary">$199</td>
            <td>18/08/2023</td>
            <td>Paypal</td>
            <td class="text-danger">Rejected</td>
            <td></td>
        </tr>
    </tbody>
</table>