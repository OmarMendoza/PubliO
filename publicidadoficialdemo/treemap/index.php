<!DOCTYPE html>
<meta charset="utf-8">
<title>Zoomable Treemap </title>
<style>
	#chart {
        width: 800px;
        height: 420px;
        margin: 1px auto;
        position: relative;
        -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
                box-sizing: border-box;
				background:#000;
				
    }

    text {
        pointer-events: none;
    }

    .grandparent text { /* header text */
        font-weight: bold;
        font-size: medium;
        font-family: "Open Sans", Helvetica, Arial, sans-serif; 
    }

    rect {
        fill: none;
        stroke: #fff;
    }

    rect.parent,
    .grandparent rect {
        stroke-width: 2px;
    }

    .grandparent rect {
        fill: #fff;
    }

    .children rect.parent,
    .grandparent rect {
        cursor: pointer;
    }

    rect.parent {
        pointer-events: all; 
    }

    .children:hover rect.child,
    .grandparent:hover rect {
        fill: #aaa;
    }

    .textdiv { /* text in the boxes */
        font-size: x-small;
        padding: 5px;
        font-family: "Open Sans", Helvetica, Arial, sans-serif; 
    }

</style>

<link rel="stylesheet" type="text/css" media="screen" href="stylesheet.css">
<script type="text/javascript" src="d3.v3.min.js"></script>
  <!-- HEADER -->
        <div id="header_wrap" class="outer">
            <header class="inner">
              <a id="forkme_banner" href="https://github.com/Sushanthece/D3-Zoomable-treemap">View on GitHub</a>
              <h1 id="project_title">Zoomable Treemap</h1> 
              <a id="home" href="http://sushanthece.github.io/">Home</a>
           </header>
        </div>
    
  <!-- MAIN CONTENT -->
      <div>
        <section id="main_content" class="inner" >   
	      <div>
            <p id="chart">
            <script type="text/javascript" src="zoomable_treemap.js"></script>
            </p>
		  </div>
		</section>
      </div>
<script>
  // SITE VISIT TRACKER
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44221304-1', 'sushanthece.github.io');
  ga('send', 'pageview'); 
</script>
      
    </body>
</html>
