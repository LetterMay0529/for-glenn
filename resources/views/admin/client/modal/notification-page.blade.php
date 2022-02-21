<?php //echo json_encode($data); ?>

<ul class="notification-body">

<?php foreach($new_data as $list){ ?>
    <li>
		<span class="padding-10 <?php echo $list['status']; ?>">

			<em class="badge padding-5 no-border-radius bg-color-green pull-left margin-right-5">
				<i class="fa fa-bell fa-fw fa-5x"></i>
			</em>
			
			<span>
                <p><strong><?php echo $list['subject']; ?></strong></p>
                <?php 
                    if (strlen($list['content']) > 50) {

                        $stringCut = substr($list['content'], 0, 50);
                        $endPoint = strrpos($stringCut, ' ');
                    
                        //if the string doesn't contain any space then it will cut without word basis.
                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $content =  $string .= '...';
                        
                    }else{
                        $content = $list['content']; //$request->date_end->format('Y-m-d'); // human readable format
                    }
                
                
                echo $content; ?> - <a href="/agent/view_announcement_details/<?php echo $list['announcement_id']; ?>" class="display-normal">Open</a>
				 <br>
				 <span class="pull-right font-xs text-muted"><i><?php echo date('F d, Y h:i A', strtotime($list['created'])); ?></i></span>
			</span>
			
		</span>
	</li>
<?php } ?>
</ul>