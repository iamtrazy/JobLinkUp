<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">

<main class="table table-bordered" id="customersTable">
        <section class="table__header">
           
           
            
        </section>
        <section class="table__body table-bordered">
            <table>
                <thead>
                    <tr>
                        <th> Dipute Id </th>
                        <th> Name 01 (From) </th>
                        <th> Name 02 (To) </th>
                        <th> Description </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 1 </td>
                        <td>Zinzu Chan Lee</td>
                        <td>Jeet Saru</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, sapiente!</td>
                        <td><div style="display: flex;"> <button class="approve-btn" role="button">Approve</button> <button class="reject-btn" role="button">Reject</button> </div></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>John Doe</td>
                        <td>Jane Smith</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, maiores.</td>
                        <td>
                            <div style="display: flex;">
                                <button class="approve-btn" role="button">Approve</button>
                                <button class="reject-btn" role="button">Reject</button>
                            </div>
                        </td>
                    </tr>
                    
                  
                    
                </tbody>
            </table>
        </section>
    </main>
    </div>
</div>

    
    <script>
        const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

// 1. Searching for specific data of HTML table
search.addEventListener('input', searchTable);

function searchTable() {
    table_rows.forEach((row, i) => {
        let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();

        row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
        row.style.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
        visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
    });
}

    </script>


<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>





    <?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>