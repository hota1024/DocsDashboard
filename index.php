<?php

session_start();
if(!isset($_SESSION['DocsDashboard.theme'])) $_SESSION['DocsDashboard.theme'] = 'indigo';
$theme = $_SESSION['DocsDashboard.theme'];

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="DocsDashboard/assets/css/material.min.css">
    <script src="DocsDashboard/assets/js/material.min.js"></script>
    <link rel="stylesheet" href="DocsDashboard/assets/fonts/materialicons/material-icons.css">
    <link rel="stylesheet" href="DocsDashboard/assets/css/style.css">
    <link rel="stylesheet" href="DocsDashboard/assets/css/themes/<?=$theme?>.css">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="DocsDashboard/assets/js/jquery.js"></script>
  </head>
  <body <?=isset($_SESSION['DocsDashboard.load']) ? 'class="hide"' : ''?>>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header" id="main_nav">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">DocsDashboard</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" id="go_list" href="#" onclick="return false;">ファイル/フォルダ一覧</a>
          <a class="mdl-navigation__link" id="go_settings" href="#" onclick="return false;">設定</a>
        </nav>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="page-content">
        <div id="list" class="hide">
          <h1>ファイル/フォルダ 一覧</h1>
          <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">アイコン</th>
                <th>種類</th>
                <th>名前</th>
                <th>サイズ</th>
                <th>更新日</th>
                <th>リンク</th>
                <th>絶対パス</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $files = @scandir(dirname(__FILE__));
                foreach ($files as $key => $value):
                $icon;
                $type;
                $href;
                $url;
                if(is_dir($value)){
                  $icon = '<i class="material-icons">folder</i>';
                }else{
                  $icon = '<i class="material-icons">insert_drive_file</i>';
                }
                if(is_dir($value)){
                  $type = 'フォルダー';
                }else{
                  $type = substr($value, strrpos($value, '.') + 1).'ファイル';
                }
                if($key < 2){
                  $href = $value.'/';
                }else{
                  $href = $value;
                }
                $size = @filesize($value) / 100;
                $time = @date ("Y/m/t H:i:s", @filemtime($value));
                $pass = @realpath($value);
              ?>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric"><?=$icon?></td>
                    <td><?=$type?></td>
                    <td><?=$value?></td>
                    <td><?=$size?> Kb</td>
                    <td><?=$time?></td>
                    <td>
                      <a id="link_<?=$key?>" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="<?=$href?>"><?=$value?></a>
                    </td>
                    <div class="mdl-tooltip" data-mdl-for="link_<?=$key?>">
                    「<?=$value?>」を開く
                    </div>
                    <div class="mdl-tooltip" data-mdl-for="i_<?=$key?>">
                    DocsDashboardで「<?=$value?>」を開く
                    </div>
                    <td><?=$pass?></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div id="settings" class="hide">
          <h1>設定</h1>

          <h2>テーマ</h2>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
              <div class="theme_item theme_item_indigo">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_indigo">
                        このテーマに設定
                      </button>
                    </div>
                  </main>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col theme_item">
              <div class="theme_item theme_item_red">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_red">
                        このテーマに設定
                      </button>
                    </div>
                  </main>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col theme_item">
              <div class="theme_item theme_item_green">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_green">
                        このテーマに設定
                      </button>
                    </div>
                  </main>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col theme_item">
              <div class="theme_item theme_item_purple">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_purple">
                        このテーマに設定
                      </button>

                    </div>
                  </main>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col theme_item">
              <div class="theme_item theme_item_orange">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_orange">
                        このテーマに設定
                      </button>
                    </div>
                  </main>
                </div>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col theme_item">
              <div class="theme_item theme_item_bluegray">
                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                  <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                      <span class="mdl-layout-title">Title</span>
                      <div class="mdl-layout-spacer"></div>
                      <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                        <a class="mdl-navigation__link" href="#" onclick="return false;">Link</a>
                      </nav>
                    </div>
                  </header>
                  <main class="mdl-layout__content">
                    <div class="page-content">
                      <h1>content</h1>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect theme_select_button theme_bluegray">
                        このテーマに設定
                      </button>
                    </div>
                  </main>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
    </div>

    <script type="text/javascript">
      var fade = 400;

      function changeTheme(theme){
        $.post('DocsDashboard/assets/php/theme.php',{
          theme: theme
        },function(res){
          $('body').fadeOut(300,function(){
            location.reload();
          });
        });
      }

      $(function(){
        <?=isset($_SESSION['DocsDashboard.load']) ? '$("body").fadeIn(300);' : ''?>
        if(location.hash == '#settings'){
          $('#list').hide();
          $('#settings').show();
        }else{
          $('#list').show();
          $('#settings').hide();
        }

        $('.theme_item_indigo .theme_select_button').on('click',function(){
          changeTheme('indigo');
        });

        $('.theme_item_red .theme_select_button').on('click',function(){
          changeTheme('red');
        });

        $('.theme_item_green .theme_select_button').on('click',function(){
          changeTheme('green');
        });

        $('.theme_item_purple .theme_select_button').on('click',function(){
          changeTheme('purple');
        });

        $('.theme_item_orange .theme_select_button').on('click',function(){
          changeTheme('orange');
        });

        $('.theme_item_bluegray .theme_select_button').on('click',function(){
          changeTheme('bluegray');
        });


        $('#go_list').on('click',function(){
          $('#settings').fadeOut(fade,function(){
            $('#list').fadeIn(fade);
            location.hash = 'list';
          });
        });
        $('#go_settings').on('click',function(){
          $('#list').fadeOut(fade,function(){
            $('#settings').fadeIn(fade);
            location.hash = 'settings';
          });
        });
      });
    </script>
  </body>
</html>
<?php $_SESSION['DocsDashboard.load'] = null; ?>
