<div class="five columns ml10"  id="right-content">
  <div class="row notice-board">
     <div id="full-row">
      <ul>
      <h4>Recent News</h4>
       <marquee style="height:160px" behavior="scroll" direction="up" scrollamount="2.0" onmouseover="stop();" onmouseout="start();">
        <?php 
		 $qry_recent_news = mysql_query("SELECT * FROM bnews") or die(mysql_error());// LIMIT 0,5
		 while($row_recent_news = mysql_fetch_array($qry_recent_news)){
	    ?>
        
        <li>
           <a href="<?php echo urlroute('recent_news'); ?>&news_id=<?php echo $row_recent_news['bn_id'];?>"><?php echo $row_recent_news['bnews_title'];?></a>
        </li>
        <?php }?> 
         </marquee>                     
       </ul>	
      
    </div>
</div>


 <ul class="graphical-service-btn" >
    <h4 style="color: #6b2f91;">Add Services</h4>
    <?php 
		 $qry_adds = mysql_query("SELECT * FROM right_add LIMIT 0,5") or die(mysql_error());
		 while($row_adds = mysql_fetch_array($qry_adds)){
	    ?>
      <li>
         <a target="_blank" href="<?php echo urlroute('all_add_news'); ?>&add_id=<?php echo $row_adds['right_add_id'];?>">
           <img src="images/right_add/thumbs/small<?php echo $row_adds['image'];?>" alt="" width="315" height="60"/>
        </a>
      </li>
      
     <?php }?>           
    </ul>

</div>

<style>


.circle {
    display: table-cell;
    background: hsla(130, 67%, 53%, 0.82);
    width: 85px;
    height: 85px;
    border-radius: 50%;
    color: black;
    text-align: center;
    border: solid 6px white;
    font-family: Segoe UI Light;
    box-shadow: 0px 0px 0px black;
    cursor: pointer;
}
.circle .innerTEXT{
  position:relative;
  top:10px;
  left:1px;
  color:#444;
  font-weight: bold;
  text-shadow:0px 0px 0px black;
}
</style>

