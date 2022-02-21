<div class="row">
    <div class="col-md-4">
        <img src="<?php echo asset('property_img/'.$data[0]['prop_img']); ?>" class="img-responsive" alt="img">
      
    </div>
    <div class="col-md-8 padding-left-0">
        <h3 class="margin-top-0"><a href="javascript:void(0);"> <?php echo $data[0]['title']; ?> </a><br><small class="font-xs"><i>Price: <a href="javascript:void(0);"><?php echo "₱ ".number_format((int)$data[0]['amount'],2)?></a></i></small></h3>
        <p>
            <?php echo  $data[0]['description']; ?>
            <br><br>
        </p> 
    </div>
    </div>
    <hr>
    <center><h3>Property Stock Photos</h3></center>
<form action="{{ route('agent.upload_image_property'); }}" class="dropzone" id="mydropzone">@csrf

<input type="hidden" name="property_id" value="<?php echo $request->prop_id; ?>">
</form>
<script src="{{ asset('admin_assets/js/plugin/dropzone/dropzone.min.js'); }}"></script>
<script>
    $(document).ready(function() {
    
        pageSetUp();

        Dropzone.autoDiscover = false;
        $("#mydropzone").dropzone({
            //url: "/file/post",
            addRemoveLinks : true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFilesize: 0.5,
            dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
            dictResponseError: 'Error uploading file!',
            removedfile: function(file) { 

                var name = file.name;   
                console.log(file.name);       
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: 'POST',
                    url: '{{ route("agent.delete_property_photo"); }}',
                    data: {filename:name},
                    dataType: 'html'
                });
                var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },


            success: function(file, response) {
                    console.log(response);
            },

            error: function(file, response) {
                        alert(response);
                return false;
            },
            init: function() { 

            //start ----> code to show thumbnail in fullwidth
            this.on("thumbnail", function(file, dataUrl) {
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
            }),
            // this.on("success", function(file) {
            //     $('.dz-image').css({"width":"100%", "height":"auto"});
            // })
            //end ----> code to show thumbnail in fullwidth
            myDropzone = this;

                $.ajax({
                    url: '{{ route("agent.fetch_existing_img"); }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'post',
                    data: {"property_id": <?php echo $request->prop_id; ?>},
                    dataType: 'json',
                    success: function(response){

                        $.each(response, function(key,value) {

                        var mockFile = { name: value.name, size: value.size};

                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, "<?php echo asset('property_img');?>"+'/'+value.name);
                            myDropzone.emit("complete", mockFile);

                        });
                    }

                });

            }
        });

    });
</script>