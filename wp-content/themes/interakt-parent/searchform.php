<div class="widget-container widget_search">
    <h3><?php _e('Search widget:','tfuse');?></h3>
    <div class="inner">
        <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
            <div>
                <input type="text" value="Search this blog" onfocus="if (this.value == 'Search this blog') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search this blog';}" name="s" id="s" class="inputField" />
                <input type="submit" id="searchsubmit"  class="btn-submit"  value="Search" onfocus="if (this.value == 'Search') {this.value = '';}"/>
            <div class="clear"></div>
            </div>
        </form>
    </div>
</div>
