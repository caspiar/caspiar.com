$(document).ready(function() {

/* On page load, load all elements */
load_page();

/* On page resize, call element-resize function */
$(window).resize(function() {
    resize_page_elements(null, true, function (){
    });
});

/* On navigation-attempt, start process of switching page content. */
$('#main_menu .element .background').live('click',function(){
    var new_page = $(this).parent().attr('id').substring(10);
    load_new_page(new_page);
});

$('a.call_to_action').live('click',function(event){
    if($(this).attr('target') != '_blank'){
        event.preventDefault();
        var new_page = $(this).attr('href');
        load_new_page(new_page);        
    }
});

/* Load page */
function load_page(page_name){
    if(!page_name){
        page_name = $('input#hidden_initial_page').val();
    }
    page_data_str = $('input#hidden_page_content_'+page_name).val();
    page = $.parseJSON(page_data_str);
    var image_url =  get_image_url(page.url);
    var image = $('<img style="display: none;" src="'+image_url+'" />');
    image.load(function(){
        continue_loading_page(page_name, page);
    });
}

/* Continue loading page, after image is loaded */
 function continue_loading_page(page_name, page) {
    // Hide the loading image
    $('#loading_icon').hide();
    
    // Add background image to the body
    $('body').css('background-image', 'url("'+get_image_url(page.url)+'")');
    
    // Assign the 'current' class to the active menu item
    assign_current_class();
    
    // Bring in banner
    $('#banner').show('slide', {direction: 'left'}, 1500, function(){
        
        // Show banner
        resize_page_elements(null, false, function (new_banner_height){
            $('#banner').animate({height: new_banner_height}, 500, function(){
                // Show logo
                $('img#logo').css('opacity',0).animate({opacity:1}, 1000);
                
                // Show menu items, one at a time
                get_menu_items(function(menu_items){
                    var min = 500;
                    var max = 1500;              
                    var time_to_slide = 500;
                    $.each(menu_items, function() {
                    time_to_slide = Math.random() * (max - min) + min;
                        $("#main_menu_" + this).show('slide', {direction: 'down'}, time_to_slide);
                    });
                    // Load all the other huge images that the site will need if the user navigates
                    var image_url = '';
                    $.each(menu_items, function() {
                    var image_url = get_image_url(this);
                        var image = $('<img style="display: none;" src="'+image_url+'" />');
                        image.load();
                    });                     
                });
                // Show blurb
                $('#blurb').show('slide', {direction: 'left'}, 1000);
            });
        });
    });
 }
 
/* Slide background-image of body element, if fails just change css property without animation */
function slide_body_background(new_background_position_x, callback){
    try{
        $('body').animate({'background-position-x': new_background_position_x}, 300, 'linear');   
    } catch(err) {
        $('body').css('background-position-x', new_background_position_x);
    }
    callback(true);
}
 
/* Load a new page */
function load_new_page(page_name){
    get_menu_items(function(menu_items){
        if ($.inArray(page_name, menu_items) == -1){
            page_name ='home';
        }
        var push_directory = page_name;
        if(push_directory == 'home'){
            push_directory = '';
        }
        push_url = $('input#hidden_site_rel_base').val() + push_directory;
        $('input#hidden_current_page').val(page_name);
        
        // Change highlighted menu item
        assign_current_class();
        
        // Try push_state (change url in browser)
        try{
            history.pushState({page:push_url}, push_url, push_url);
        } catch(err){
        }
        
        // Hide blurb
        if($('#blurb').is(":visible")){
            $('#blurb').hide('slide', {direction: 'left'}, 500);
        }

        // Slide out out background image
        var new_background_position_x = ($(window).width() + 200) * -1;
        slide_body_background(new_background_position_x, function(){
            // Show loading bar
            $('#loading_icon').show();
            
            // Slide new background image in
            page_data_str = $('input#hidden_page_content_'+page_name).val();
            page = $.parseJSON(page_data_str);
            var image = $('<img style="display: none;" src="'+get_image_url(page.url)+'" />');
            image.load(function(){
                $('body').css('background-image', 'url("'+get_image_url(page.url)+'")');
                var new_background_position_x = ($(window).width() + 200);
                $('body').css('background-position-x', new_background_position_x);
                slide_body_background(0, function(){
                    
                    // Change background-position to center
                    $('body').css('background-position', 'center');

                    // Hide loading bar
                   $('#loading_icon').hide();

                    // Change blurb content and reopen
                    $('#headline').html(page.headline);
                    $('#headline').css('opacity',0);
                    $('#blurb_content').html(page.blurb);
                    $('#blurb_content').css('opacity',0);
                    $('#blurb').show('slide', {direction: 'left'}, 300, function(){
                        $('#blurb_content').css('opacity',0).animate({opacity:1}, 1000);
                        $('#headline').css('opacity',0).animate({opacity:1}, 1000);
                        // Resize elements
                        resize_page_elements(null, true, function (){                        
                        });

                    });
                    // Change meta data
                    var site_name = $('input#hidden_site_name').val();
                    $('title').html(page.title+' | '+site_name);
                    $('meta[property=og\\:title]').attr('content', page.title);
                    $('meta[property=og\\:url]').attr('content', $('input#hidden_ws_root').val()+push_directory);                   
                    $('meta[property=og\\:image]').attr('content', get_image_url(page.url, 'medium'));                    
                    $('meta[property=og\\:description]').attr('content', page.meta_description);
                    $('meta[name=keywords]').attr('content', page.meta_description);
                    $('meta[name=description]').attr('content', page.meta_description);
                });       
            });         
        });        
    });
}

/* Get image url */
function get_image_url(image_name, image_size){
    if(!image_name){
        image_name = 'home';
    }
    if(!image_size){
        image_size = 'medium';
    }
    var image_url = $('input#hidden_img_base').val()+image_size+'/'+image_name+'.jpg';
    return image_url;
}
 
/* Resize all page elements */
function resize_page_elements(new_banner_height, resize_banner, callback){
    var desired_height = $(window).height() * 0.2;
    if(new_banner_height){
        banner_height = new_banner_height;
    } else {
        banner_height = desired_height;
    }
    var logo_height = 0.46 * banner_height;
    var logo_padding = 0.333 * banner_height;
    $('img#logo').css('height', logo_height);
    $('img#logo').css('margin-top', logo_padding);
    $('img#logo').css('display', 'block');
    $('#main_menu .element').css('height', banner_height);
    $('#main_menu .element').css('width', banner_height);
    $('#main_menu .element').css('min-height', banner_height / 3);
    $('#main_menu .element').css('top', banner_height * -1);
    $('#main_menu .element .background').css('padding', banner_height/15 + 'px ' + banner_height/5 + 'px');
    if(ie && ie < 9){
        $('#main_menu .element .background').css('padding', banner_height/5 + 'px ' + banner_height/15 + 'px');
    }    
    $('#main_menu .element .background').css('font-size', banner_height / 9.375);
    get_menu_items(function(menu_items){
        var right_increment = banner_height / 3;
        var right_position = right_increment * 5;
        var left_most_reach_of_menu = right_position + banner_height;
        $.each(menu_items, function() {
            $("#main_menu_" + this).css('right', right_position+'px');
            right_position = right_position - right_increment;
        });           
        $('#blurb').css('font-size',banner_height / 6);
        $('#headline').css('font-size',banner_height / 3.75);
        $('a.call_to_action').css('font-size',banner_height / 6);
        $('#blurb').css('padding',banner_height / 3.75);
        $('#blurb').css('top',banner_height / 1.2);
        if(resize_banner){
            $('#banner').css('height',banner_height);
        }
        // Check to make sure elements are not encroaching on each other. If they are, try again.
        var total_menu_size = right_increment * menu_items.length + $('#main_menu .element').width();
        var total_element_size = $('#blurb').width() + $('img#logo').width() * 1.7 + left_most_reach_of_menu;
        if(total_element_size >= $(window).width()){
            resize_page_elements(banner_height - 10, resize_banner, callback);
        }else{
            callback(banner_height);   
        } 
    });
}

function get_menu_items(callback){
    var menu_items = new Array('home', 'about', 'contact', 'careers', 'login', 'ftw');
    callback(menu_items);
}

function assign_current_class(){
    // Remove all existing highlights
    $('.element').removeClass('current');
    // Add highlight to current page's menu-item
    var current_page = $('input#hidden_current_page').val();
    $('#main_menu_'+current_page).addClass('current');
}


});