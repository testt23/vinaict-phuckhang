
<div id="sitemap">
    <h2 class="title-map"><?php echo lang('site_map') ?></h2>
    <div class="sitemap-wrapper">
        <?php Menu::drawMenu($array_menus, $selected); ?>
    </div>
    
</div>