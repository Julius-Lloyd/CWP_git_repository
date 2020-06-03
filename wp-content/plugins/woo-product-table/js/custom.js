/* 
 * Only for Fronend Section
 * @since 1.0.0
 */


(function($) {
    'use strict';
    $(document).ready(function() {
        $('.wptf_product_table_wrapper .search_select').select2();
        /**
         * Checking wptf_pro_table_body class available in body tag
         * 
         * @since 4.3 we have added this condition. 
         */
        if(!$('div.wptf_product_table_wrapper table').hasClass('wptf_product_table')){ //div wptf_product_table_wrapper 
            return false; 
        }        
        
        var ajax_url,ajax_url_additional = '/wp-admin/admin-ajax.php';
        var site_url = $('div.wptf_product_table_wrapper').data('site_url');
            ajax_url = site_url + ajax_url_additional;
        console.log(ajax_url);//Only for Developer
        if( ajax_url === 'undefined' + ajax_url_additional  ){
            console.log( 'WOO PRODUCT TABLE is not Available to this page \nOR:::SORRY!!!!: woocommerce_params is Undefine also ajax_url also undefined. So ajax will not work not. Contact with codersaiful@gmail.com' );
            return false;
        }
        
        /**
         * Pagination
         * @type Objectt
         */
        changeSpanToAPagi();
        function changeSpanToAPagi(){
            $('div.wptf_table_pagination span.page-numbers.current').each(function(){
                var _number = $(this).html();
                $('div.wptf_table_pagination span.page-numbers.current').replaceWith('<a class="page-numbers current">' + _number + '</a>');
            });

            $('div.wptf_table_pagination a.page-numbers').each(function(){
                var _number = $(this).html();
                $(this).attr('data-page_number',_number);
            });
        }
        
        $('body').on('click','.wptf_table_pagination.pagination_loading a',function(e){
            e.preventDefault();
            return false;
        });
        $('body').on('click','.wptf_table_pagination a',function(e){
            e.preventDefault();
            var thisButton = $(this);

            var page_number = $(thisButton).data('page_number');
            
            var temp_number = $(thisButton).closest('.wptf_table_pagination').data('temp_number');
            
            
            var targetTable = $('#table_id_' + temp_number + ' table#wptf_table');
            var targetTableArgs = targetTable.attr( 'data-data_json' );
                targetTableArgs = JSON.parse(targetTableArgs);
            var targetTableBody = $('#table_id_' + temp_number + ' table#wptf_table tbody');
            var thisPagiWrappers = $('#table_id_' + temp_number + ' .wptf_table_pagination');
            var thisPagiLinks = $('#table_id_' + temp_number + ' .wptf_table_pagination a.page-numbers');
            thisPagiLinks.removeClass('current');
            
            var load_type = 'current_page';
            var pageNumber = page_number;
            targetTableBody.css('opacity','0.2');
            thisPagiWrappers.addClass('pagination_loading');
            $.ajax({
                type: 'POST',
                url: ajax_url,// + get_data,
                data: {
                    action:         'wptf_query_table_load_by_args',
                    temp_number:    temp_number,
                    targetTableArgs:targetTableArgs,
                    pageNumber:     pageNumber,
                    load_type:     load_type,
                },
                complete: function(){
                    $( document ).trigger( 'wc_fragments_refreshed' );
                    loadMiniFilter(); //@Since 4.8
                    fixAfterAjaxLoad();
                },
                success: function(data) {
                    targetTableBody.html(data);
                    targetTableBody.css('opacity','1');
                    
                    var $data = {
                                action:         'wptf_ajax_paginate_links_load',
                                temp_number:    temp_number,
                                targetTableArgs:targetTableArgs, 
                                pageNumber:     pageNumber,
                                load_type:     load_type,
                            };
                    
                    loadPaginationLinks($data,temp_number);

                    removeCatTagLings();//Removing Cat,tag link, if eanabled from configure page
                    updateCheckBoxCount(temp_number); //Selection reArrange 
                    uncheckAllCheck(temp_number);//Uncheck All CheckBox after getting New pagination
                    emptyInstanceSearchBox(temp_number);//CleanUp or do empty Instant Search

                    pageNumber++; //Page Number Increasing 1 Plus
                    targetTable.attr('data-page_number',pageNumber);
                },
                error: function() {
                    alert("Error On Ajax Query Load. Please check console.");
                    console.log('Error Here');
                },
            });
            
            
        });
        //End of Pagination
        function fixAfterAjaxLoad() {
            $('table.wptf_product_table td select').trigger('change');
            //$.getScript(site_url + "/wp-includes/js/mediaelement/mediaelement-and-player.min.js");
            //$.getScript(site_url + "/wp-practice/wp-includes/js/mediaelement/mediaelement-migrate.min.js");
            $.getScript(site_url + "/wp-includes/js/mediaelement/wp-mediaelement.min.js");
            $.getScript(site_url + "/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js");
            $.getScript(site_url + "/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.js");
        }   
        /**
         * Getting object for config_json from #wptf_table table.
         * Can be any table. because all table will be same config json data
         * 
         * @returns {Objectt}
         */        
        var config_json = $('#wptf_table').data('config_json');
        if ( typeof config_json === 'undefined' ){
            return false;
        }
        
        /**
         * Mainly getting config_json value based on table id. To get new value if available in inside any function, Use like following
         * config_json = getConfig_json( temp_number );
         * 
         * @param {type} temp_number Table ID
         * @returns {Objectt} Json Object, Mainly getting config_json value based on table id.
         */
        function getConfig_json( temp_number ){
           var temp_cjson = $('div#table_id_' + temp_number + ' #wptf_table').data('config_json');
           if ( typeof temp_cjson === 'undefined' ){
                temp_cjson = config_json;
            }
            return temp_cjson;
        }
        console.log(config_json);
        var footer_cart = config_json.footer_cart;
        var footer_cart_size = config_json.footer_cart_size;
        var footer_possition = config_json.footer_possition;
        var footer_bg_color = config_json.footer_bg_color;
        //Adding Noticeboard and Footer CartBox Div tag at the bottom of page
        $('body').append("<div class='wptf_notice_board'></div>");
        $('body').append('<div style="height: ' + footer_cart_size + 'px;width: ' + footer_cart_size + 'px;" class="wpt-footer-cart-wrapper '+ footer_possition +' '+ footer_cart +'"><a target="_blank" href="#"></a></div>');
        
        /**
         * To get/collect Notice after click on add to cart button 
         * or after click on add_to_cart_selected
         * 
         * @returns {undefined}
         */
        function WPT_NoticeBoard(){
            var noticeBoard = $('div.wptf_notice_board');
            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    action: 'wptf_print_notice'
                },
                success: function(response){
                    if(response !== ''){
                        noticeBoard.html(response);
                        var boardHeight = noticeBoard.height();
                        var boardWidth = noticeBoard.width();
                        var windowHeight = $(window).height();
                        var windowWidth = $(window).width();
                        var topCal = (windowHeight - (boardHeight + 20))/2;
                        var leftCal = (windowWidth - (boardWidth + 20))/2;
                        noticeBoard.css({
                            top: topCal + 'px',
                            left: leftCal + 'px',
                        });                        
                        noticeBoard.fadeIn('slow');
                    }
                    var myTimeOut = setTimeout(function(){
                        noticeBoard.fadeOut('medium');
                        clearTimeout(myTimeOut);
                    },2000);
                },
                error: function(){
                    console.log("Unable to load Notice");
                    return false;
                }
            });
            
        }
        
        $('body').on('click','div.wptf_notice_board',function(){
            $(this).fadeOut('fast');
        });
        
        /**
         * Loading our plugin's minicart
         * 
         * @since 3.7.11
         * @Added a new added function.
         * @returns {Boolean}
         */
        function WPT_MiniCart(){
            var minicart_type = $('div.tables_cart_message_box').attr('data-type');
                        
            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    action: 'wptf_fragment_refresh'
                },
                success: function(response){
                    //console.log(response);
                    setFragmentsRefresh( response );
                    var cart_hash = response.cart_hash;
                    var fragments = response.fragments;
                    var html = '';
                    var supportedElement = ['div.widget_shopping_cart_content','a.cart-contents','a.footer-cart-contents'];
                    if ( fragments && cart_hash !== '' ) {
                        if(minicart_type === 'load'){
                            $.each( fragments, function( key, value ) {
                                if($.inArray(key, supportedElement) != -1) {
                                    html += value;
                                }
                                
                            });
                            $('div.tables_cart_message_box').attr('data-type','refresh');//Set
                            $('div.tables_cart_message_box').html(html);
                        }else{
                            $.each( fragments, function( key, value ) {
                                if($.inArray(key, supportedElement) != -1) {
                                    $( key ).replaceWith( value );
                                }
                                
                            });
                        }
                        
                    }
                },
                error: function(){
                    alert("Unable to Load Minicart");
                    return false;
                }
            });
        }

        
        WPT_MiniCart();

        if(config_json.thumbs_lightbox === '1' || config_json.thumbs_lightbox === 1){
            $('body').on('click', '.wptf_product_table_wrapper .wptf_thumbnails img', function() {
                var thisImg = $(this);
                var image_width, final_image_url, variation_id,imgSize;
                //For vatiation management
                variation_id = $(this).attr('data-variation_id');
                
                if('undefined' !== typeof variation_id){
                    $.ajax({
                        type: 'POST',
                        url: ajax_url,
                        data: {
                            action: 'wptf_variation_image_load',
                            variation_id: variation_id,
                        },
                        success: function(result){
                            imgSize = result.split(" ");
                            final_image_url = imgSize[0];
                            image_width = imgSize[1];
                            IMG_Generator(thisImg,final_image_url, image_width);
                        }
                    });
                    
                }else{
                    image_width = $(this).parent().data('width');
                    final_image_url = $(this).parent().data('url');
                    IMG_Generator(thisImg,final_image_url, image_width);
                }
                
                
            });
            
            /**
             * Variation Wise Image Generator
             * Added at 4.0.20
             * 
             * @param {type} thisImg Getting Current Image Event
             * @param {type} final_image_url 
             * @param {type} image_width
             * @returns {undefined}
             */
            function IMG_Generator(thisImg,final_image_url, image_width){
                
                var image_height, product_title,placeholder_image,wrapper_style;
                
                image_height = 'auto';
                
                if('undefined' === typeof final_image_url){
                    placeholder_image = $(thisImg).attr('src');
                    console.log("No Thumbnail Image founded");
                    final_image_url = placeholder_image;//Set final image size to place holder image when not found
                    wrapper_style = '';//Default blank value for style of wrapper, when not found any image
                }else{
                    //Setting style of height width
                    wrapper_style = "style='width: " + image_width + "px; height:" + image_height + "px'";
                }
                product_title = $(thisImg).closest('tr').data('title');
                var html = '<div id="wptf_thumbs_popup" class="wptf_thumbs_popup"><div class="wptf_popup_image_wrapper" ' + wrapper_style + '><span title="Close" id="wptf_popup_close">&times;</span><h2 class="wptf_wrapper_title">' + product_title + '</h2><div class="wptf_thums_inside">';
                html += '<img class="wptf_popup_image" src="' + final_image_url + '">';
                
                html += '</div></div></div>';
                if ($('body').append(html)) {
                    var PopUp = $('.wptf_thumbs_popup, #wptf_thumbs_popup');
                    PopUp.fadeIn('slow');
                    var Wrapper = $('div.wptf_popup_image_wrapper');
                    Wrapper.fadeIn();
                }
            }

            $('body').on('click', '.wptf_popup_image_wrapper', function() {
                return false;
                
            });
            $('body').on('click', '#wptf_thumbs_popup span#wptf_popup_close, #wptf_thumbs_popup', function() {
                $('#wptf_thumbs_popup').fadeOut(function(){
                    $(this).remove();
                });
                
            });
        }
        
        $('body').on('click','a.button.wptf_woo_add_cart_button.outofstock_add_to_cart_button.disabled',function(e){
            e.preventDefault();
            var temp_number = $(this).closest( '.wptf_action' ).data('temp_number');
            config_json = getConfig_json( temp_number );
            alert(config_json.sorry_out_of_stock);
            return false;
        });
        //Add to cart
        $('body').on('click', 'a.ajax_active.wptf_variation_product.single_add_to_cart_button.button.enabled, a.ajax_active.add_to_cart_button.wptf_woo_add_cart_button', function(e) {
            e.preventDefault();
            var thisButton = $(this);
            //Adding disable and Loading class
            thisButton.addClass('disabled');
            thisButton.addClass('loading');
            var data = {};
            $.each( thisButton.data(), function( key, value ) {
                    data[ key ] = value;
            });

            // Trigger event.
            $( document.body ).trigger( 'adding_to_cart', [ thisButton, data ] );
            
            var product_id = $(this).data('product_id');
            
            var temp_number = $(this).closest('.wptf_variation_' + product_id).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added at V5.0
            var qtyElement = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' input.input-text.qty.text');
            var min_quantity = qtyElement.attr('min');//.val();
            if(min_quantity === '0' || typeof min_quantity === 'undefined'){
                min_quantity = 1;
            }
            //For Direct Checkout page and Quick Button Features
            var checkoutURL = $('#table_id_' + temp_number).data('checkout_url');

            //Changed at2.9
            var quantity = $(this).attr('data-quantity');
            var custom_message = $('#table_id_' + temp_number + ' table#wptf_table .wptf_row_product_id_' + product_id + ' .wptf_Message input.message').val();
            var variation_id = $(this).attr('data-variation_id');
            var variation = $(this).attr('data-variation');
            if(variation){
                variation = JSON.parse(variation);
            }
            if(!quantity || quantity === '0'){
                
                thisButton.removeClass('disabled');
                thisButton.removeClass('loading');
                alert("Sorry! 0 Quantity");
                return false;
                quantity = 1;
            }
            
            var get_data = $(this).attr('href') + '&quantity=' + quantity;
            
            $.ajax({
                type: 'POST',
                url: ajax_url,// + get_data,
                data: {
                    action:     'wptf_ajax_add_to_cart',
                    variation:  variation, 
                    variation_id:   variation_id,
                    product_id: product_id,
                    quantity:   quantity,
                    custom_message: custom_message,
                },
                complete: function(){
                    $( document ).trigger( 'cart_page_refreshed' );
                    $( document ).trigger( 'cart_totals_refreshed' );
                    $( document ).trigger( 'wc_fragments_refreshed' );
                },
                success: function(response) {

                    
                    //WPT_MiniCart();
                    $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, thisButton ] ); //Trigger and sent added_to_cart event
                    thisButton.removeClass('disabled');
                    thisButton.removeClass('loading');
                    thisButton.addClass('added');
                    qtyElement.val(min_quantity);
                    thisButton.attr('data-quantity',min_quantity);

                    if(config_json.popup_notice === '1'){
                        WPT_NoticeBoard();//Gettince Notice
                    }
                    //Quick Button Active here and it will go Directly to checkout Page
                    if(config_json.product_direct_checkout === 'yes'){
                        window.location.href = checkoutURL;
                    }
                    
                    //******************/
                },
                error: function() {
                    alert('Failed - Unable to add by ajax');
                },
            });
        });

        $('body').on('click', 'a.wptf_variation_product.single_add_to_cart_button.button.disabled,a.disabled.yith_add_to_quote_request.button', function(e) {
            e.preventDefault();
            var temp_number = $(this).closest( '.wptf_action' ).data('temp_number');
            config_json = getConfig_json( temp_number );
            alert(config_json.no_right_combination);
            return false;
            
        });
        //Alert of out of stock 

        $('body').on('click', 'a.wptf_woo_add_cart_button.button.disabled.loading,a.disabled.yith_add_to_quote_request.button.loading', function(e) {
            e.preventDefault();
            var temp_number = $(this).closest( '.wptf_action' ).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            alert(config_json.adding_in_progress);
            return false;

        });
        
        
        //Product Variations change
        $('body').on('change','.wptf_varition_section',function() {
            
            var product_id = $(this).data('product_id');
            var temp_number = $(this).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            var target_class = '.wptf_variation_' + product_id;
            
            //Added at Version2.6 for Quote Request Button
            var quoted_target = 'yith_request_temp_' + temp_number + '_id_' + product_id;
            //Please choose right combination.//Message
            var targetRightCombinationMsg = config_json.right_combination_message;
            var selectAllItemMessage = config_json.select_all_items_message;
            var outOfStockMessage = config_json.out_of_stock_message;
            

            /**
             * Finally targetPriceSelectorTd has removed becuase we have creaed a new function
             * for targetting any TD of selected Table.
             * This function is targetTD(td_name)
             * @type @call;$
             */
            var targetThumbs = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' td.wptf_thumbnails img');
            
            var targetThumbsTd = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' td.wptf_thumbnails'); //Added at 4.0.21
            
            var htmlStored = targetThumbsTd.attr('data-html_stored');
            var targetThumbsText;
            if(htmlStored !== 'added'){
               
               targetThumbsText = targetThumbsTd.html(); //Added at 4.0.21 
               targetThumbsTd.attr('data-html',targetThumbsText);
            }
            targetThumbsTd.attr('data-html_stored','added');
            var targetThumbsHTML = targetThumbsTd.attr('data-html');
            
            var variations_data = $(this).closest(target_class).data('product_variations');
            var messageSelector = $(this).children('div.wptf_message');
            var addToCartSelector = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' a.wptf_variation_product.single_add_to_cart_button');
            var addToQuoteSelector = $('.' + quoted_target);
            
            //Checkbox Selector
            var checkBoxSelector = $('.wptf_check_temp_' + temp_number + '_pr_' + product_id);

            /**
             * Targetting Indivisual TD Element from Targeted Table. Our Targeted Table will come by temp_number
             * As we have used temp_number and product_id in inside function, So this function obvisoulsy shoud
             * declear after to these variable.
             * 
             * @param {String} td_name Actually it will be column names keyword. Suppose, we want to rarget .wptf_price td, than we will use only price as perameter.
             * @returns {$}
             */
            function targetTD(td_name) {
                var targetElement = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' td.wptf_' + td_name);
                return targetElement;
            }
            
            /**
             * Set Variations value to the targetted column's td
             * 
             * @param {type} target_td_name suppose: weight,description,serial_number,thumbnails etc
             * @param {type} gotten_value Suppose: variations description from targatted Object
             * @returns {undefined}
             */
            function setValueToTargetTD_IfAvailable(target_td_name, gotten_value){
                if (gotten_value !== "") {
                    targetTD(target_td_name).html(gotten_value);
                }
            }
            
            /**
             * set value for without condition
             * 
             * @param {type} target_td_name for any td
             * @param {type} gotten_value Any valy
             * @returns {undefined}
             */
            function setValueToTargetTD(target_td_name, gotten_value){
                targetTD(target_td_name).html(gotten_value);
            }
            /**
             * 
             * @param {type} target_td_name suppose: weight,description,serial_number,thumbnails etc
             * @param {type} datas_name getting data value from data-something attribute. example: <td data-product_description='This is sample'> s</td>
             * @returns {undefined}
             */
            function getValueFromOldTD(target_td_name, datas_name){
                //Getting back Old Product Description from data-product_description attribute, which is set 
                var product_descrition_old = targetTD(target_td_name).data(datas_name);
                targetTD(target_td_name).html(product_descrition_old);
            }

            var current = {};
            var additionalAddToCartUrl = '';
            //Defining No Ajax Action for when put href to variation product's add to cart button
            if(addToCartSelector.is('.no_ajax_action')){
                //additionalAddToCartUrl = '?';
            }

            var quote_data = '';
            $(this).children('select').each(function() {
                var attribute_name = $(this).data('attribute_name');
                var attribute_value = $(this).val();
                current[attribute_name] = attribute_value;
                additionalAddToCartUrl += '&' + attribute_name + '=' + attribute_value;
            });
            
            var qty = addToCartSelector.attr('data-quantity');
            additionalAddToCartUrl += "&quantity=" + qty;
            //If not found variations Data, if not set properly
            if($.isEmptyObject(variations_data)){
                targetRightCombinationMsg = config_json.right_combination_message_alt;//"Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.";
            }

            var targetVariationIndex = 'not_found';
            var selectAllItem = true;
            variations_data.forEach(function(attributesObject, objectNumber) {
                $.each(current,function(key,value){
                    if(value === "0"){
                        selectAllItem = false;
                    }
                });
                var total_right_combination=0, total_combinationable=0;
                if(selectAllItem){
                    $.each(attributesObject.attributes,function(key,value){
                        if(value === "" || value === current[key]){
                            total_right_combination++;
                        }
                        total_combinationable++;
                    });
                    if(total_right_combination === total_combinationable){
                        targetVariationIndex = parseInt(objectNumber);
                        
                    }
                    
                }else{
                    targetRightCombinationMsg = selectAllItemMessage; //"Please select all Items.";
                }

            });
            
            var wptMessageText = false;
            if (targetVariationIndex !== 'not_found') {
                var targetAttributeObject = variations_data[targetVariationIndex];
                additionalAddToCartUrl += '&variation_id=' + targetAttributeObject.variation_id;
                quote_data = additionalAddToCartUrl;
                //Link Adding
                additionalAddToCartUrl = addToCartSelector.data('add_to_cart_url') + additionalAddToCartUrl;
                addToCartSelector.attr('href', additionalAddToCartUrl);

                //Class adding/Removing to add to cart button
                if (targetAttributeObject.is_in_stock) {
                    disbale_enable_class();
                } else {
                    targetRightCombinationMsg = outOfStockMessage; //"Out of Stock";
                    enable_disable_class();
                }

                //Set variation Array to addToCart Button
                addToCartSelector.attr('data-variation', JSON.stringify(current)); //current_object //targetAttributeObject.attributes //It was before 2.8 now we will use 'current' object whic will come based on current_selection of variations
                addToCartSelector.attr('data-variation_id', targetAttributeObject.variation_id);
                
                /**
                 * For add to Queto Button
                 * @since 2.6
                 * @date 20.7.2018
                 */
                addToQuoteSelector.attr('data-variation', JSON.stringify(current)); //targetAttributeObject.attributes //It was before 2.8 now we will use 'current' object whic will come based on current_selection of variations
                addToQuoteSelector.attr('data-variation_id', targetAttributeObject.variation_id);
                addToQuoteSelector.attr('data-quote_data', quote_data);

                //Set stock Message
                if (targetAttributeObject.availability_html === "") {
                    wptMessageText = '<p class="stock in-stock">In stock</p>';
                } else {
                    wptMessageText = targetAttributeObject.availability_html;
                }
                //Setup Price Live
                setValueToTargetTD_IfAvailable('price', targetAttributeObject.price_html);

                //Set Image Live for Thumbs
                targetThumbs.attr('src', targetAttributeObject.image.gallery_thumbnail_src);
                if(targetAttributeObject.image.srcset && 'false' !== targetAttributeObject.image.srcset) {
                    targetThumbs.attr('srcset', targetAttributeObject.image.srcset);
                };

                //Set SKU live based on Variations
                setValueToTargetTD_IfAvailable('sku', targetAttributeObject.sku);
                
                //Set Total Price display_price
                var targetQty = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' td.wptf_quantity .quantity input.input-text.qty.text').val();
                if(!targetQty){
                    targetQty = 1;
                }
                var targetQtyCurrency = targetTD('total').data('currency');
                var targetPriceDecimalSeparator = targetTD('total').data('price_decimal_separator');
                var targetPriceThousandlSeparator = targetTD('total').data('thousand_separator');
                var targetNumbersPoint = targetTD('total').data('number_of_decimal');
                var totalPrice = parseFloat(targetQty) * parseFloat(targetAttributeObject.display_price);
                totalPrice = totalPrice.toFixed(targetNumbersPoint);
                var totalPriceHtml = '<strong>' + targetQtyCurrency + totalPrice.replace(".",targetPriceDecimalSeparator) + '</strong>';

                setValueToTargetTD_IfAvailable('total',totalPriceHtml);
                targetTD('total').attr('data-price', targetAttributeObject.display_price);
                targetTD('total').addClass('total_general');
                
                //Set Description live based on Varitions's Description
                
                setValueToTargetTD_IfAvailable('description', targetAttributeObject.variation_description);

                var finalWeightVal = targetAttributeObject.weight * targetQty;
                finalWeightVal = finalWeightVal.toFixed(2);
                if(finalWeightVal === 'NaN'){
                    finalWeightVal = '';
                }
               targetTD('weight').attr('data-weight',targetAttributeObject.weight);
                //Set Weight,Height,Lenght,Width
                setValueToTargetTD_IfAvailable('weight', finalWeightVal);
                setValueToTargetTD_IfAvailable('height', targetAttributeObject.dimensions.height);
                setValueToTargetTD_IfAvailable('length', targetAttributeObject.dimensions.length);
                setValueToTargetTD_IfAvailable('width', targetAttributeObject.dimensions.width);
                
                //Set Variation ID at Thumbs's td   //Added at 4.0.20
                targetThumbs.attr('data-variation_id', targetAttributeObject.variation_id);

            } else {
                addToCartSelector.attr('data-variation', false);
                addToCartSelector.attr('data-variation_id', false);
                
                addToQuoteSelector.attr('data-variation', false);
                addToQuoteSelector.attr('data-variation_id', false);
                addToQuoteSelector.attr('data-quote_data', false);
                
                
                wptMessageText = '<p class="wptf_warning warning">' + targetRightCombinationMsg + '</p>'; //Please choose right combination. //Message will come from targatted tables data attribute //Mainly for WPML issues


                //Class adding/Removing to add to cart button
                enable_disable_class();

                //Reset Price Data from old Price, what was First time
                getValueFromOldTD('price', 'price_html');
                getValueFromOldTD('sku', 'sku');
                setValueToTargetTD('total', '');
                targetTD('total').attr('data-price', '');
                targetTD('total').removeClass('total_general');

                //Getting back Old Product Description from data-product_description attribute, which is set 
                getValueFromOldTD('description', 'product_description');

                var oldBackupWeight = targetTD('weight').attr('data-weight_backup');
                targetTD('weight').attr('data-weight',oldBackupWeight);
                var oldWeightVal = oldBackupWeight * targetQty;
                //Getting Back Old Weight,Lenght,Width,Height
                setValueToTargetTD_IfAvailable('weight', oldWeightVal);
                getValueFromOldTD('length', 'length');
                getValueFromOldTD('width', 'width');
                getValueFromOldTD('height', 'height');
                //Return to Previous HTML Image
                targetThumbsTd.html(targetThumbsHTML);
                //Unset variation ID data //Added at 4.0.20
                targetThumbs.removeAttr('data-variation_id');
            }
            //Set HTML Message to define div/box
            messageSelector.html(wptMessageText);
            
            function enable_disable_class() {
                addToCartSelector.removeClass('enabled');
                addToCartSelector.addClass('disabled');
                
                /**
                 * For Add to Quote
                 */
                addToQuoteSelector.removeClass('enabled');
                addToQuoteSelector.addClass('disabled');
                
                checkBoxSelector.removeClass('enabled');
                checkBoxSelector.addClass('disabled');

            }
            function disbale_enable_class() {
                addToCartSelector.removeClass('disabled');
                addToCartSelector.addClass('enabled');

                /**
                 * For Add To Quote
                 */
                addToQuoteSelector.removeClass('disabled');
                addToQuoteSelector.addClass('enabled');

                checkBoxSelector.removeClass('disabled');
                checkBoxSelector.addClass('enabled');
            }

        });
        
        $('.wptf_varition_section').each(function(){
            var current_value = $(this).children('select').val();
            if(current_value !== '0'){
                $(this).trigger('change');
            }
        });

        /**
         * Working for Checkbox of our Table
         */
        $('body').on('click', 'input.wptf_tabel_checkbox.wptf_td_checkbox.disabled', function(e) {
            e.preventDefault();
            var temp_number = $(this).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            alert(config_json.sorry_plz_right_combination);
            return false;
        });

        $('a.button.add_to_cart_all_selected').click(function() {
            var temp_number = $(this).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            var checkoutURL = $('#table_id_' + temp_number).data('checkout_url');
            //Add Looading and Disable class 
            var currentAllSelectedButtonSelector = $('#table_id_' + temp_number + ' a.button.add_to_cart_all_selected');
            currentAllSelectedButtonSelector.addClass('disabled');
            currentAllSelectedButtonSelector.addClass('loading');

            var add_cart_text = $('#table_id_' + temp_number).data('add_to_cart');

            //Getting Data from all selected checkbox
            var products_data = {};
            var itemAmount = 0;
            
            $('#table_id_' + temp_number + ' input.enabled.wptf_tabel_checkbox.wptf_td_checkbox:checked').each(function() {
                var product_id = $(this).data('product_id');
                var thisButton = $('tr.wptf_row_product_id_' + product_id + ' td.wptf_action a.button.wptf_woo_add_cart_button');
                thisButton.removeClass('added');
                thisButton.addClass( 'disabled' );
                thisButton.addClass( 'loading' );
                
                //added at 4
                var qtyElement = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' input.input-text.qty.text');
                var min_quantity = qtyElement.attr('min');
                if(min_quantity === '0' || typeof min_quantity === 'undefined'){
                    min_quantity = 1;
                }
                
                var currentAddToCartSelector = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' .wptf_action a.wptf_woo_add_cart_button');
                var currentCustomMessage = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' .wptf_Message input.message').val();
                var currentVariaionId = currentAddToCartSelector.data('variation_id');
                var currentVariaion = currentAddToCartSelector.data('variation');
                var currentQantity = $('#table_id_' + temp_number + ' table#wptf_table .wptf_row_product_id_' + product_id + ' .wptf_quantity .quantity input.input-text.qty.text').val();
                products_data[product_id] = {
                    product_id: product_id, 
                    quantity: currentQantity, 
                    variation_id: currentVariaionId, 
                    variation: currentVariaion,
                    custom_message: currentCustomMessage,
                };
                itemAmount++;

            });

            //Return false for if no data
            if (itemAmount < 1) {
                currentAllSelectedButtonSelector.removeClass('disabled');
                currentAllSelectedButtonSelector.removeClass('loading');
                alert('Please Choose items.');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    action: 'wptf_ajax_mulitple_add_to_cart',
                    products: products_data,
                },
                complete: function(){
                    $( document ).trigger( 'wc_fragments_refreshed' );
                },
                success: function( response ) {
                    //setFragmentsRefresh( response );                    
                    //WPT_MiniCart();
                    $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $('added_to_cart') ] );
                    
                    currentAllSelectedButtonSelector.html(add_cart_text + ' [ ' + itemAmount + ' ' + config_json.add2cart_all_added_text + ' ]');
                    if(config_json.popup_notice === '1'){
                        WPT_NoticeBoard();//Loading Notice Board
                    } 
                    if(config_json.all_selected_direct_checkout === 'yes'){
                        window.location.href = checkoutURL;
                        return;
                    }else{
                        currentAllSelectedButtonSelector.removeClass('disabled');
                        currentAllSelectedButtonSelector.removeClass('loading');
                    }
                     
                    //Added at v4.0.11
                    $('#table_id_' + temp_number + ' input.enabled.wptf_tabel_checkbox.wptf_td_checkbox:checked').each(function() {
                        var product_id = $(this).data('product_id');
                        
                        var thisButton = $('tr.wptf_row_product_id_' + product_id + ' td.wptf_action a.button.wptf_woo_add_cart_button');
                        thisButton.removeClass('disabled');
                        thisButton.removeClass('loading');
                        thisButton.addClass('added');
                        
                        var qtyElement,min_quantity;
                        qtyElement = $('#table_id_' + temp_number + ' #product_id_' + product_id + ' input.input-text.qty.text');
                        min_quantity = qtyElement.attr('min');
                        if(min_quantity === '0' || typeof min_quantity === 'undefined'){
                            min_quantity = 1;
                        }
                        qtyElement.val(min_quantity);//Added at v4
                    });
                    uncheckAllCheck(temp_number);
                    
                },
                error: function() {
                    alert('Failed');
                },
            });
        });
        
        
        //,wc_fragments_refresh,wc_fragment_refresh,removed_from_cart
        $(document).on('wc_fragments_refreshed',function(){
            WPT_MiniCart();
        });
        $(document).on('wc_fragments_refresh',function(){
            WPT_MiniCart();
        });
        
        $(document).on('wc_fragment_refresh',function(){
            WPT_MiniCart();
        });
        
        $(document).on('removed_from_cart',function(){
            WPT_MiniCart();
        });
        
        $('div.wpt-footer-cart-wrapper>a').css('background-color',footer_bg_color);
        $('body').append('<style>div.wpt-footer-cart-wrapper>a:after{background-color: ' + footer_bg_color + ';}</style>');
        /**
         * @param {type} response
         * @returns {undefined}
         */
        function setFragmentsRefresh( response ){
            var FooterCart = $('div.wpt-footer-cart-wrapper');
            
            $('span.wptf_ccount').html('');
            $( '.wptf_action>a.wptf_woo_add_cart_button' ).removeClass( 'added' );
            if(response !== 'undefined'){
                    var fragments = response.fragments;
                    /*
                    if ( fragments ) {
                        $.each( fragments, function( key, value ) {
                            //console.log(key);
                            $( key ).replaceWith( value );
                        });
                    }
                    */
                    
                    var wptf_per_product = fragments.wptf_per_product;
                    wptf_per_product = $.parseJSON(wptf_per_product);
                    if( wptf_per_product && wptf_per_product  !== 'false'){
                        if(footer_cart !== 'always_hide'){
                            FooterCart.fadeIn('slow');
                        }
                        
                        $.each( wptf_per_product, function( key, value ) {
                            $( '.wptf_row_product_id_' + key + ' .wptf_action button.single_add_to_cart_button>.wptf_ccount.wptf_ccount_' + key ).remove();
                            $( '.wptf_row_product_id_' + key + ' .wptf_action>a.wptf_woo_add_cart_button' ).addClass( 'added' );
                            $( '.wptf_row_product_id_' + key + ' .wptf_action>a.wptf_woo_add_cart_button' ).append( '<span class="wptf_ccount wptf_ccount_' + key + '">' + value + '</span>' );
                        });
                    }else{
                        if(footer_cart === 'hide_for_zerro'){
                            FooterCart.fadeOut('slow');
                        }
                        
                    }
                    $('div.wpt-footer-cart-wrapper>a').css('background-color',footer_bg_color);
                }
        }
        
        
        function oneSecondDelay(f, delay){
            var timer = null;
            return function(){
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function(){
                    f.apply(context, args);
                },
                delay || 500);
            };
        }
        //Neeeeeeeeeeeeeed Configuration 
        $('.query_box_direct_value').keyup(oneSecondDelay(function(){
            var thisID = $(this).attr('id');
            var temp_number = thisID.replace('single_keyword_','');
            $('#wptf_query_search_button_' + temp_number).trigger('click');
        }));
        $('body').on('change','.search_select,.query_box_direct_value',function(){
            var thisID = $(this).parents('.wptf_product_table_wrapper').attr('id');
            var temp_number = thisID.replace('table_id_','');
           $('#wptf_query_search_button_' + temp_number).trigger('click');
        });
        /**
         * Search Box Query and Scripting Here
         * @since 1.9
         * @date 9.6.2018 d.m.y wpt_query_search_button
         */
        
        $( 'body' ).on('click','button.wptf_query_search_button,button.wptf_load_more', function(){
            
            var temp_number = $(this).data('temp_number');
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            //Added at 2.7

            var loadingText = config_json.loading_more_text;// 'Loading...';
            
            var searchText = config_json.search_button_text;
            var loadMoreText = config_json.load_more_text;//'Load More';
            var thisButton = $(this);
            var actionType = $(this).data('type');
            var load_type = $(this).data('load_type');
            
            thisButton.html(loadingText);

            
            var targetTable = $('#table_id_' + temp_number + ' table#wptf_table');
            var targetTableArgs = targetTable.attr( 'data-data_json' );
                targetTableArgs = JSON.parse(targetTableArgs);
            
            var targetTableArgsBackup = targetTable.data( 'data_json' );
            var targetTableBody = $('#table_id_' + temp_number + ' table#wptf_table tbody');
            var pageNumber = targetTable.attr( 'data-page_number' );
            if( actionType === 'query' ){
                pageNumber = 1;
            }
            
            
            
            var key,value;
            var directkey = {};
            $('#search_box_' + temp_number + ' .search_single_direct .query_box_direct_value').each(function(){
                
                key = $(this).data('key');
                value = $(this).val();
                directkey[key] = value;
            });
            var texonomies = {};
            value = false;
            //console.log($('#search_box_' + temp_number + ' .search_select.query').val());
            $('#search_box_' + temp_number + ' .search_select.query').each(function(){
                
                key = $(this).data('key');
                var value = $(this).val();//[];var tempSerial = 0;
                texonomies[key] = value;
            });
            console.log(texonomies);
            
            
            var custom_field = {};
            value = false;

            $('#search_box_' + temp_number + ' .search_select.cf_query').each(function(){
                
                key = $(this).data('key');
                var value = $(this).val();//[];var tempSerial = 0;
                if(value != ""){
                    custom_field[key] = value;
                }
            });

            //Generating Taxonomy for Query Args inside wp_query
            var final_taxomony = {};
            Object.keys(texonomies).forEach(function(aaa,bbb){
                var key = aaa + '_IN';
                if(texonomies[aaa] !== null && Object.keys(texonomies[aaa]).length > 0){
                    final_taxomony[key] = {
                        taxonomy: aaa,
                        field:  'id',  
                        terms:  texonomies[aaa],
                        operator:   'IN'
                    };
                }else{
                    targetTableArgs.args.tax_query[key] =targetTableArgsBackup.args.tax_query[key];
                } 
            });
            if(Object.keys(texonomies).length > 0){
                Object.assign(targetTableArgs.args.tax_query,final_taxomony);
            }else{
                targetTableArgs.args.tax_query = targetTableArgsBackup.args.tax_query;
            }

            //Generating Custom Field/Meqa Query for Query Args inside wp_query
            var final_custom_field = {};
            Object.keys(custom_field).forEach(function(key,bbb){
                if(Object.keys(custom_field[key]).length > 0){ //custom_field[key] !== null && 
                    final_custom_field[key] = {
                        key: key,  
                        value:  custom_field[key],
                    };
                }else{
                    targetTableArgs.args.meta_query[key] =targetTableArgsBackup.args.meta_query[key];
                } 
            });
            if(Object.keys(custom_field).length > 0){
                var backupMetaQuery = targetTableArgsBackup.args.meta_query;
                Object.keys(backupMetaQuery).forEach(function(key,index){
                    final_custom_field[key] = backupMetaQuery[key];
                });
                targetTableArgs.args.meta_query = final_custom_field;
            }else{
                targetTableArgs.args.meta_query = targetTableArgsBackup.args.meta_query;
            }

            
            
            
            //Display Loading on before load
            targetTableBody.prepend("<div class='table_row_loader'>" + config_json.loading_more_text + "</div>"); //Laoding..
            $.ajax({
                type: 'POST',
                url: ajax_url,// + get_data,
                data: {
                    action:         'wptf_query_table_load_by_args',
                    temp_number:    temp_number,
                    directkey:      directkey,
                    targetTableArgs:targetTableArgs, 
                    texonomies:     texonomies,
                    pageNumber:     pageNumber,
                    load_type:     load_type,
                    custom_field : custom_field,
                },
                complete: function(){
                    $( document ).trigger( 'wc_fragments_refreshed' );
                    loadMiniFilter(); //@Since 4.8
                    fixAfterAjaxLoad();
                    arrangingTDContentForMobile()
                },
                success: function(data) {
                    
                    $('.table_row_loader').remove();
                    if( actionType === 'query' ){
                        $('#wptf_load_more_wrapper_' + temp_number).remove();
                        targetTableBody.html( data );
                        var $data = {
                                action:         'wptf_ajax_paginate_links_load',
                                temp_number:    temp_number,
                                directkey:      directkey,
                                targetTableArgs:targetTableArgs, 
                                texonomies:     texonomies,
                                pageNumber:     pageNumber,
                                load_type:     load_type,
                            };
                        loadPaginationLinks($data,temp_number);
                        
                        targetTable.after('<div id="wptf_load_more_wrapper_' + temp_number + '" class="wptf_load_more_wrapper"><button data-temp_number="' + temp_number + '" data-type="load_more" class="button wptf_load_more">' + loadMoreText + '</button></div>');
                        thisButton.html(searchText);
                    }
                    if( actionType === 'load_more' ){
                        if(data !== config_json.product_not_founded){ //'Product Not found' //Products Not founded!
                            targetTableBody.append( data );
                            thisButton.html(loadMoreText);
                            
                            //Actually If you Already Filter, Than table will load with Filtered.
                            filterTableRow(temp_number);
                        }else{
                            $('#wptf_load_more_wrapper_' + temp_number).remove();
                            alert(config_json.no_more_query_message);//"There is no more products based on current Query."
                        }
                        
                    }
                    removeCatTagLings();//Removing Cat,tag link, if eanabled from configure page
                    pageNumber++; //Page Number Increasing 1 Plus
                    targetTable.attr('data-page_number',pageNumber);
                },
                error: function() {
                    alert("Error On Ajax Query Load. Please check console.");
                    console.log('Error Here');
                },
            });
            
            emptyInstanceSearchBox(temp_number);//When query finished, Instant search box will empty
            
        });
        
        function loadPaginationLinks($data,temp_number){
            var targetTable = $('#table_id_' + temp_number + ' table#wptf_table');
            $.ajax({
                    type: 'POST',
                    url: ajax_url,// + get_data,
                    data: $data,
                    success: function(paginate_data){
                        var thisPagiWrappers = $('#table_id_' + temp_number + ' .wptf_table_pagination');
                        thisPagiWrappers.html(paginate_data);
                        changeSpanToAPagi();
                        var newjsonData = $('mypagi').attr('myjson');
                        targetTable.attr( 'data-data_json', newjsonData );
                        thisPagiWrappers.removeClass('pagination_loading');
                    }
                });
        }
        
        /**
         * Handleling Filter Features
         */
        $('body').on('change','select.filter_select',function(){
            var temp_number = $(this).data('temp_number');
            filterTableRow(temp_number);
            
        });
        
        $('body').on('click','a.wptf_filter_reset',function(e){
            e.preventDefault();
            var temp_number = $(this).data('temp_number');
            $('#table_id_' + temp_number + ' select.filter_select').each(function(){
                $(this).children().first().attr('selected','selected');
            });
            filterTableRow(temp_number);
        });
        
         $('body').on('click', 'input.wptf_check_universal,input.enabled.wptf_tabel_checkbox.wptf_td_checkbox', function() { //wptf_td_checkbox
            var temp_number = $(this).data('temp_number');
            var checkbox_type = $(this).data('type'); //universal_checkbox
            if (checkbox_type === 'universal_checkbox') {
                $('#table_id_' + temp_number + ' input.enabled.wptf_tabel_checkbox.wptf_td_checkbox:visible').prop('checked', this.checked); //.wptf_td_checkbox
                $('input#wptf_check_uncheck_column_' + temp_number).prop('checked', this.checked);
                $('input#wptf_check_uncheck_button_' + temp_number).prop('checked', this.checked);
            }
            var temp_number = $(this).data('temp_number');
            updateCheckBoxCount(temp_number);
        });
        
        function filterTableRow(temp_number){
            emptyInstanceSearchBox(temp_number);
            //Uncheck All for each Change of Filter
            uncheckAllCheck(temp_number);
            
            //Checking FilterBox
            var filterBoxYesNo = $('#table_id_' + temp_number + ' .wptf_filter_wrapper').html();

            /**
             * Uncheck All, If any change on filter button
             * @version 2.0
             */
            
            var ClassArray =[];
            var serial = 0;
            $('#table_id_' + temp_number + ' .wptf_filter_wrapper select.filter_select').each(function(){
                var currentClass = $(this).val();
                
                if(currentClass !==''){
                    ClassArray[serial] = '.' + currentClass;
                    serial++;
                }
            });
            var finalClassSelctor = '.filter_row' + ClassArray.join(''); //Test will keep
            console.log(finalClassSelctor);
            var hideAbleClass = '#table_id_' + temp_number + ' table tr.wptf_row';
            
           
           if( filterBoxYesNo ){
                $(hideAbleClass + ' td.wptf_check input.enabled.wptf_tabel_checkbox').removeClass('wptf_td_checkbox');
                $(hideAbleClass).css('display','none');
                $(hideAbleClass).removeClass('visible_row');

                $(finalClassSelctor).fadeIn();
                $(finalClassSelctor).addClass('visible_row');
                $(finalClassSelctor + ' td.wptf_check input.enabled.wptf_tabel_checkbox').addClass('wptf_td_checkbox');
            }
            
            /**
             * Updating Check Founting Here
             */
            updateCheckBoxCount(temp_number);
        }
        
        function updateCheckBoxCount(temp_number){
            config_json = getConfig_json( temp_number ); //Added vat V5.0
            var add_cart_text = $('#table_id_' + temp_number).data('add_to_cart');
            var currentAllSelectedButtonSelector = $('#table_id_' + temp_number + ' a.button.add_to_cart_all_selected');
            var itemAmount = 0;
            $('#table_id_' + temp_number + ' input.enabled.wptf_tabel_checkbox:checked').each(function() { //wptf_td_checkbox
                itemAmount++;//To get Item Amount
            });
            var itemText = config_json.items;//'Items';
            if (itemAmount === 1 || itemAmount === 0) {
                itemText = config_json.item;//'Item';
            }
            currentAllSelectedButtonSelector.html( add_cart_text + ' [ ' + itemAmount + ' ' + itemText + ' ]');
        }
        function uncheckAllCheck(temp_number){
            $('#table_id_' + temp_number + ' input.wptf_check_universal:checkbox,#table_id_' + temp_number + ' table input:checkbox').attr('checked',false);
        }
        
        /**
         * For Instance Search
         * @since 2.5
         */
        $('.instance_search_input').keyup(function(){
            var text,value_size,serial;
            var temp = $(this).data('temp_number');
            var value = $(this).val();
            value = value.trim();
            
            value = value.split(' ');
            value = value.filter(function(eachItem){
                return eachItem !== '';
            });
            value_size = value.length;

            
            var target_table = '#table_id_' + temp + ' #wptf_table';
            $(target_table + ' tr.visible_row').each(function(){
                text = $(this).html();
                text = text.toLowerCase();
                serial = 0;
                value.forEach(function(eachItem){
                    if(text.match(eachItem.toLowerCase(),'i')){
                        serial++;
                    }
                });
                
                if(serial > 0 || value_size === 0){
                    $(this).fadeIn();
                }else{
                    $(this).fadeOut();
                }
                
            });
            
        });
        
        function emptyInstanceSearchBox(temp_number){
            $('#table_id_' + temp_number + ' .instance_search_input').val('');
        }
        
        /**
         * For Add to Quote Plugin
         * YITH add to Quote Request plugin
         * @since 2.6 
         * @date 20.7.2018
         */
        //ywraq_frontend
        $('body').on('click','a.yith_add_to_quote_request.enabled',function(e){
            e.preventDefault();
            var thisButton = $(this); //New added at 4.0.19 
            if ( typeof ywraq_frontend === 'undefined' ){
                alert("Quote Request plugin is not installed.");
                return false;
            }
            var msg = $(this).data('msg');
            var response_msg = $(this).attr('data-response_msg');
            if(response_msg !== ''){
                alert(response_msg);
                $('.' + selector).html(msg.added);
                return false;
            }
            var selector = $(this).data('selector');
            $('.' + selector).html(msg.adding);
            var add_to_cart_info;
            var wp_nonce = $(this).data('wp_nonce');
            var product_id = $(this).data('product_id');
            
            var quantity = $(this).attr('data-quantity');
            var quote_data = $(this).attr('data-quote_data');
            var yith_browse_list = $(this).data('yith_browse_list');
            
            
            add_to_cart_info = 'action=yith_ywraq_action&ywraq_action=add_item';
            add_to_cart_info += quote_data;
            add_to_cart_info += '&quantity=' + quantity;
            add_to_cart_info += '&product_id=' + product_id;
            add_to_cart_info += '&wp_nonce=' + wp_nonce;
            add_to_cart_info += '&yith-add-to-cart=' + product_id;
            var yith_ajax_url;// = ywraq_frontend.ajaxurl;
            yith_ajax_url = ywraq_frontend.ajaxurl.toString().replace( '%%endpoint%%', 'yith_ywraq_action' );
            
            $.ajax({
            type   : 'POST',
            url    : yith_ajax_url,
            dataType: 'json',
            data   : add_to_cart_info,
            beforeSend: function(){

            },
            complete: function(){
            },
            success: function (response) {
                console.log(response);
                if( response && ( response.result === 'true' || response.result === 'exists' ) ){
                    $('.' + selector).html(msg.added);
                    if(response.result === 'exists'){
                        
                        $('.' + selector).attr('data-response_msg',response.message);
                        //alert(response.message);
                    }
                    var html;
                    //$('.wptf_quoterequest img').remove();
                    //$('.' + selector + '+.yith_ywraq_add_item_browse_message').remove();
                    //$('.' + selector + '+.yith_ywraq_add_item_response_message').remove();
                    html = '<div class="yith_ywraq_add_item_response_message">' + response.message + '</div>';
                    html += '<a href="'+response.rqa_url+'" target="_blank">' + yith_browse_list + '</a>';
                    
                    $('td.' + selector + '_td').html( html ); //response.label_browse
                    //$('.' + selector).hide();
                   
                }else{
                    $('.' + selector).html(msg.added);
                }
                //thisButton.parent().show();  //New added at 4.0.19 
            }
        });
        });
        
        loadMiniFilter();
        /**
         * Loading MiniFilter 's option based on loaded products
         * @since 4.8
         * 
         * @returns {void}
         */
        function loadMiniFilter(){
            $('.wptf_product_table_wrapper .wptf_filter_wrapper select.filter_select').each(function(){
                var id = $(this).attr('id');
                var temp_number = $(this).data('temp_number');
                var key =  $(this).data('key');
                var label =  $(this).data('label');
                var taxArray = new Array();
                $('#table_id_' + temp_number + ' tbody tr').each(function(){
                    var tax = $(this).data(key);
                    if(tax && tax !== ''){
                        tax = tax.replace(/,\s*$/, "");
                        tax = tax.replace(/\s/g, ' ');

                        tax = tax.split(',');

                        tax.forEach(function(item){
                            var taxDetails = item.split(':');
                            var taxID = taxDetails[0];
                            var taxValue = taxDetails[1];
                            taxArray[taxID] = taxValue;
                        });
                    }
                });
                //console.log(taxArray);
                /*
                if(config_json.sort_mini_filter === 'ASC'){
                    taxArray.sort(function(a,b){return a-b});
                }else if(config_json.sort_mini_filter === 'DESC'){
                    taxArray.sort(function(a,b){return b-a});
                }
                */
               var html = '<option value="">' + label + '</option>';
                taxArray.forEach(function(value,number){
                    html += '<option value="' + key + '_' + temp_number + '_' + number + '">' + value + '</option>';
                });
                $(this).html(html);
            });
        }
        /**
         * Colunm Sorting Option
         * 
         * @since 2.8
         * @date 26.7.2018
         */
        $('body').on('click','table.wptf_product_table thead tr th',function(){
            var inactivated_column = ['wptf_check','wptf_action','wptf_quantity'];
            var class_for_sorted = 'this_column_sorted';
            var temp_number = $(this).parent().data('temp_number');
            var target_class = '.' + $(this).attr('class').split(' ').join('.');
            var target_table_wrapper_id = '#table_id_' + temp_number;
            
            console.log(target_class);
            //for check box collumn //wptf_thumbnails //wptf_product_id
            if(target_class !== '.wptf_product_id' && target_class !== '.wptf_thumbnails' && target_class !== '.wptf_quick' && target_class !== '.wptf_Message' && target_class !== '.wptf_serial_number' && target_class !== '.wptf_quoterequest' && target_class !== '.wptf_check' && target_class !== '.wptf_quantity' && target_class !== '.wptf_action'){
            
                $(target_table_wrapper_id + ' .' +class_for_sorted).removeClass(class_for_sorted);
                
                //Again Class Reform after remove class
                target_class = '.' + $(this).attr('class').split(' ').join('.');

                var sort_type = $(this).attr('data-sort_type');
                
                if(!sort_type || sort_type === 'ASC'){
                    sort_type = 'ASC';
                    $(this).attr('data-sort_type','DESC');
                }else{

                    $(this).attr('data-sort_type','ASC');
                }
                var contentArray = [];
                var contentHTMLArray = [];
                var currentColumnObject = $(target_table_wrapper_id + ' table tbody td' + target_class);
                currentColumnObject.each(function(index){
                    var text,html = '';
                    text = $(this).text();
                    var product_id = $(this).parent('tr').data('product_id');

                    //Refine text
                    text = text + '_' + product_id;
                    var rowInsideHTMLData = $(this).parent('tr').html();

                    var thisRowObject = $('#table_id_'+ temp_number +' #product_id_' + product_id);
                    var thisRowAttributes = thisRowObject[0].attributes;
                    var thisRowAttributesHTML = '';
                    $.each(thisRowAttributes,function(i,item){

                        if(this.specified) {
                            thisRowAttributesHTML += this.name + '="' + this.value + '" ';
                        }

                    });
                    html += '<tr ' + thisRowAttributesHTML + '>';
                    html += rowInsideHTMLData;
                    html += '</tr>';
                    contentArray[index] = text;
                    contentHTMLArray[text] = html;
                });
                function sortingData(a, b){
                    
                    //Added at 3.4

                    if(target_class === '.wptf_price' || target_class === '.wptf_price.this_column_sorted') { //.wptf_price.this_column_sorted
                        a = ( a.match(/\d+\.\d+|\d+\b|\d+(?=\w)/g) || [] ).map(function (v) {return +v;});
                        a = a[0];

                        b = ( b.match(/\d+\.\d+|\d+\b|\d+(?=\w)/g) || [] ).map(function (v) {return +v;});
                        b = b[0];
                    }
                    var return_data;
                    if(sort_type === 'ASC'){
                        return_data = ((a < b) ? -1 : ((a > b) ? 1 : 0));
                    }else{
                        return_data = ((b < a) ? -1 : ((b > a) ? 1 : 0));
                    }
                    return return_data;
                  }
                  
                  var sortedArray = contentArray.sort(sortingData);
                  console.log(sortedArray);
                  var finalHTMLData = '';
                  $.each(sortedArray,function(index,value){
                      finalHTMLData += contentHTMLArray[value];
                  });

                //Backed HTML Data
                $(target_table_wrapper_id + ' table>tbody').html(finalHTMLData);

                $(target_table_wrapper_id + ' ' +target_class).addClass(class_for_sorted);
            }

        });
        
        
        //* Removeing link for cat and tag texonomy
        removeCatTagLings();
        /**
         * Removing Linkg for Categories link and from Tag's link.
         * We will remove link by JavaScript I mean: jQuery
         * 
         * @since 3.1
         * @date: 13 sept, 2018
         */
        function removeCatTagLings(){
           if(config_json.disable_cat_tag_link === '1'){
                $('.wptf_category a,.wptf_tags a').contents().unwrap();
            } 
        }
        // Removing link feature End here  */
        
    });
    
    
     
    
    arrangingTDContentForMobile();
    function arrangingTDContentForMobile(){
        $('table.mobile_responsive tr.wptf_row').each(function(){
            var already_updated = $(this).attr('already');
            if((typeof already_updated === 'undefined')){
                $(this).attr('already','yes');

                var htmlDesc,htmlAction,htmlImg,htmlCfTax;
                var actionElement = $(this).children('td.wptf_action');
                var productDescElement = $(this).children('td.wptf_product_title');

                htmlDesc = "";

                htmlDesc += "<div class='wptf_mobile_desc_part'>";
                $(this).children('td.wptf_for_product_desc').each(function(){
                    var attr = "";
                    $.each(this.attributes, function() {
                        if(this.specified) {
                            attr += ' ' + this.name + '="' + this.value + '"';
                        }
                    });
                    htmlDesc += "<div " + attr + ">" + $(this).html() + "</div>";//"<div class='" + td_class + "'>" + $(this).html() + "</div>";

                });
                htmlDesc += "</div>"


                htmlImg = ""; //wptf_for_thumbs_desc

                //htmlDesc += "<div class='wptf_mobile_desc_part'>";
                $(this).children('td.wptf_for_thumbs_desc').each(function(){
                    var attr = "";
                    $.each(this.attributes, function() {
                        if(this.specified) {
                            attr += ' ' + this.name + '="' + this.value + '"';
                        }
                    });
                    htmlImg += "<div " + attr + ">" + $(this).html() + "</div>";//"<div class='" + td_class + "'>" + $(this).html() + "</div>";

                });
                //htmlDesc += "</div>"



                htmlCfTax = "";
                $(this).children('td.wptf_custom_cf_tax').each(function(){
                    var attr = "";
                    $.each(this.attributes, function() {
                        if(this.specified) {
                            attr += ' ' + this.name + '="' + this.value + '"';
                        }
                    });
                    htmlCfTax += "<div " + attr + ">" + $(this).html() + "</div>";//"<div class='" + td_class + "'>" + $(this).html() + "</div>";

                });
                if(htmlCfTax !== ""){
                    htmlDesc += "<div class='wptf_custom_cf_tax'>";
                    htmlDesc += htmlCfTax;
                    htmlDesc += "<div>";
                }

                htmlAction = "";
                $(this).children('td.wptf_for_product_action').each(function(){
                    var attr = "";
                    $.each(this.attributes, function() {
                        if(this.specified && this.name !== 'data-price_html') {
                            attr += ' ' + this.name + '="' + this.value + '"';
                        }
                    });
                    htmlAction += "<div " + attr + ">" + $(this).html() + "</div>";//"<div class='" + td_class + "'>" + $(this).html() + "</div>";

                });

                if(actionElement.length > 0){
                    actionElement.prepend(htmlAction);
                }else{
                    htmlDesc += "<div class='wptf_conditon_desc_load'>";
                    htmlDesc += htmlAction;
                    htmlDesc += "<div>";
                }
                productDescElement.prepend(htmlImg);
                productDescElement.append(htmlDesc);
            }
            
        });
    }
})(jQuery);