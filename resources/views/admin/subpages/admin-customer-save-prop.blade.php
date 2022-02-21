<table id="savePropTable" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th style="width:30px">Property Image</th>
            <th>Title</th>  
            <th>Date of Birth</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<script src="{{ asset('admin_assets/js/plugin/datatables/jquery.dataTables.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.colVis.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.tableTools.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.bootstrap.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); }}"></script>
<script>

    $(document).ready(function(){

        $('#savePropTable').dataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "{{ route('admin.view_favorite'); }}",
                    "data": { "customer_id": <?php echo $customer_id; ?>},
					"columns": [
                            {data: 'prop_img', name: 'prop_img'},
							
							{data: 'title', name: 'title'},

							{data: 'amount', name: 'amount'}, 

							{data: 'action', name: 'action', orderable: false, searchable: false},

						]
				});

    });

</script>