/**
 * Javascript for the "Classic" shop skin
 */

var _nails_skin_shop_front_classic;
_nails_skin_shop_front_classic = function()
{
	this._product_single_image_gallery_inited_xssm = false;
	this._product_single_image_gallery_inited_mdlg = false;

	// --------------------------------------------------------------------------

	/**
	 * Constructs the shop JS. Conditionally initiates items depending on the
	 * actively viewed page.
	 * @return void
	 */
	this.__construct = function()
	{
		//	Scope hack
		var _this = this;

		// --------------------------------------------------------------------------

		//	Product sorter
		if ( $( '.nails-shop-skin-front-classic .product-sort' ).length > 0 )
		{
			this._browse_sorter_init();
		}

		// --------------------------------------------------------------------------

		//	Sidebar lists
		this._browse_sidebar_lists_init();

		// --------------------------------------------------------------------------

		//	Sidebar filter
		if ( $( '.nails-shop-skin-front-classic .sidebar-filter' ).length > 0 )
		{
			this._browse_sidebar_filter_init();
		}

		// --------------------------------------------------------------------------

		//	Single product page malarky
		if ( $( '.nails-shop-skin-front-classic.browse.product.single' ).length > 0 )
		{
			this._product_single_image_gallery_init();
			this._product_single_image_zoomer_init();
			this._popover_init();

			$(window).on( 'resize', function()
			{
				_this._product_single_image_gallery_init();
			});
		}

		// --------------------------------------------------------------------------

		if ( $( '.nails-shop-skin-front-classic.processing' ).length > 0 )
		{
			this._processing_init();
		}

        // --------------------------------------------------------------------------

        $(window).load(function() {

            if ($('.product-browser').length > 0)
            {

                $('.product-browser .row').each(function() {

                    var maxHeight = 0;
                    $(this).find('.product-inner').each(function() {
                        var eHeight = $(this).innerHeight();
                        if (eHeight > maxHeight)
                        {
                            maxHeight = eHeight;
                        }
                    });
                    $(this).find('.product-inner').outerHeight(maxHeight);

                });
            }
        });

	};

	// --------------------------------------------------------------------------

	/**
	 * Binds events to the sidebar lists
	 * @return void
	 */
	this._browse_sidebar_lists_init = function()
	{
        $('.panel-heading').on('click', function() {
            if ($(this).hasClass('panel-collapsed')) {

                // expand the panel
                $(this).parent().find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('.glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
            else {
                // collapse the panel
                $(this).parent().find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
        });
	};

	// --------------------------------------------------------------------------

	/**
	 * Binds events to the sidebar filter
	 * @return void
	 */
	this._browse_sidebar_filter_init = function()
	{
		$( '.nails-shop-skin-front-classic .sidebar-filter .filter-list' ).hover(
			function()
			{
				var _orig_max_height = parseInt( $(this).css( 'max-height' ), 10 );

				$(this).attr( 'data-orig-max-height', _orig_max_height );

				var _new_max_height = _orig_max_height * 1.5;

				$(this).stop().animate( { 'max-height' : _new_max_height } );
			},
			function()
			{
				var _orig_max_height = $(this).attr( 'data-orig-max-height' );
				$(this).stop().animate( { 'max-height' : _orig_max_height } );
			}
		);
	};

	// --------------------------------------------------------------------------

	/**
	 * Binds events to the product sorter
	 * @return void
	 */
	this._browse_sorter_init = function()
	{
		$( '.nails-shop-skin-front-classic .product-sort select' ).on( 'change', function()
		{
			$( '.nails-shop-skin-front-classic .product-sort' ).addClass( 'submitting' );
			$(this).closest( 'form' ).submit();
		});
	};

	// --------------------------------------------------------------------------

	/**
	 * Sets up a new instance of the image zoomer
	 * @return void
	 */
	this._product_single_image_zoomer_init = function()
	{
		if ( $.fn.zoom )
		{
			var _breakpoint;

			_breakpoint = this.get_current_bs_breakpoint();

			//	Medium and Large breakpoints
			if ( _breakpoint === 'md' || _breakpoint === 'lg' )
			{
				this._product_single_image_zoomer_destroy();
				$( '.featured-image-md-lg .featured-img-link' ).zoom();

			} /* End breakpoint md/lg check */
		}
	};

	// --------------------------------------------------------------------------

	/**
	 * Destroys any instance of the image zoomer
	 * @return void
	 */
	this._product_single_image_zoomer_destroy = function()
	{
		if ( $.fn.zoom )
		{
			var _breakpoint;

			_breakpoint = this.get_current_bs_breakpoint();

			//	Medium and Large breakpoints
			if ( _breakpoint === 'md' || _breakpoint === 'lg' )
			{
				$( '.featured-image-md-lg .featured-img-link' ).trigger( 'zoom.destroy' );

			} /* End breakpoint md/lg check */
		}
	};

	// --------------------------------------------------------------------------

	this._product_single_image_gallery_init = function()
	{
		var _this,_breakpoint, _featured, _gallery = [];

		//	Scope hack
		_this = this;

		//	Current breakpoint
		_breakpoint = this.get_current_bs_breakpoint();

		//	Extra Small and Small breakpoints
		if ( _breakpoint === 'xs' || _breakpoint === 'sm' )
		{
			if ( this._product_single_image_gallery_inited_xssm )
			{
				//	Already set this up
				return;
			}
			else
			{
				this._product_single_image_gallery_inited_xssm = true;
			}

			// --------------------------------------------------------------------------

			_featured = {
				link : $( '.featured-image-xs-sm .featured-img-link' ).attr( 'href' ),
				link_el : $( '.featured-image-xs-sm .featured-img-link' ),
				img : $( '.featured-image-xs-sm .featured-img-img' ).attr( 'src' ),
				img_el : $( '.featured-image-xs-sm .featured-img-img' )
			};

			$( '.gallery-xs-sm .gallery-link' ).each( function( index )
			{
				_gallery[index]			= {};
				_gallery[index].link	= $(this).attr( 'href' );
				_gallery[index].link_el	= $(this);
			});

			$( '.gallery-xs-sm .gallery-img' ).each( function( index )
			{
				_gallery[index].img		= $(this).attr( 'src' );
				_gallery[index].img_el	= $(this);
			});

			// --------------------------------------------------------------------------

			$(_gallery).each( function()
			{
				var _gallery_item = $(this).get(0);

				_gallery_item.link_el.on( 'click', function()
				{
					_featured.img_el.attr( 'src', _gallery_item.img );
					_featured.link_el.attr( 'href', _gallery_item.link );

					return false;
				});
			});
		} /* End breakpoint xs/sm check */

		//	Medium and Large breakpoints
		if ( _breakpoint === 'md' || _breakpoint === 'lg' )
		{
			if ( this._product_single_image_gallery_inited_mdlg )
			{
				//	Already set this up
				return;
			}
			else
			{
				this._product_single_image_gallery_inited_mdlg = true;
			}

			// --------------------------------------------------------------------------

			_featured = {
				link : $( '.featured-image-md-lg .featured-img-link' ).attr( 'href' ),
				link_el : $( '.featured-image-md-lg .featured-img-link' ),
				img : $( '.featured-image-md-lg .featured-img-img' ).attr( 'src' ),
				img_el : $( '.featured-image-md-lg .featured-img-img' )
			};

			$( '.gallery-md-lg .gallery-link' ).each( function( index )
			{
				_gallery[index]			= {};
				_gallery[index].link	= $(this).attr( 'href' );
				_gallery[index].link_el	= $(this);
			});

			$( '.gallery-md-lg .gallery-img' ).each( function( index )
			{
				_gallery[index].img		= $(this).attr( 'src' );
				_gallery[index].img_el	= $(this);
			});

			// --------------------------------------------------------------------------

			//	Bind click events
			if ( $.fn.fancybox )
			{
				$(_featured.link_el).on( 'click', function()
				{
					//	Open up a fancybox gallery
					var _fancybox_gallery	= [];
					var _featured_link		= $( '.featured-image-md-lg .featured-img-link' ).attr( 'href' );

					//	The target image goes first
					_fancybox_gallery.push({
						'href' : _featured_link
					});

					//	All images _after_ the target should follow
					var _found_target = false;
					for( var _key in _gallery )
					{
						if ( _found_target === false && _gallery[_key].link === _featured_link )
						{
							_found_target = _key;
							continue;
						}

						if ( _found_target !== false )
						{
							_fancybox_gallery.push({
								'href' : _gallery[_key].link
							});
						}
					}

					//	All images _before_ the target should finish it off
					for ( _key = 0; _key < _found_target; _key++ )
					{
						_fancybox_gallery.push({
							'href' : _gallery[_key].link
						});
					}

					//	Open gallery
					$.fancybox.open(_fancybox_gallery);

					return false;
				});
			} /* End Fancybox check */

			$(_gallery).each( function()
			{
				var _gallery_item = $(this).get(0);

				_gallery_item.link_el.on( 'click', function()
				{
					_featured.img_el.attr( 'src', _gallery_item.img );
					_featured.link_el.attr( 'href', _gallery_item.link );

					//	Re-init the zoomer
					_this._product_single_image_zoomer_init();

					return false;
				});
			});

			// --------------------------------------------------------------------------

			//	Variant hovers
			$( 'table.table-variants tr.variant.has-img' ).on( 'mouseenter', function()
			{
				_this._product_single_image_variant_enter( $(this).data( 'image' ) );
			});
		} /* End breakpoint md/lg check */

		// --------------------------------------------------------------------------

		//	Listen for window size changes
		//TODO
	};

	// --------------------------------------------------------------------------

	this._product_single_image_variant_enter = function( image )
	{
		$( 'a.featured-img-link img' ).attr( 'src', image );
	};

	// --------------------------------------------------------------------------

	/**
	 * Gets the current Bootstrap environment.
	 * Hat-tip: http://stackoverflow.com/a/24884634/789224
	 * @return string
	 */
	this.get_current_bs_breakpoint = function()
	{
		var envs = ["xs", "sm", "md", "lg"],
			doc = window.document,
			temp = doc.createElement("div");

		doc.body.appendChild(temp);

		for (var i = envs.length - 1; i >= 0; i--)
		{
			var env = envs[i];

			temp.className = "hidden-" + env;

			if (temp.offsetParent === null)
			{
				doc.body.removeChild(temp);
				return env;
			}
		}
		return "";
	};

	// --------------------------------------------------------------------------

	/**
	 * Initiates Bootstrap popovers
	 * @return void
	 */
	this._popover_init = function()
	{
		if ( typeof( $.fn.popover ) === 'function' )
		{
			$('.shop-bs-popover').popover({
				"trigger":"hover",
				"placement":"left"
			});
		}
	};

	// --------------------------------------------------------------------------

	return this.__construct();
};