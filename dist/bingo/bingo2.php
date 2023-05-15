<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="theme.css">
  <title>抽選会</title>
  <?php
  //1から10までの数値から抽選を行うため、1~10の値の配列を生成する
  $array = range(1, 55);
  //配列をシャッフルする
  shuffle($array);

  // 景品名
  $presentitems = array(
    "micro:bit v1",
    "Raspberry PI公式Tシャツ",
    "新鮮野菜",
    "米",
    "Scratchドリル Tシャツ",
    "はじめようAIプログラミング 冊子",
    "書籍",
  );
  $number = array(
    [6,12,19,24,27,32,35,37,40,41,42,48,49,53,57,58,62,64,70],
    [13],
    [2,44,56,67,68],
    [39],
    [31],
    [10],
    [20,50]
  );
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script>
    $(function() {
      $('body').fadeIn(3000); //1秒かけてフェードイン！
    });
    $(function () {
      var shuffleElm = $('.shuffle'),
        shuffleSpeed = 40,
        shuffleAnimation = 5000,
        shuffleDelay = 2000;

      shuffleElm.each(function () {
        var self = $(this);

        self.wrapInner('<span class="shuffleWrap"></span>');

        var shuffleWrap = self.find('.shuffleWrap');
        shuffleWrap.replaceWith(shuffleWrap.text().replace(/(\S)/g, '<span class="shuffleNum">$&</span>'));

        var shuffleNum = self.find('.shuffleNum'),
          numLength = shuffleNum.length;

        shuffleNum.each(function (i) {
          var selfNum = $(this),
            thisNum = selfNum.text(),
            shuffleTimer;

          function timer() {
            shuffleTimer = setInterval(function () {
              rdm = Math.floor(Math.random() * (9)) + 1;
              selfNum.text(rdm);
            }, shuffleSpeed);
          }

          timer();

          var i = -i + numLength;

          setTimeout(function () {
            clearInterval(shuffleTimer);
            selfNum.text(thisNum);
          }, shuffleAnimation + (i * shuffleDelay));
        });
        self.css({visibility: 'visible'});
      });
    });
  </script>
</head>
<body style="display: none">
<div id="monitor">
  <div id="monitor-inner">
    <div class="block">
      <?php $arraystart = 0; ?>
      <?php for ($i = 0; $i < count($presentitems); $i++): ?>
        <div class="items">
          <div class="items-thumbnail">
            <img src="item/image<?php echo $i+1; ?>.jpg">
          </div>
          <div class="items-detail">
            <h3 class="items-name"><?php echo $presentitems[$i]; ?></h3>
            <div class="items-num">
              <?php
              for ($n = 0; $n < count($number[$i]); $n++) {
                if( $n != 0 ) {
                  echo ", ";
                }
                echo '<span class="shuffle">' . sprintf('%02d', $number[$i][$n]) . '</span>';
              }
              ?>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</div>
</body>
</html>
