<!-- <script type="text/javascript" src="http://localhost:8888/drupal-7.37/sites/all/modules/custom/playwall/js/jquery.snap-puzzle.js?ns8sm2"></script> -->
<div id="runningCodeExample" style="border: 1px solid skyblue; padding: 15px; width: 300px; display: block; height: 200px;">
    <div id="loginDiv"></div>
    <script type="text/javascript">
        gigya.socialize.showLoginUI({containerID: "loginDiv", cid:'', width:220, height:60,
                //redirectURL: "/hackday",
                showTermsLink:false, hideGigyaLink:true // remove 'Terms' and 'Gigya' links
                });

        var parse = function(data){
            user = data.user;
            if(user != "")  {
            $.ajax({
              url:'/hackday/showpoints',
              type: 'post',
              data: { "email": user.email},
              success: function (response) {
                  document.getElementById("points").style.display = "block";
                  document.getElementById("points").innerHTML = response;
              },
              error: function () {
                  //$('#output').html('Bummer: there was an error!');
              }
            });
              document.getElementById('nickname').innerHTML = user.nickname;
              document.getElementById('divUserPhoto').firstChild.src = user.thumbnailURL;
              document.getElementById("loginDiv").style.display = "none";
              document.getElementById("nickname").style.display = "block";
              document.getElementById("divUserPhoto").style.display = "block";
              document.getElementById("points-lable").style.display = "block";
            };
        }
        gigya.socialize.addEventHandlers({
          onLogin: onLoginHandler
        });
        var user = gigya.socialize.getUserInfo({callback: parse});
        window.onload = function(){
        }
        function onLoginHandler(eventObj) {

            // Show the User Status plugin on login
            //gigya.gm.showUserStatusUI(userStatusParams);
            location.reload();
        }
    </script>
    <span id="nickname" style = "display:none;"></span>
    <div id="divUserPhoto" style = "display:none;"><img src=""></div><br/>
    <div id="points-lable" style = "display:none;">User Points:</div><br/>
    <div id="points" style = "display:none;"></div></br>
</div>
<div id="dialog"></div>
<div>
  <?php
  //$i = 0;
  foreach($trending->trending as $item => $article):
    ?>
    <article class="node clearfix node_item_<?php echo $item;?>" style="margin-top: 30px;">
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
      <div class="myDiv" style="display:none"></div>
      <footer>
        <ul class="links inline">
          <li class="node-readmore first dialogify" item-identifier="<?php echo $item;?>" data-image-url="<?php echo $article->puzzle_image;?>" data-content-url="<?php echo$article->url; ?>" data-brand="<?php echo $article->brand;?>">
            <?php echo $article->read_more; ?>
          </li>
        </ul>
      </footer>

    </article>
    <script type="text/javascript">
    var act = new gigya.socialize.UserAction();
    act.setTitle("Share");
    act.setLinkBack("<?php echo $article->brand;?>");
    act.setDescription("This is my Description");
    //act.addMediaItem({ type: 'image', src: '<?php echo $article->image->thumbnail;?>', href: '<?php echo $article->image->thumbnail;?>' });
    var showShareBarUI_params=
    {
        containerID: 'componentDiv<?php echo $item;?>',
        shareButtons: 'share',
        userAction: act,
        onSendDone: onSendDone,
        onError: onError
    }
    </script>
    <div id="componentDiv<?php echo $item;?>"></div>
    <script type="text/javascript">
       gigya.socialize.showShareBarUI(showShareBarUI_params);
        function printResponse(response) {
            if ( response.errorCode == 0 ) {
                var user = response['user'];
                var msg = 'User '+user['nickname'] + ' is ' +user['age'] + ' years old';
                   $.ajax({
                      url:'/hackday/addpoints',
                      type: 'post',
                      data: { "email": user['email'], "firstName": user['firstName'], "points": 1},
                      success: function (response) {
                          //$('#output').html(response.responseText);
                      },
                      error: function () {
                          //$('#output').html('Bummer: there was an error!');
                      }
                  });
            }
            else {
                alert('Error :' + response.errorMessage);
            }
        }
       function onSendDone(event) {
        gigya.socialize.getUserInfo({callback:printResponse});
        location.reload();
       }
      // onError event handler
      function onError(event) {
        alert('An error has occured' + ': ' + event.errorCode + '; ' + event.errorMessage);
      }
    </script>
  <?php
  //$i = $i+1;
  endforeach;
  ?>
</div>
