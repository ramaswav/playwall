
(function ($) {
  Drupal.playwall = Drupal.playwall || {};
  Drupal.behaviors.playwall = {
    attach: function (context) {
      $(function() {
        $("#dialog").dialog({
          autoOpen: false,
          modal: true,
          width: 1000,
          height: 700,
          buttons:{ "Close": function() { $(this).dialog("close"); $('.node_item_'+item_id+' .myDiv').fadeIn('slow')} }
          });
        $(".dialogify").on("click", function(e) {
          e.preventDefault();
          url=$(this).attr("data-image-url");
          item_id=$(this).attr("item-identifier");
          alert($(this).attr("item-identifier"));
          $("#dialog").html('<style> body { margin: 0; padding: 0; border: 0; min-width: 320px; color: #777; } html, button, input, select, textarea, .pure-g [class *= "pure-u"] { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 1.02em; } p, td { line-height: 1.5; } ul { padding: 0 0 0 20px; } th { background: #eee; white-space: nowrap; } th, td { padding: 10px; text-align: left; vertical-align: top; font-size: .9em; font-weight: normal; border-right: 1px solid #fff; } td:first-child { white-space: nowrap; color: #008000; width: 1%; font-style: italic; } h1, h2, h3 { color: #4b4b4b; font-family: "Source Sans Pro", sans-serif; font-weight: 300; margin: 0 0 1.2em; } h1 { font-size: 4.5em; color: #1f8dd6; margin: 0 0 .4em; } h2 { font-size: 2em; color: #636363; } h3 { font-size: 1.8em; color: #4b4b4b; margin: 1.8em 0 .8em } h4 { font: bold 1em sans-serif; color: #636363; margin: 4em 0 1em; } a { color: #4e99c7; text-decoration: none; } a:hover { text-decoration: underline; } p, pre { margin: 0 0 1.2em; } ::selection { color: #fff; background: #328efd; } ::-moz-selection { color: #fff; background: #328efd; } @media (max-width:480px) { h1 { font-size: 3em; } h2 { font-size: 1.8em; } h3 { font-size: 1.5em; } td:first-child { white-space: normal; } } .inline-code { padding: 1px 5px; background: #eee; border-radius: 2px; } pre { padding: 15px 10px; font-size: .9em; color: #555; background: #edf3f8; } pre i { color: #aaa; } /* comments */ pre b { font-weight: normal; color: #cf4b25; } /* strings */ pre em { color: #0c59e9; } /* numeric */ /* Pure CSS */ .pure-button { margin: 5px 0; text-decoration: none !important; } .button-lg { margin: 5px 0; padding: .65em 1.6em; font-size: 105%; } /* required snapPuzzle styles */ .snappuzzle-wrap { position: relative; display: block; } .snappuzzle-pile { position: relative; } .snappuzzle-piece { cursor: move; } .snappuzzle-slot { position: absolute; background: #fff; opacity: .8; } .snappuzzle-slot-hover { background: #eee; } </style>' +
          '<div style="max-width:900px;padding:0 10px;margin:40px auto;text-align:center"> <h2>Re-arrage the celebrity picture</h2> </div> <div id="puzzle-containment" style="border-top: 1px solid #eee;border-bottom:1px solid #eee;background:#fafafa;margin:30px 0;padding:10px;text-align:center"> <div class="pure-g" style="max-width:1280px;margin:auto"> <div class="pure-u-1 pure-u-md-1-2"><div style="margin:10px"> <!--<img id="source_image" class="pure-img" src="image.jpg"--> <img class="source_image pure-img" src="' + url + '"> </div></div> <div class="pure-u-1 pure-u-md-1-2"> <div id="pile" style="margin:10px;margin-top:110px;"> <div id="puzzle_solved" style="display:none;text-align:center;position:relative;top:25%"> <h2 style="margin:0 0 20px">Well done!</h2> <h3>You have completed the puzzle. Close the modal and your content is waiting for you.</h3> <!--a class="pure-button button-lg restart-puzzle" data-grid="3">Restart Puzzle</a> <br><br> <a href="#" class="restart-puzzle" data-grid="5">5x5</a> &nbsp; <a href="#" class="restart-puzzle" data-grid="7">7x7</a> &nbsp; <a href="#" class="restart-puzzle" data-grid="10">10x10</a--> </div> </div> </div> </div> </div>' +
          '<script type="text/javascript">function start_puzzle(x){ $("#puzzle_solved").hide(); $(".source_image").snapPuzzle({ rows: x, columns: x, pile: "#pile", containment: "#puzzle-containment", onComplete: function(){ $("#source_image").fadeOut(150).fadeIn(); $("#puzzle_solved").show(); Drupal.playwall.getContent("' + item_id + '","' + url + '");} }); } $(function(){ $("#pile").height($("#source_image").height()); start_puzzle(2); $(".restart-puzzle").click(function(){ $("#source_image").snapPuzzle("destroy"); start_puzzle($(this).data("grid")); }); $(window).resize(function(){ $("#pile").height($("#source_image").height()); $("#source_image").snapPuzzle("refresh"); }); });<\/script>');
          $("#dialog").dialog("option", "title", "Solve the puzzle").dialog("open");
        });
      });
    }
  };

  Drupal.playwall.getContent = function(item_id, url) {
    console.log(item_id);
    console.log(url);
    $.ajax({
      url: 'hackday/ajax',
        data:{ url: url },
        type: 'POST',
        success: function(data) {
          //$('#dialog').dialog('close');
          $('.node_item_'+item_id+' .myDiv').html(data);
          $('.node_item_'+item_id+' a.dialogify').hide();
       },
       error: function(xhr, textStatus, errorThrown) {
       }
    });
  };
}(jQuery));