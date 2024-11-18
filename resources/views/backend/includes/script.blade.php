<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<!-- DataTable Script and Initialization -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/bs4/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive-bs4/2.4.0/js/responsive.bootstrap4.min.js"></script>


<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Include Dropify JS and CSS from jsdelivr -->
<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

<script>
    // Initialize Dropify
    $(document).ready(function() {
        // Initialize Dropify
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or <span>click</span>'
            }
        });
    });

</script>

@stack('js')
<script>
    $('form').submit(function() {
        $(this).find(':submit').attr('disabled', 'disabled');
        //the rest of your code
        setTimeout(() => {
            $(this).find(':submit').attr('disabled', false);
        }, 2000)
    });

</script>

<script>
    $(document).ready(function() {
        // Check if the DataTable is already initialized
        if (!$.fn.dataTable.isDataTable('#datatable')) {
            console.log("Initializing DataTable...");

            var table = $('#datatable').DataTable({
                paging: true,           // Enable pagination
                searching: true,        // Enable search box
                lengthChange: true,     // Enable changing the number of records per page
                info: true,             // Show table information (e.g., "Showing 1 to 10 of 50 entries")
                autoWidth: true,       // Disable auto column width adjustment
                responsive: true,       // Make table responsive on smaller screens
                scrollX: true,         // Enable horizontal scrolling
                order: [[0, 'asc']],    // Initial sort by the first column (ID) in ascending order
                columnDefs: [{
                    targets: 1,          // Assuming the second column (index 1) is "Name"
                    type: 'string'       // Case-insensitive sorting for string values
                }],
                lengthMenu: [
                    [5, 10, 20, 50, 100],  // Page length options
                    ['5', '10', '20', '50', '100']  // Labels for the options
                ],
                language: {
                    search: 'Search Records:',           // Custom search box placeholder
                    lengthMenu: 'Display _MENU_ records per page',  // Custom page length menu
                    zeroRecords: 'No matching records found',   // Custom message when no records match the search
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',  // Custom info message
                    infoEmpty: 'No records available',            // Custom message when the table is empty
                    infoFiltered: '(filtered from _MAX_ total records)'  // Custom filtered message
                }
            });

            // Log table initialization success
            console.log("DataTable initialized successfully.");

            // Adjust table layout on window resize
            $(window).on('resize', function() {
                table.columns.adjust();
            });
        } else {
            console.log("DataTable is already initialized.");
        }
    });
</script>


@stack('js')
