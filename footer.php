</div>
    <!-- /container -->
 
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="js/deleteTask.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "ordering": true,
            "searching": false,
            "info":     false,
            "dom": '<"toolbar">frtip',
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [3,4,5]
            } ],
            "lengthMenu": [3]
    });
});

</script>
<!-- end HTML page -->
</body>
</html>