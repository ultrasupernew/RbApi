<?php

$rsp = file_get_contents("http://api.redbull.com/v2/stories/event/1331590801827/locales/ja_jp/sortby/startdate/sortorder/desc/pagination/1-10");

$data = json_decode($rsp, true);

?>

<ul>
    <?php foreach($data["stories"] as $story) : ?>
        <li style="width:400px; max-width: 400px; border-bottom: 1px solid black"> 
            <a href="<?php echo $story["url"] ?>" style="display:block; text-decoration: none;">
            <p><img style="width:400px;" src="<?php echo $story["featuredimage"] ?>"  /></p>
            <h2><?php echo $story["title"] ?></h3>
            <p><?php echo $story["publisheddate"] ?></p>
            <h3><?php echo $story["teaser"] ?></h2>
            </a>
            
            <p></p>
        </li>
    <?php endforeach ?>

</ul>
