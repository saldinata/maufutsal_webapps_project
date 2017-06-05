<!DOCTYPE html>
<html>
	<body>
		<section class="section m-none">
			<div class="container">
				<br><br>
				<div class="row">
					<div class="col-md-12">
					    <?php
					    
					        $query = "SELECT * FROM tbl_web_career";
					        $result_data = $db->getAllValue($query);
					        
					        foreach($result_data as $data)
					        {
					            echo $data['content'];
					        }
					    
					    ?>
					</div>
				</div>
			</div>
		</section>
