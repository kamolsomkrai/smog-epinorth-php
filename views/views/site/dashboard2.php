<?php

/** @var yii\web\View $this */

// use yii\helpers\Html;

// Use the "Kanit" font for specific elements
// $this->registerCss("
//     /* Apply Kanit font to specific elements */
//     #viz1702980627520, #go-to-top-button a {
//         font-family: 'Kanit', sans-serif;
//     }
//     .tableauViz {
//         font-family: 'Kanit', sans-serif;
//     }
//     /* Add additional CSS styles for your page content as needed */
// ");

$this->title = 'Dashboard2';
$this->registerCss("
    #viz1732202250268, .tableauPlaceholder {
        position: relative;
        z-index: 9999; /* เพิ่ม z-index ให้กับตัว Tableau เพื่อให้มันแสดงอยู่เหนือ layout global */
    }
");
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='tableauPlaceholder' id='viz1732202250268' style='position: relative'><noscript><a href='#'><img alt='แผนที่ความสัมพันธ์ ป่วยกับฝุ่น PM2.5 ' src='https://public.tableau.com/static/images/di/diseasePM/Dashboard1/1_rss.png' style='border: none' /></a></noscript><object class='tableauViz' style='display:none;'>
    <param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' />
    <param name='embed_code_version' value='3' />
    <param name='site_root' value='' />
    <param name='name' value='diseasePM/Dashboard1' />
    <param name='tabs' value='no' />
    <param name='toolbar' value='yes' />
    <param name='static_image' value='https://public.tableau.com/static/images/di/diseasePM/Dashboard1/1.png' />
    <param name='animate_transition' value='yes' />
    <param name='display_static_image' value='yes' />
    <param name='display_spinner' value='yes' />
    <param name='display_overlay' value='yes' />
    <param name='display_count' value='yes' />
    <param name='language' value='en-US' />
    <param name='filter' value='publish=yes' />
  </object></div>
<script type='text/javascript'>
  var divElement = document.getElementById('viz1732202250268');
  var vizElement = divElement.getElementsByTagName('object')[0];
  if (divElement.offsetWidth > 800) {
    vizElement.style.width = '100%';
    vizElement.style.height = (divElement.offsetWidth * 0.75) + 'px';
  } else if (divElement.offsetWidth > 500) {
    vizElement.style.width = '100%';
    vizElement.style.height = (divElement.offsetWidth * 0.75) + 'px';
  } else {
    vizElement.style.width = '100%';
    vizElement.style.height = (divElement.offsetWidth * 1.77) + 'px';
  }
  var scriptElement = document.createElement('script');
  scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';
  vizElement.parentNode.insertBefore(scriptElement, vizElement);
</script>

<!-- Go to Top button -->
<!-- <div id="go-to-top-button" style="position: fixed; bottom: 20px; right: 20px; display: none;">
    <a href="#" class="btn btn-primary">Go to Top</a> -->
</div>

<?php
// $this->registerJs(<<<JS
//     $(document).ready(function() {
//         $(window).scroll(function() {
//             if ($(this).scrollTop() > 100) {
//                 $('#go-to-top-button').fadeIn();
//             } else {
//                 $('#go-to-top-button').fadeOut();
//             }
//         });
        
//         $('#go-to-top-button a').click(function() {
//             $('html, body').animate({
//                 scrollTop: 0
//             }, 100);
//             return false;
//         });
//     });
// JS
// );
?>
