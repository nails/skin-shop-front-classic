/**
 * Javascript for the "Classic" shop skin
 */

var _nails_skin_shop_classic;
_nails_skin_shop_classic = function()
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
		if ( $( '.nails-skin-shop-classic .product-sort' ).length > 0 )
		{
			this._browse_sorter_init();
		}

		// --------------------------------------------------------------------------

		//	Sidebar filter
		if ( $( '.nails-skin-shop-classic .sidebar-filter' ).length > 0 )
		{
			this._browse_sidebar_filter_init();
		}

		// --------------------------------------------------------------------------

		//	Single product page malarky
		if ( $( '.nails-skin-shop-classic.browse.product.single' ).length > 0 )
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

		if ( $( '.nails-skin-shop-classic.checkout' ).length > 0 )
		{
			this._checkout_init();
		}
	};

	// --------------------------------------------------------------------------

	/**
	 * Binds events to the sidebar filter
	 * @return void
	 */
	this._browse_sidebar_filter_init = function()
	{
		$( '.nails-skin-shop-classic .sidebar-filter .filter-list' ).hover(
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
		$( '.nails-skin-shop-classic .product-sort select' ).on( 'change', function()
		{
			$( '.nails-skin-shop-classic .product-sort' ).addClass( 'submitting' );
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

		//	Extra small and Small breakpoints
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
		} /* End breakpoint md/lg check */

		// --------------------------------------------------------------------------

		//	Listen for window size changes
		//TODO
	};

	// --------------------------------------------------------------------------

	this._checkout_init = function()
	{
		//	Show hidden elements, as JS is enabled
		$( '#checkout-step-1 .panel-footer' ).removeClass( 'hidden' );
		$( '#checkout-step-2 .panel-body' ).hide();
		$( '#checkout-step-2 .panel-footer' ).hide();
		$( '#checkout-step-2 .panel-footer a.action-back' ).removeClass( 'hidden' );
		$( '#checkout-step-3 .panel-body' ).hide();
		$( '#checkout-step-3 .panel-footer' ).hide();
		$( '#progress-bar' ).removeClass( 'hidden' );
		$( '#progress-bar-hr' ).remove();

		this._checkout_set_progress( 1 );

		/*
		 * If the "My billing address is the same as my delivery address" checkbox
		 * is checked, hide the billing address fields
		 */

		if ( $( '#same-billing-address' ).prop( 'checked' ) )
		{
			$( '#billing-address' ).hide();
		}
		else
		{
			$( '#billing-address' ).show();
		}

		// --------------------------------------------------------------------------

		//	Bind listeners
		var _this = this;

		//	Step 1
		$( '#checkout-step-1 .panel-footer .action-continue' ).on( 'click', function()
		{
			if ( _this._checkout_validate_step_1() )
			{
				$( '#checkout-step-1 .panel-body' ).slideUp();
				$( '#checkout-step-1 .panel-footer' ).slideUp();

				$( '#checkout-step-2 .panel-body' ).slideDown();
				$( '#checkout-step-2 .panel-footer' ).slideDown();

				_this._checkout_set_progress( 2 );

			} else {


			}

			return false;
		});

		//	Step 2
		$( '#checkout-step-2 .panel-footer .action-continue' ).on( 'click', function()
		{
			if ( _this._checkout_validate_step_2() )
			{
				$( '#checkout-step-2 .panel-body' ).slideUp();
				$( '#checkout-step-2 .panel-footer' ).slideUp();

				// --------------------------------------------------------------------------

				//	Submit the form
				$( '#progress-bar .progress-bar' ).text( 'Please Wait...' ).addClass( 'active' );
				$( '#checkout-form' ).submit();

			} else {

			}

			return false;
		});

		$( '#checkout-step-2 .panel-footer .action-back' ).on( 'click', function()
		{
			$( '#checkout-step-1 .panel-body' ).slideDown();
			$( '#checkout-step-1 .panel-footer' ).slideDown();

			$( '#checkout-step-2 .panel-body' ).slideUp();
			$( '#checkout-step-2 .panel-footer' ).slideUp();

			$( '#checkout-step-1 .panel-heading .validate-ok' ).addClass( 'hidden' );
			$( '#checkout-step-1 .panel-heading .validate-fail' ).addClass( 'hidden' );

			$( '#checkout-step-2 .panel-heading .validate-ok' ).addClass( 'hidden' );
			$( '#checkout-step-2 .panel-heading .validate-fail' ).addClass( 'hidden' );

			_this._checkout_set_progress( 1 );

			return false;

		});

		//	Billing address checkbox
		$( '#same-billing-address' ).on( 'change', function()
		{
			if ( $(this).prop( 'checked' ) )
			{
				$( '#billing-address' ).hide();
			}
			else
			{
				$( '#billing-address' ).show();
			}
		});
	};

	// --------------------------------------------------------------------------

	/**
	 * Sets the progress bar to a particular step
	 * @param  {int} step The step to go to
	 * @return {void}
	 */
	this._checkout_set_progress = function( step )
	{
		var _steps	= 2;
		var _text	= 'Step ' + step + ' of ' + _steps;
		var _width	= 100/_steps*step;

		$( '#progress-bar .progress-bar' ).animate({ 'width' : _width + '%' }).text( _text );
	};

	// --------------------------------------------------------------------------

	/**
	 * Validates the data entered in step 1
	 * @return {boolean}
	 */
	this._checkout_validate_step_1 = function()
	{
		var _valid	= true;
		var _value	= '';

		// --------------------------------------------------------------------------

		//	Address Line 1
		_value = $( 'input[name=delivery_address_line_1]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=delivery_address_line_1]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=delivery_address_line_1]' ).next( '.help-block' ).remove();
		$( 'input[name=delivery_address_line_1]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=delivery_address_line_1]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );

			$( 'input[name=delivery_address_line_1]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=delivery_address_line_1]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		//	City
		_value = $( 'input[name=delivery_address_town]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=delivery_address_town]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=delivery_address_town]' ).next( '.help-block' ).remove();
		$( 'input[name=delivery_address_town]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=delivery_address_town]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
			$( 'input[name=delivery_address_town]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=delivery_address_town]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		//	Postcode
		_value = $( 'input[name=delivery_address_postcode]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=delivery_address_postcode]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=delivery_address_postcode]' ).next( '.help-block' ).remove();
		$( 'input[name=delivery_address_postcode]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=delivery_address_postcode]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
			$( 'input[name=delivery_address_postcode]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=delivery_address_postcode]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		//	First name
		_value = $( 'input[name=first_name]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=first_name]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=first_name]' ).next( '.help-block' ).remove();
		$( 'input[name=first_name]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=first_name]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
			$( 'input[name=first_name]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=first_name]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		//	Surname
		_value = $( 'input[name=last_name]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=last_name]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=last_name]' ).next( '.help-block' ).remove();
		$( 'input[name=last_name]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=last_name]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
			$( 'input[name=last_name]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=last_name]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		//	Email
		_value = $( 'input[name=email]' ).val();
		_value = $.trim( _value );

		//	Reset
		$( 'input[name=email]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
		$( 'input[name=email]' ).next( '.help-block' ).remove();
		$( 'input[name=email]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

		if ( _value.replace( /\s/g, '' ).length === 0 )
		{
			_valid = false;
			$( 'input[name=email]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
			$( 'input[name=email]' ).after( '<p class="help-block">This field is required.</p>' );
			$( 'input[name=email]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
		}
		else
		{
			var _regex = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;

			if ( _regex.test( _value ) === false )
			{
				_valid = false;
				$( 'input[name=email]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
				$( 'input[name=email]' ).after( '<p class="help-block">A valid email must be given.</p>' );
				$( 'input[name=email]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
			}
		}

		// --------------------------------------------------------------------------

		//	Visual feedback
		if ( _valid === true )
		{
			$( '#checkout-step-1 .panel-heading .validate-ok' ).removeClass( 'hidden' );
			$( '#checkout-step-1 .panel-heading .validate-fail' ).addClass( 'hidden' );
		}
		else
		{
			$( '#checkout-step-1 .panel-heading .validate-ok' ).addClass( 'hidden' );
			$( '#checkout-step-1 .panel-heading .validate-fail' ).removeClass( 'hidden' );
		}

		// --------------------------------------------------------------------------

		return _valid;
	};

	// --------------------------------------------------------------------------

	/**
	 * Validates the data entered in step 2
	 * @return {boolean}
	 */
	this._checkout_validate_step_2 = function()
	{
		var _valid	= true;
		var _value	= '';

		// --------------------------------------------------------------------------

		if ( $('#same-billing-address').prop( 'checked' ) === false )
		{
			//	Address Line 1
			_value = $( 'input[name=billing_address_line_1]' ).val();
			_value = $.trim( _value );

			//	Reset
			$( 'input[name=billing_address_line_1]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
			$( 'input[name=billing_address_line_1]' ).next( '.help-block' ).remove();
			$( 'input[name=billing_address_line_1]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

			if ( _value.replace( /\s/g, '' ).length === 0 )
			{
				_valid = false;
				$( 'input[name=billing_address_line_1]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );

				$( 'input[name=billing_address_line_1]' ).after( '<p class="help-block">This field is required.</p>' );
				$( 'input[name=billing_address_line_1]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
			}

			// --------------------------------------------------------------------------

			//	City
			_value = $( 'input[name=billing_address_town]' ).val();
			_value = $.trim( _value );

			//	Reset
			$( 'input[name=billing_address_town]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
			$( 'input[name=billing_address_town]' ).next( '.help-block' ).remove();
			$( 'input[name=billing_address_town]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

			if ( _value.replace( /\s/g, '' ).length === 0 )
			{
				_valid = false;
				$( 'input[name=billing_address_town]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
				$( 'input[name=billing_address_town]' ).after( '<p class="help-block">This field is required.</p>' );
				$( 'input[name=billing_address_town]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
			}

			// --------------------------------------------------------------------------

			//	Postcode
			_value = $( 'input[name=billing_address_postcode]' ).val();
			_value = $.trim( _value );

			//	Reset
			$( 'input[name=billing_address_postcode]' ).closest( '.form-group' ).removeClass( 'has-error has-feedback' );
			$( 'input[name=billing_address_postcode]' ).next( '.help-block' ).remove();
			$( 'input[name=billing_address_postcode]' ).siblings( '.form-control-feedback' ).addClass( 'hidden' );

			if ( _value.replace( /\s/g, '' ).length === 0 )
			{
				_valid = false;
				$( 'input[name=billing_address_postcode]' ).closest( '.form-group' ).addClass( 'has-error has-feedback' );
				$( 'input[name=billing_address_postcode]' ).after( '<p class="help-block">This field is required.</p>' );
				$( 'input[name=billing_address_postcode]' ).siblings( '.form-control-feedback' ).removeClass( 'hidden' );
			}
		}

		// --------------------------------------------------------------------------

		if ( _valid === true )
		{
			$( '#checkout-step-2 .panel-heading .validate-ok' ).removeClass( 'hidden' );
			$( '#checkout-step-2 .panel-heading .validate-fail' ).addClass( 'hidden' );
		}
		else
		{
			$( '#checkout-step-2 .panel-heading .validate-ok' ).addClass( 'hidden' );
			$( '#checkout-step-2 .panel-heading .validate-fail' ).removeClass( 'hidden' );
		}

		return _valid;
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