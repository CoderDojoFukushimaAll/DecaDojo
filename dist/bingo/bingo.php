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
    "Apitor（アプティオ）",
    "micro:bit",
    "その他1",
    "その他2"
  );
  $number = array(
    [22],
    [5,32,63,78,89,121,144,170,193],
    [9,21],
    [54],
  );
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="holder.min.js"></script>
  <script>
    $(function() {
      $('body').fadeIn(3000); //1秒かけてフェードイン！
    });
    $(function () {
      var shuffleElm = $('.shuffle'),
        shuffleSpeed = 40,
        shuffleAnimation = 3000,
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
        <div class="topitems">
          <div class="items-num">
            <div class="items-thumbnail">
              <img src="item/topimage<?php echo $i+1; ?>.jpg">
            </div>
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
    <p class="nextbutton">
      <a href="bingo2.php">次の抽選へ</a>
    </p>
  </div>
</div>
</body>
</html>
