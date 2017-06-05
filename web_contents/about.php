<style type="text/css">
	h5:hover
	{
		transition: 0.3s ease-in-out;
    	color: #FFA000;
	}
	a:hover
	{
		text-decoration: none;
	}
	.featured-box 
	{
		background: #FFF;
	}
	.featured-box-tertiary-second h4
	{
		color:#FFB300;
	}
	.featured-box-tertiary-second .box-content
	{
		border-top-color:#FFB300;	
	}
	.featured-box-tertiary-second .icon-featured
	{
		background-color:#FFB300;
	}
	
	.featured-box-effect-2.featured-box-tertiary-second .icon-featured:after 
	{
		box-shadow: 0 0 0 3px #FFB300;
	}
	.featured-box-quaternary-second h4
	{
		color:#43A047;
	}					
	.featured-box-quaternary-second .box-content
	{
		border-top-color:#43A047;	
	}
	.featured-box-quaternary-second .icon-featured
	{
		background-color:#43A047;
	}
	.featured-box-effect-2.featured-box-quaternary-second .icon-featured:after {
		box-shadow: 0 0 0 3px #43A047;
	}

</style>

<!DOCTYPE html>
<html>
	<body>
		<section class="section m-none">
			<div class="container">
				<br><br>
				<div class="row">
					<div class="col-md-12">
					    <?php
					        $query = "SELECT * FROM tbl_web_about";
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
