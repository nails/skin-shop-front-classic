/**
 * Javascript for the "Classic" shop skin
 */

var _nails_skin_shop_front_classic;
_nails_skin_shop_front_classic = function()
{
    /**
     * Whether the mobile product gallery has been instanciated
     * @type {Boolean}
     */
    this.productSingleImageGalleryInitedMobile = false;

    // --------------------------------------------------------------------------

    /**
     * Whether the desktop product gallery has been instanciated
     * @type {Boolean}
     */
    this.productSingleImageGalleryInitedDesktop = false;

    // --------------------------------------------------------------------------

    /**
     * Constructs the shop JS. Conditionally initiates items depending on the
     * actively viewed page.
     * @return void
     */
    this.__construct = function()
    {
        var breakpoint;

        // --------------------------------------------------------------------------

        //  Note the breakpoint so that JS can fire conditionally for the device being used
        breakpoint = this.bsCurrentBreakpoint();

        // --------------------------------------------------------------------------

        //  Product sorter
        if ($('.nails-skin-shop-front-classic .product-sort').length > 0) {
            this.browseSorterInit();
        }

        // --------------------------------------------------------------------------

        //  Sidebar lists
        this.browseSidebarListsInit();

        // --------------------------------------------------------------------------

        //  Sidebar filter
        if ($('.nails-skin-shop-front-classic .sidebar-filter').length > 0) {
            this.browseSidebarFilterInit();
        }

        // --------------------------------------------------------------------------

        //  Single product page malarky
        if ($('.nails-skin-shop-front-classic.browse.product.single').length > 0) {

            //  Mobile JS
            if (breakpoint === 'xs' || breakpoint === 'sm') {

                this.productSingleImageGalleryInitMobile();
                this.productSingleAddBasketMobile();
            }

            //  Desktop JS
            if (breakpoint === 'md' || breakpoint === 'lg') {

                this.productSingleImageGalleryInitDesktop();
                this.productSingleImageZoomerInitDesktop();
            }

            //  Common JS
            this.bsPopoverInit();
        }

        // --------------------------------------------------------------------------

        if ($('.nails-skin-shop-front-classic.processing').length > 0) {
            this._processing_init();
        }

        // --------------------------------------------------------------------------

        $(window).on('load', function()
        {
            if ($('.product-browser').length > 0) {

                $('.product-browser .row').each(function()
                {
                    var maxHeight = 0;

                    $(this).find('.product-inner').each(function()
                    {
                        var eHeight = $(this).innerHeight();
                        if (eHeight > maxHeight) {

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
    this.browseSidebarListsInit = function()
    {
        $('.panel-heading').on('click', function()
        {
            if ($(this).hasClass('panel-collapsed')) {

                // expand the panel
                $(this).parent().find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('.glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

            } else {

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
    this.browseSidebarFilterInit = function()
    {
        $('.nails-skin-shop-front-classic .sidebar-filter .filter-list').hover(
            function()
            {
                var _orig_max_height = parseInt($(this).css('max-height'), 10);

                $(this).attr('data-orig-max-height', _orig_max_height);

                var _new_max_height = _orig_max_height * 1.5;

                $(this).stop().animate({ 'max-height' : _new_max_height });
            },
            function()
            {
                var _orig_max_height = $(this).attr('data-orig-max-height');
                $(this).stop().animate({ 'max-height' : _orig_max_height });
            }
        );
    };

    // --------------------------------------------------------------------------

    /**
     * Binds events to the product sorter
     * @return void
     */
    this.browseSorterInit = function()
    {
        $('.nails-skin-shop-front-classic .product-sort select').on('change', function()
        {
            $('.nails-skin-shop-front-classic .product-sort').addClass('submitting');
            $(this).closest('form').submit();
        });
    };

    // --------------------------------------------------------------------------

    /**
     * Sets up a new instance of the image zoomer
     * @return void
     */
    this.productSingleImageZoomerInitDesktop = function()
    {
        if ($.fn.zoom) {

            this.productSingleImageZoomerDestroyDesktop();
            $('.featured-image-md-lg .featured-img-link').zoom();
        }
    };

    // --------------------------------------------------------------------------

    /**
     * Destroys any instance of the image zoomer
     * @return void
     */
    this.productSingleImageZoomerDestroyDesktop = function()
    {
        if ($.fn.zoom) {

            $('.featured-image-md-lg .featured-img-link').trigger('zoom.destroy');
        }
    };

    // --------------------------------------------------------------------------

    /**
     * Configures the mobile product gallery
     * @return {Void}
     */
    this.productSingleImageGalleryInitMobile = function()
    {
        var _this, _featured, _gallery = [];

        //  Ugly scope hack
        _this = this;

        if (!this.productSingleImageGalleryInitedMobile) {

            this.productSingleImageGalleryInitedMobile = true;

            _featured = {
                link : $('.featured-image-xs-sm .featured-img-link').attr('href'),
                link_el : $('.featured-image-xs-sm .featured-img-link'),
                img : $('.featured-image-xs-sm .featured-img-img').attr('src'),
                img_el : $('.featured-image-xs-sm .featured-img-img')
            };

            $('.gallery-xs-sm .gallery-link').each(function(index) {

                _gallery[index]         = {};
                _gallery[index].link    = $(this).attr('href');
                _gallery[index].link_el = $(this);
            });

            $('.gallery-xs-sm .gallery-img').each(function(index) {

                _gallery[index].img     = $(this).attr('src');
                _gallery[index].img_el  = $(this);
            });

            // --------------------------------------------------------------------------

            $(_gallery).each(function()
            {
                var _gallery_item = $(this).get(0);

                _gallery_item.link_el.on('click', function()
                {
                    _featured.img_el.attr('src', _gallery_item.img);
                    _featured.link_el.attr('href', _gallery_item.link);

                    return false;
                });
            });

            // --------------------------------------------------------------------------

            //  Bind to the variant dropdown
            $('#add-basket-variant-id').on('change', function() {

                // Show image of variant when user selects from dropdown
                var imageSrc = $(this).find(':selected').attr('data-image');

                _this.productSingleImageVariantEnter(imageSrc);

            }).trigger('change');
        }
    };

    // --------------------------------------------------------------------------

    /**
     * Configures the desktop product gallery
     * @return {Void}
     */
    this.productSingleImageGalleryInitDesktop = function()
    {
        var _this, _featured, _gallery = [];

        //  Scope hack
        _this = this;

        if (!this.productSingleImageGalleryInitedDesktop) {

            this.productSingleImageGalleryInitedDesktop = true;

            _featured = {
                link : $('.featured-image-md-lg .featured-img-link').attr('href'),
                link_el : $('.featured-image-md-lg .featured-img-link'),
                img : $('.featured-image-md-lg .featured-img-img').attr('src'),
                img_el : $('.featured-image-md-lg .featured-img-img')
            };

            $('.gallery-md-lg .gallery-link').each(function(index) {

                _gallery[index]         = {};
                _gallery[index].link    = $(this).attr('href');
                _gallery[index].link_el = $(this);
            });

            $('.gallery-md-lg .gallery-img').each(function(index) {

                _gallery[index].img     = $(this).attr('src');
                _gallery[index].img_el  = $(this);
            });

            // --------------------------------------------------------------------------

            //  Bind click events
            if ($.fn.fancybox) {

                $(_featured.link_el).on('click', function()
                {
                    //  Open up a fancybox gallery
                    var _fancybox_gallery   = [];
                    var _featured_link      = $('.featured-image-md-lg .featured-img-link').attr('href');

                    //  The target image goes first
                    _fancybox_gallery.push({
                        'href' : _featured_link
                    });

                    //  All images _after_ the target should follow
                    var _found_target = false;
                    for (var _key in _gallery) {

                        if (_gallery.hasOwnProperty(_key)) {

                            if (_found_target === false && _gallery[_key].link === _featured_link) {

                                _found_target = _key;
                                continue;
                            }

                            if (_found_target !== false) {

                                _fancybox_gallery.push({
                                    'href' : _gallery[_key].link
                                });
                            }
                        }
                    }

                    //  All images _before_ the target should finish it off
                    for (_key = 0; _key < _found_target; _key++) {

                        _fancybox_gallery.push({
                            'href' : _gallery[_key].link
                        });
                    }

                    //  Open gallery
                    $.fancybox.open(_fancybox_gallery);

                    return false;
                });
            } /* End Fancybox check */

            $(_gallery).each(function()
            {
                var _gallery_item = $(this).get(0);

                _gallery_item.link_el.on('click', function()
                {
                    _featured.img_el.attr('src', _gallery_item.img);
                    _featured.link_el.attr('href', _gallery_item.link);

                    //  Re-init the zoomer
                    _this.productSingleImageZoomerInitDesktop();

                    return false;
                });
            });

            // --------------------------------------------------------------------------

            //  Variant hovers
            $('table.table-variants tr.variant.has-img').on('mouseenter', function()
            {
                _this.productSingleImageVariantEnter($(this).data('image'));
            });
        }
    };

    // --------------------------------------------------------------------------

    /**
     * Updates the src of the featured image
     * @param  {String} image The URL of the image
     * @return {Void}
     */
    this.productSingleImageVariantEnter = function(image)
    {
        $('a.featured-img-link img').attr('src', image);
    };

    // --------------------------------------------------------------------------

    /**
     * Ensures that the `quantity` dropdown respects the selected variant's quantity range
     * @return {Void}
     */
    this.productSingleAddBasketMobile = function()
    {
        var _this;

        //  Scope hack
        _this = this;

        var quantitySelect = $('#add-basket-variant-quantity');
        var addBasketButton = $('#add-basket-submit');

        $('#add-basket-variant-id').on('change', function(){

            var quantity = $(this).find('option:selected').data('quantity');
            if (typeof quantity !== 'undefined' && quantity > 0) {

                quantitySelect.prop('disabled', false);
                addBasketButton.removeClass('disabled', false);

                //  Populate the select with the correct number of options
                quantitySelect.empty();

                for (var i = 1; i <= quantity; i++) {

                    quantitySelect.append(
                        $('<option>').attr('value', i).html(i)
                    );
                }

            } else {

                quantitySelect.prop('disabled', true);
                addBasketButton.addClass('disabled', true);

                quantitySelect.empty();
                quantitySelect.append(
                    $('<option>').html('Please Choose...')
                );
            }
        }).trigger('change');
    };

    // --------------------------------------------------------------------------

    /**
     * Gets the current Bootstrap environment.
     * Hat-tip: http://stackoverflow.com/a/24884634/789224
     * @return string
     */
    this.bsCurrentBreakpoint = function()
    {
        var envs = ["xs", "sm", "md", "lg"],
            doc = window.document,
            temp = doc.createElement("div");

        doc.body.appendChild(temp);

        for (var i = envs.length - 1; i >= 0; i--) {

            var env = envs[i];

            temp.className = "hidden-" + env;

            if (temp.offsetParent === null) {

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
    this.bsPopoverInit = function()
    {
        if (typeof($.fn.popover) === 'function') {

            $('.shop-bs-popover').popover({
                "trigger":"hover",
                "placement":"left"
            });
        }
    };

    // --------------------------------------------------------------------------

    return this.__construct();
};
