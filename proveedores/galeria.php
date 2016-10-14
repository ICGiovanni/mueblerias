<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';
?>

<div class="ibox-content">
    
    <div class="lightBoxGallery">
        <a href="<?php echo $raizProy?>img/gallery/1.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/1s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/2.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/2s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/3.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/3s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/4.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/4s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/5.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/5s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/6.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/6s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/7.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/7s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/8.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/8s.jpg"></a>
        <a href="<?php echo $raizProy?>img/gallery/9.jpg" title="Image from Unsplash" data-gallery=""><img src="<?php echo $raizProy?>img/gallery/9s.jpg"></a>


        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>

    </div>
                 
    
    
    <link href="<?php echo $raizProy?>css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
 
    <!-- Mainly scripts -->
    <script src="<?php echo $raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo $raizProy?>js/bootstrap.min.js"></script>
    <script src="<?php echo $raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $raizProy?>js/inspinia.js"></script>
    <script src="<?php echo $raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- blueimp gallery -->
    <script src="<?php echo $raizProy?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>