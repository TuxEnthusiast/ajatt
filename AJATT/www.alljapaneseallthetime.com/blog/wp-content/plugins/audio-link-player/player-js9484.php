jQuery(window).load(function(){
var element_counter = 0;
var general_class = 'audio-link-player';

// Add an mp3 player
jQuery('a').each(function(){
  
  // Selection:
  if ( this.href.substr(-4).toLowerCase().indexOf('.mp3') < 0 ) return;

  // Definitions:
  var $this = jQuery(this);
  var flash_container_id;
  var flash_container;
  var player_swf;
  var flash_vars = {};
  var flash_param = { 'wmode' : 'transparent' };
  var width = 0;
  var height = 0;
  element_counter++;
  
  // Set title & href
  if ($this.attr('href') == undefined || $this.attr('href') == null) $this.attr('href', '');
  if ($this.attr('title') == undefined || $this.attr('title') == null) $this.attr('title', '');
  
  // create a new object
  // find a unique object name
  flash_container_id = 'flash_container_audio_link_player_' + element_counter;
  
  // generate an object code
  flash_container = '<span id="' + flash_container_id + '"></span>';
  
  // decide which player
  if( $this.text() != $this.parent().text() && $this.find('img').length == 0 ) {
    // the link is an inline element in a floating text
    var attributes = { 'class' : general_class + ' inline-player' };    
    
    // position
        $this.before(flash_container + '&nbsp;');
        
    // Build a flash app
    player_swf = 'http://www.alljapaneseallthetime.com/blog/wp-content/plugins/audio-link-player/xspf/player.swf'; 
    flash_vars.song_url = encodeURIComponent(this.href);
    flash_vars.b_bgcolor = 'cccccc';
    flash_vars.b_fgcolor = '666666';
    flash_vars.b_colors = 'ff0000,0000ff,00ff00,000000';
    flash_vars.autoplay = false;
    
    // in the xspf player these values are not variable
    width = 17;
    height = 17;
    
    // Add the player
    swfobject.embedSWF(player_swf, flash_container_id, width, height, "9.0.0", null, flash_vars, flash_param, attributes);
    
      }
  

  if ( $this.text() == $this.parent().text() && $this.find('img').length == 0){
    // the link is the only element in the paragraph / list item
    var attributes = { 'class' : general_class + ' single-line-player' };
    
    // Read the configuration
    height = 24;
        player_swf = 'http://www.alljapaneseallthetime.com/blog/wp-content/plugins/audio-link-player/1pixelout/player.swf'; 
    width = 200;
        
    // Read the title of the mp3 link
    if ($this.attr('title') == '') $this.attr('title', $this.text());
    var caption = $this.attr('title');
    
    // Collect flash vars and parameters
    flash_vars.soundFile = escape(this.href.replace(/,/g, '%2C'));
    flash_vars.titles = ' ';
    flash_vars.artists = caption.replace(/,/g, ' ');
    flash_vars.autostart = 'no';
    flash_vars.width = width;
    flash_vars.height = height;
    flash_vars.bg = '0xE5E5E5';
    flash_vars.leftbg = '0xCCCCCC';
    flash_vars.lefticon = '0x333333';
    flash_vars.voltrack = '0xF2F2F2';
    flash_vars.volslider = '0x666666';
    flash_vars.rightbg = '0xB4B4B4';
    flash_vars.rightbghover = '0x999999';
    flash_vars.righticon = '0x333333';
    flash_vars.righticonhover = '0xFFFFFF';
    flash_vars.loader = '0x009900';
    flash_vars.track = '0xFFFFFF';
    flash_vars.tracker = '0xDDDDDD';
    flash_vars.border = '0xCCCCCC';
    flash_vars.text = '0x333333';
    flash_vars.initialvolume = 60;

    // Prepare the Flash Container for the player
        $this.after('&nbsp;' + flash_container);
    
    // Add the player:
    swfobject.embedSWF(player_swf, flash_container_id, width, height, "9.0.0", null, flash_vars, flash_param, attributes);
  }
    

  if ($this.text() == '' && $this.find('img').length == 1){
    // A linked image
    var attributes = { 'class' : general_class + ' image-link-player' };

    flash_vars.file = flash_vars.link = encodeURIComponent(this.href);
    flash_vars.image = $this.find('img:eq(0)').attr('src');
    flash_vars.autostart = false;
    flash_vars.skin = 'http://www.alljapaneseallthetime.com/blog/wp-content/plugins/audio-link-player/jw_player/skin.swf';
    flash_vars.volume = 60;
    
    player_swf = 'http://www.alljapaneseallthetime.com/blog/wp-content/plugins/audio-link-player/jw_player/player.swf';
    attributes.styleclass = $this.find('img').attr('class');
    
    var attribute_height = parseInt($this.find('img').attr('height'));
    var real_height = $this.find('img').height();
    if (isNaN(attribute_height)) height = real_height + 20;
    else height = Math.max(real_height, attribute_height);
    width = $this.find('img').width();

    $this.replaceWith(flash_container);

    // Add the player:
    swfobject.embedSWF(player_swf, flash_container_id, width, height, "9.0.0", null, flash_vars, flash_param, attributes);
  }
  
}); // End of Each loop 
}); // End of DOM Ready Sequence
/* End of File */