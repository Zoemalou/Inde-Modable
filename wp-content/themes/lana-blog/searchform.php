<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
    <fieldset>
        <div class="input-group search">
            <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search', 'lana-blog' ); ?>"
                   value="<?php the_search_query(); ?>" class="form-control search-input"/>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
	                <span class="glyphicon glyphicon-search"></span>
                </button>
			</span>
        </div>
    </fieldset>
</form>