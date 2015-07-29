<!-- <script type="text/javascript" src="http://localhost:8888/drupal-7.37/sites/all/modules/custom/playwall/js/jquery.snap-puzzle.js?ns8sm2"></script> -->
<div id="dialog"></div>
<div>
  <?php
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
          <li class="node-readmore first dialogify" item-identifier="<?php echo $item;?>" data-image-url="<?php echo $article->puzzle_image;?>">
            <?php echo $article->read_more; ?>
          </li>
        </ul>
      </footer>

    </article>
  <?php
  endforeach;
  ?>
</div>
