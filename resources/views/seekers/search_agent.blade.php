@include('seekers.layouts.header') 

<style>
    #dt_basic input[type='search']{
        color:green;
    }
</style>
<div class="page-head"> 
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">Look for an <span class="orange strong"> Agent </span></h1>               
            </div>
        </div>
    </div>
</div>
<!-- End page header --> 

<!-- property area -->
    <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
        <div class="container">   
            <div class="row">
            <table id="dt_basic" class="table table-striped table-bordered table-hover"  >
                <thead>			                
                    <tr>
                        <th style="width: 85%;">Agents</th> 
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            </div><!-- end row -->

    </div>
</div>

@include('seekers.layouts.footer') 
<script src="{{ asset('seekers_assets/assets/js/dataTables.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/dataTables.bootstrap.min.js'); }}"></script>
<script>
    //$(document).ready(function(){ 
        
        var oTable = $('#dt_basic').dataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax": "{{ route('seeker.query_agents'); }}", 
                            "columns": [

                                    {data: 'user', name: 'user'}, 

                                    {data: 'action', name: 'action', orderable: false, searchable: false},

                                ]
                        });
   // });
</script>
</body>
</html>