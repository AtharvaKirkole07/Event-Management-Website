<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.event-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.banner{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }
    .banner img{
        width: calc(100%);
        height: calc(100%);
        cursor :pointer;
    }
.event-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}

.event-list .banner {
    width: calc(40%)
}
.event-list .card-body {
    width: calc(60%)
}
.event-list .banner img {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.banner{
   min-height: calc(100%)
}
</style>
        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h3>
                        <hr class="divider my-4" />

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header>
            <div class="container mt-3 pt-2">
                <h4 class="text-center text-white">Our Events</h4>
                <hr class="divider">
                <?php
                $event = $conn->query("SELECT e.*,v.venue FROM events e inner join venue v on v.id=e.venue_id where date_format(e.schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' and e.type = 1 order by unix_timestamp(e.schedule) asc");
                while($row = $event->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['description']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
                <div class="card event-list" data-id="<?php echo $row['id'] ?>">
                     <div class='banner'>
                        <?php if(!empty($row['banner'])): ?>
                            <img src="admin/assets/uploads/<?php echo($row['banner']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row  align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <h3><b class="filter-txt"><?php echo ucwords($row['event']) ?></b></h3>
                                <div><small><p><b><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A",strtotime($row['schedule'])) ?></b></p></small></div>
                                <hr>
                                <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                                <br>
                                <hr class="divider"  style="max-width: calc(80%)">
                                <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                <?php endwhile; ?>
                
            </div>
            <section class="gallery" id="gallery">
                <img src="assets/hall4.avif"  height=300 width=300><img src="assets/marriage3.avif" height=300 width=300><img src="assets/g-4.jpg" height=300 width=300><img src="assets/hall5.jpg" height=300 width=300><img src="assets/chad2.jpg" height=300 width=300>
                <h4 class="text-center text-white"></h4>
                <hr class="divider">
                        </div>
            <div class="container mt-3 pt-2">
                <h4 class="text-center text-black" >MARRIAGE</h4>
                <hr class="divider">
                        </div>
                        <div class="container mt-3 pt-2">
                <h4 class="text-center text-black">BIRTHDAY PARTY</h4>
                <hr class="divider">
                        </div>
                        <div class="container mt-3 pt-2">
                <h4 class="text-center text-black">FAMILY GATHERING</h4>
                <hr class="divider">
                        </div>
                        <div class="container mt-3 pt-2">
                <h4 class="text-center text-black">RETIREMENT FUNCTION</h4>
                <hr class="divider">
                        </div>
                        <div class="container mt-3 pt-2">
                <h4 class="text-center text-black">ENGAGEMENT</h4>
                <hr class="divider">
                        </div>
        
        
    


<script>
     $('.read_more').click(function(){
         location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
     })
     $('.banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>