<?php /* Template Name: stock-widgetPage */ ?>

<?php
/******************************************/
## Writty theme page.php
## Content page.
/******************************************/

$sidebar_layout = esc_attr(get_theme_mod('wrt_sidebar_position', '2cr'));


get_header();
?>


  <html><title>Get Real-Time Quote</title><body><form>
  <input type="text" name="symbol" />
  <input type="submit" value="Go" />
  </form></body></html>
  <?php
  $client = new SoapClient('http://dev.moneymorning.com/matt/wp-content/themes/mattNewTheme-writee/barchart-ondemand-client-js.min.js');
  $quote = $client->GetRealQuote(array('Exchange' => "INET", 'Symbol' => $_GET["Symbol"], 'IncludeBidAsk' => "false"));
  echo "Last price: ", $quote->GetRealQuoteResult->Last;
  ?>


<?php
get_footer();
?>
