<!-- <script type="text/javascript" src="http://localhost:8888/drupal-7.37/sites/all/modules/custom/playwall/js/jquery.snap-puzzle.js?ns8sm2"></script> -->
<div id="dialog"></div>
<div>
  <?php
  foreach($trending->trending as $article):
    ?>
    <article class="node clearfix" style="margin-top: 30px;">
      <header>
        <div class="node-teaser-title node-teaser">
          <h2 class="title"><?php echo $article->headline;?></h2>
          <div class="node-teaser-author">Brand : <span rel="sioc:has_creator"><?php echo $article->brand;?></span></div>
        </div>
      </header>

      <div class="content">
        <div class="field field-name-field-migrate-example-image field-type-image field-label-hidden">
          <div class="field-items">
            <div class="field-item even">
              <?php echo $article->image->thumbnail;?>
            </div>
          </div>
        </div>
        <div class="field field-name-body field-type-text-with-summary field-label-hidden" style="margin-bottom: 30px;">
          <div class="field-items">
            <div class="field-item even" property="content:encoded">
              <?php echo $article->excerpt;?>
            </div>
          </div>
        </div>
        <?php
        if (!empty($article->tags)):
          ?>
          <div class="field field-tag field-name-field-tags field-type-taxonomy-term-reference field-label-above">
            <div class="field-label">Tags: </div>
            <div class="field-items">
              <?php
              foreach($article->tags as $key => $tag):
                $class = ($key%2 == 0 )? 'even' : 'odd';
                ?>

                <div class="field-item <?php echo $class;?>"  style="color: #008000;">
                  <?php echo $tag->tag;?>
                </div>

              <?php
              endforeach;
              ?>
            </div>
          </div>
        <?php
        endif;
        ?>
      </div>
      <div id="myDiv"></div>
      <footer>
        <ul class="links inline">
           <!-- <li class="node-readmore first"><a href="http://localhost/d7/sites/default/files/puzzle.html" class="dialogify" rel="tag" title="<?php //echo $article->headline;?>">Read more<span class="element-invisible"> about <?php echo $article->headline;?></span></a></li> -->
          <li class="node-readmore first dialogify" data-image-url="http://www.dunckelvet.com/clients/2144/images/Cat_pictures2.jpg">
            <!-- <a href='javascript:void(0);' data-image-url='http://www.dunckelvet.com/clients/2144/images/Cat_pictures2.jpg' class="dialogify">Read More</a> -->
            <?php echo $article->read_more; ?>
          </li>
        </ul>
      </footer>

    </article>
  <?php
  endforeach;
  ?>
</div>
<script type="text/javascript">
  /*
   * jQuery UI Dialog: Load Content via AJAX
   * http://salman-w.blogspot.com/2013/05/jquery-ui-dialog-examples.html
   */
  $(function() {
    $("#dialog").dialog({
      autoOpen: false,
      modal: true,
      width: 1000,
      height: 700,
      buttons:{ "Close": function() { $(this).dialog("close"); } }
      });
    $(".dialogify").on("click", function(e) {
      e.preventDefault();
      url=$(this).attr("data-image-url");
      $("#dialog").html('<style> body { margin: 0; padding: 0; border: 0; min-width: 320px; color: #777; } html, button, input, select, textarea, .pure-g [class *= "pure-u"] { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 1.02em; } p, td { line-height: 1.5; } ul { padding: 0 0 0 20px; } th { background: #eee; white-space: nowrap; } th, td { padding: 10px; text-align: left; vertical-align: top; font-size: .9em; font-weight: normal; border-right: 1px solid #fff; } td:first-child { white-space: nowrap; color: #008000; width: 1%; font-style: italic; } h1, h2, h3 { color: #4b4b4b; font-family: "Source Sans Pro", sans-serif; font-weight: 300; margin: 0 0 1.2em; } h1 { font-size: 4.5em; color: #1f8dd6; margin: 0 0 .4em; } h2 { font-size: 2em; color: #636363; } h3 { font-size: 1.8em; color: #4b4b4b; margin: 1.8em 0 .8em } h4 { font: bold 1em sans-serif; color: #636363; margin: 4em 0 1em; } a { color: #4e99c7; text-decoration: none; } a:hover { text-decoration: underline; } p, pre { margin: 0 0 1.2em; } ::selection { color: #fff; background: #328efd; } ::-moz-selection { color: #fff; background: #328efd; } @media (max-width:480px) { h1 { font-size: 3em; } h2 { font-size: 1.8em; } h3 { font-size: 1.5em; } td:first-child { white-space: normal; } } .inline-code { padding: 1px 5px; background: #eee; border-radius: 2px; } pre { padding: 15px 10px; font-size: .9em; color: #555; background: #edf3f8; } pre i { color: #aaa; } /* comments */ pre b { font-weight: normal; color: #cf4b25; } /* strings */ pre em { color: #0c59e9; } /* numeric */ /* Pure CSS */ .pure-button { margin: 5px 0; text-decoration: none !important; } .button-lg { margin: 5px 0; padding: .65em 1.6em; font-size: 105%; } /* required snapPuzzle styles */ .snappuzzle-wrap { position: relative; display: block; } .snappuzzle-pile { position: relative; } .snappuzzle-piece { cursor: move; } .snappuzzle-slot { position: absolute; background: #fff; opacity: .8; } .snappuzzle-slot-hover { background: #eee; } </style>' +
      '<div style="max-width:900px;padding:0 10px;margin:40px auto;text-align:center"> <h2>Re-arrage the celebrity picture</h2> </div> <div id="puzzle-containment" style="border-top: 1px solid #eee;border-bottom:1px solid #eee;background:#fafafa;margin:30px 0;padding:10px;text-align:center"> <div class="pure-g" style="max-width:1280px;margin:auto"> <div class="pure-u-1 pure-u-md-1-2"><div style="margin:10px"> <!--<img id="source_image" class="pure-img" src="image.jpg"--> <img class="source_image pure-img" src="' + url + '"> </div></div> <div class="pure-u-1 pure-u-md-1-2"> <div id="pile" style="margin:10px;margin-top:110px;"> <div id="puzzle_solved" style="display:none;text-align:center;position:relative;top:25%"> <h2 style="margin:0 0 20px">Well done!</h2> <h3>You have accumulated 200 points</h3> <!--a class="pure-button button-lg restart-puzzle" data-grid="3">Restart Puzzle</a> <br><br> <a href="#" class="restart-puzzle" data-grid="5">5x5</a> &nbsp; <a href="#" class="restart-puzzle" data-grid="7">7x7</a> &nbsp; <a href="#" class="restart-puzzle" data-grid="10">10x10</a--> </div> </div> </div> </div> </div>' +
      '<script type="text/javascript">function start_puzzle(x){ $("#puzzle_solved").hide(); $(".source_image").snapPuzzle({ rows: x, columns: x, pile: "#pile", containment: "#puzzle-containment", onComplete: function(){ $("#source_image").fadeOut(150).fadeIn(); $("#puzzle_solved").show(); } }); } $(function(){ $("#pile").height($("#source_image").height()); start_puzzle(2); $(".restart-puzzle").click(function(){ $("#source_image").snapPuzzle("destroy"); start_puzzle($(this).data("grid")); }); $(window).resize(function(){ $("#pile").height($("#source_image").height()); $("#source_image").snapPuzzle("refresh"); }); });<\/script>');
      $("#dialog").dialog("option", "title", "Solve the puzzle").dialog("open");
    });
  });
</script>
