<?php
/**
*Plugin Name: Basic Plugin
*Plugin URI: http://dev.moneymorning.com/matt
*Author: Matt
*/

class wp_my_plugin extends WP_Widget {

	// constructor
	    function wp_my_plugin() {
	        parent::WP_Widget(false, $name = __('My Widget', 'wp_widget_plugin') );
	    }

			// widget form creation



	// update widget
	function update($new_instance, $old_instance) {
	      $instance = $old_instance;
	      // Fields
	      $instance['title'] = strip_tags($new_instance['title']);
	      $instance['text'] = strip_tags($new_instance['text']);
	      $instance['textarea'] = strip_tags($new_instance['textarea']);
	     return $instance;
	}

	// display widget
	function widget($args, $instance) {
	   extract( $args );
	   // these are the widget options
	   $title = apply_filters('widget_title', $instance['title']);
	   $text = $instance['text'];
	   $textarea = $instance['textarea'];
	   echo $before_widget;
	   // Display the widget
	   echo '<div class="widget-text wp_widget_plugin_box">';
		 echo <<<END
		 <label for="">Input stock ticker for current price: </label>
		 <input type="text" name="" value="" id="stock">
		 <br>
		 <input type="submit" id="submit-stock">
		 <p id="output"></p>

		 <script
		   src="http://code.jquery.com/jquery-3.2.1.slim.min.js"
		   integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
		   crossorigin="anonymous"></script>
		 <script src="http://dev.moneymorning.com/matt/wp-content/themes/mattNewTheme-writee/barchart-ondemand-client-js.min.js"></script>
		 <script>
		 var onDemand = new OnDemandClient();

		 onDemand.setAPIKey('d66a5689f6cae0e06a7e5d9f1317484b');
		 onDemand.setJsonP(true);

		 var output = $('#output')
		 var submit = $('#submit-stock')
		 var stock = $('#stock')
		 submit.click(function(){
		 var s = stock.val()
		 getStock(s)
		 })

		 function getStock(stock) {
		   /* get a quote for AAPL and GOOG */
		   onDemand.getQuote({symbols: stock}, function (err, data) {
		           var quotes = data.results;
		           output.text('Current price is: $' + quotes[0].lastPrice);
		 })
		 }

		 </script>


END;
	   // Check if title is set
	   if ( $title ) {
	      echo $before_title . $title . $after_title;
	   }

	   // Check if text is set
	   if( $text ) {
	      echo '<p class="wp_widget_plugin_text">'.$text.'</p>';
	   }
	   // Check if textarea is set
	   if( $textarea ) {
	     echo '<p class="wp_widget_plugin_textarea">'.$textarea.'</p>';
	   }
	   echo '</div>';
	   echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_my_plugin");'));




?>
