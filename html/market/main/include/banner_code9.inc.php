<script type="text/javascript">
                animation: "",
                pauseOnAction: false,
                pauseOnHover: true,
                controlNav: true,
                slideshow: false,
                directionNav: false,
                animationSpeed: 1000,
                slideshowSpeed: 5000,
            });
        });
    })(jQuery);
</script>
<?
$banner_code = "banner_code9";
if($db->cnt( "cs_banner", "where status='$banner_code'" )) {
?>
<div class="slides_banner">