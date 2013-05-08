<style>
    /*
    #lb_table tbody > tr:last-of-type{
        background-color: red;
    }
    */
    td {
        vertical-align: middle;
    }

    .user_img {
        margin-left: 10px;
        height: 40px;
    }

    .user_name {
        margin-left: 10px;
    }
</style>
<p class="main_page_headers"><span>WINNERS</span></p>
<div style=" margin-bottom: 20px; " >
	<div id="extra_div_lb" style="width: 95%; margin: 0 auto; ">
        <?php foreach($response as $event_key=>$event_value){ ?>
            <?php if ($event_value['data'] != NULL) {?>
                <h2 style="font-weight: bold; font-size: 18px;"><?php echo $event_value['event_title']; ?></h2>
                <table class='td_bg' id='lb_table' >
                    <tr class='tr_bg'>
                        <td style='text-align: center;'>
                            <h5>Rank</h5>
                        </td>
                        <td style='text-align: center;'>
                            <h5>Name</h5>
                        </td>
                        <td style='text-align: center;'>
                            <h5>Net Worth</h5>
                        </td>
                    </tr>
                    <?php foreach($event_value['data'] as $leader_key=>$leader_value){ ?>
                        <tr id="<?php echo $leader_key;?>" >
                            <td style="text-align: center; width: 15%;">
                                <span><?php echo $leader_value['rank'];?></span>
                            </td>
                            <td style="width: 62%;">
                                <img style="cursor: pointer;" class="user_img" src="https://graph.facebook.com/<?php echo $leader_value['uid']; ?>/picture"/>
                                <span><?php echo $leader_value['first_name']." ".$leader_value['last_name'];?></span>
                            </td>
                            <td style="width: 23%; " >
                                <span style=" float: right; margin-right: 3px;" ><?php echo $leader_value['sum_amount']; ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
            <?php } ?>
        <?php } ?>
	</div>
    <!--
	<div style="position: relative; width: 47%; float: left; margin-left: 6%;" >
		<table id="lb_my" class="td_bg">
			<tr class='tr_bg'>
				<td style="text-align: center; width: 15%;" >
					<h5>My Rank</h5> 
				</td>
				<td style="text-align: center; width: 62%; ">
					<h5>Name</h5>	
				</td>
				<td style="text-align: center; width: 23%;">
					<h5>Net Worth</h5>
				</td>
			</tr>
			<tr>
				<td style="text-align: center; width: 15%;" >
					<span id="my_rank"><?php echo $my_info['myrank']; ?></span>
				</td>
				<td id="my_name" style=" width: 62%;" >
                    <img style="cursor: pointer;" class="user_img" src="https://graph.facebook.com/<?php echo $my_info['myuid']; ?>/picture"/>
                    <span><?php echo $my_info['myfirst_name']." ".$my_info['mylast_name'];?></span>
				</td>
				<td style=" width: 23%;" >
                    <span style=" float: right; margin-right: 3px;" ><?php echo $my_info['myclosing_balance']; ?></span>
				</td>
			</tr>
		</table>
		<table style="margin-top: 40px;">
			
		</table>
	</div>
	-->
</div>

<?php
	$this->breadcrumbs=array(
		'Winners'
	);
?>