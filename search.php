<?php
        require("./config.php");
        
        $query = trim(isset($_GET['q'])? $_GET['q']: 'tin moi') == '' ?  'tin moi': trim($_GET['q']);

        $data = array(
            'secret_key' => $SECRET_KEY,
            'query' => $query ,
            'page' => isset($_GET['p'])? $_GET['p']: 1,
            'per_page' => $PERPAGE ,
            'version' => 1
        );
         
        if(isset($_GET['period']) && is_numeric($_GET['period'])  && intval($_GET['period']) > 0 ){
            $data['period'] = intval($_GET['period']);
            $period = $data['period'];
        }
    
        $allData = json_decode(file_get_contents("$ENDPOINT?".http_build_query($data)),true);
        
        $took = $allData['took'];
        $numberOfResult = $allData['total'];
        $allResult = $allData['result'];

        $paging = intval($numberOfResult/$PERPAGE ) + ($numberOfResult%$PERPAGE  == 0 ? 0:1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./resource/custom/images/fav.ico" type="image/x-icon">
    <title>Trà Đá Chứng Khoán - <?php echo $query ;?></title>

    <!-- Bootstrap -->
    <link href="./resource/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./resource/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="./resource/custom/build/css/custom.min.css?v=1.0.2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <style>
        .header {
            background: #fff;
            border-bottom: 1px solid #d1d1d2;
        }
        .footer {
            background: #fff;
            border-top: 1px solid #d1d1d2;
            padding: 10px 0;
        }
        .footer .copyright {
            margin-top: 20px;
            border-top: 1px solid #d1d1d2;
            padding: 10px 0;
        }
        .footer .tab-content p {
            padding-top: 8px;
            margin-bottom: 0px;
            font-size: 14px;
            line-height: 22px;
            color: #3C4043;
        }
        .footer .tab-content a {
            font-weight: bold;
        }
      .search_title{
        font-size: 17px;
        line-height: 20px;
        padding-top: 1px;
        margin-bottom: -1px;
        color: #1967D2;
        cursor: pointer;
      }
      .search_link{
        color: #006621;  
        font-size: 12px;
          line-height: 20px;
      }
      .search_content{
        padding-top: 1px;
        margin-bottom: -1px;
        font-size: 14px;
        line-height: 20px;
        color: #3C4043;
      }
      .search_time{
        padding-top: 1px;
        margin-bottom: -1px;
        font-size: 14px;
        line-height: 20px;
        color: #777;
      }
      .result_count {
          padding: 10px 25px;
      }
      .right_col {
        padding: 0px!important; 
        }
        .main_container{
            padding-left:0px;
        }
      #header_text {
        font-size: 22px;
        text-align: center;
        font-family: 'Roboto Condensed', sans-serif;
        }
    </style>


  </head>

  <body class="nav-md" style="overflow-x:hidden; ">
  <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.3&appId=490560961112623&autoLogAppEvents=1"></script>

    <div class=" body"  >
      <div class="main_container">
        <div class="header">
            <div class="container">
                <div class="row" >
                    <form id="search_form" method="GET" action='./search.php'>
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                        <div class="form-group pull-right top_search" style="display: table; height: 80px; overflow-x:hidden;width:100%;">
                            <div style="display: table-cell; vertical-align: middle;width:100%;">
                                <a href="./">
                                    <div id="header_text"> <img src="./resource/custom/images/icon.png" alt="Logo" height="60" width="60" data-atf="1"> Trà Đá Chứng Khoán </div>
                                </a>
                            </div>
                        </div>

                        <div class="form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="<?php echo $query?>" style="height: 39px; background-color: #eaeaea;font-size:22px; "  autofocus="autofocus">
                                    <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button"  style="height: 39px; background-color:#3b78e7; color:white" onclick="document.getElementById('search_form').submit();">Tìm</button>
                                                                </span>
                                </div>


                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"> </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="result_count col-xs-12 col-lg-9 col-md-9 col-sm-9">
                        <h6>Khoảng <?php echo number_format($numberOfResult,0,' ','.')?> kết quả (<?php echo number_format(floatval($took/1000), 3, ',', ' ') ?> giây)</h6>
                    </div>

                    <div class="form-group col-xs-12 col-lg-3 col-md-3 col-sm-3" style="padding: 10px 25px;text-align:right;">
                        <select onchange="document.getElementById('search_form').submit();" class="custom-select custom-select-sm  col-xs-12 col-lg-12 col-md-12 col-sm-12" name="period" id="period" style="line-height: 1.5;border-radius: .4rem; padding: .375rem 1.75rem .375rem .75rem;line-height: 1.5;">
                            <option value="0"  <?=isset($_GET['period']) ||  $_GET['period']==0 ? "":"selected"?>>Mọi lúc</option>
                            <option value="24" <?=$_GET['period']==24? "selected": ""?> >24 giờ qua</option>
                            <option value="168" <?=$_GET['period']==168? "selected": ""?> >1 tuần qua</option>
                            <option value="720" <?=$_GET['period']==720? "selected": ""?> >1 tháng qua</option>
                            <option value="8760" <?=$_GET['period']==8760? "selected": ""?> >1 năm qua</option>
                        </select>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- page content -->
        <div class="right_col" role="main" style="margin-left: 0px;">
            <div class="container">

                <div class="row" style="height: 10px;">
                </div>

                 <div class="clearfix"></div>


                <?php
                    for($i = 0; $i < count($allResult); $i++){
        ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="position: relative">

 
    
                                    
                                    <a style="padding-right: 60px:float:left;" href="<?php echo  $allResult[$i]['source']?>" target="_blank" >
                                        <div class="search_title"><?php echo $allResult[$i]['title']?></div>
                                        <div class="clearfix"></div>
                                        <div class="search_link"> <?php echo $allResult[$i]['source']?></div>
                                        <div class="clearfix"></div> 
                                    </a>
                                    <a style="position: absolute;top: 0 ;right: 0 " href="https://www.facebook.com/sharer/sharer.php?u=<?php echo  $allResult[$i]['source']?>"  target="_blank"><i class="fa fa-share-alt"></i></a>

                                </div>
 
                                <div class="x_content">
                                    <script>
                                    function open_<?php echo $allResult[$i]['news_id'] ?>(){

                                        <?php
                                                    $contentShow = $allResult[$i]['content'];
                                                    $contentShow = str_replace("'","",$contentShow);
                                                    $contentShow = str_replace(PHP_EOL,'</br>',$contentShow);
                                                    $contentShow = str_replace(PHP_EOL,'</br>',$contentShow);
                                                    $contentShow = str_replace(array("\r\n", "\n", "\r"), '', $contentShow);


                                                    $query = strtolower($query);
                                                    $position = 0;

                                                    while(true){

                                                        $position = strpos(strtolower($contentShow),$query,$position);
                                                        if($position === false) break;
                                                        $contentShow = substr_replace( $contentShow, '<b>', $position, 0 );
                                                        $position = strpos(strtolower($contentShow),$query,$position) + strlen($query);
                                                        if($position === false) break;
                                                        $contentShow = substr_replace( $contentShow, '</b>', $position, 0 );

                                                    }


                                        ?>

                                        document.getElementById("<?php echo $allResult[$i]['news_id'] ?>").innerHTML = '<?php echo $contentShow;?>';
                                        document.getElementById("<?php echo $allResult[$i]['news_id'] ?>").onclick = function() {
                                                                                                                                                return false;
                                                                                                                                            }

                                    }
                                    </script>
                                    <div
                                            class="search_content"
                                            id ='<?php echo $allResult[$i]['news_id'] ?>'
                                            onclick = "open_<?php echo $allResult[$i]['news_id'] ?>()"
                                    >
                                        <span class="search_time">
                                            <?php
                                                $timeSpand = time() - $allResult[$i]['date_public'];
                                                if( $timeSpand < 3600 ){
                                                    echo intval($timeSpand/60)." phút trước";
                                                }else if($timeSpand < 86400 ){
                                                    echo intval($timeSpand/3600)." giờ trước";
                                                }else if($timeSpand < 86400 * 7 ){
                                                    echo intval($timeSpand/86400)." ngày trước";
                                                }else{
                                                    //echo time()."|". $allResult[$i]['date_public']."|";
                                                    echo date('H:i d/m/Y', $allResult[$i]['date_public']);
                                                }
                                            ?> -
                                        </span>
                                        <?php
                                            $content = $allResult[$i]['content'];
                                            $contentLower = strtolower($content);
                                            $pos = strpos($contentLower,'<b>');
                                            if($pos === false){
                                                $echoText = substr($content,0,500);
												$blankPos = strrpos($echoText,' ');
												$echoText = substr($echoText,0,$blankPos);
                                                echo "$echoText...";
                                            }else{
                                                $blankPos = 0;
                                                if($pos > 0)
                                                    $blankPos = strpos($content,' ',$pos < 50 ? 0 : $pos - 50 );

												if($pos +500 <= strlen($content))
													$blankPos2 = strpos($content,' ',$pos +500 );
												else 
													$blankPos2 = strrpos($content,' ');

                                                $echoText = substr($content,$blankPos ,$blankPos2 -$blankPos);
 
                                                $left = substr_count($echoText,'<b>') - substr_count($echoText,'</b>');

                                                for($k = 0; $k < $left; $k++){
                                                    $echoText=$echoText."</b>";
                                                }
                                                echo "...$echoText...";


                                            }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        <?php

                    }

                ?>


                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <b>PAGE:</b>
                                <?php
                                for($i = 1; $i <= $paging; $i++){
                                    $data = array(
                                        'q' => $query,
                                        'p' => $i,
                                    );

                                    if(isset($period) && $period > 0){
                                        $data['period'] = $period;
                                    } 

                                    $url = "./search.php?".http_build_query($data);

                                    if(isset($_GET['p']) && $i == intval($_GET['p']))
                                        echo "<b><span style='color: orange;'  > $i </span></b>";
                                    else
                                        echo "<a href='$url' > $i </a>";

                                }
                                ?>



                                </a>
                            </div>

                            <div class="x_content">

                            </div>
                        </div>
                    </div>
                </div>


                <!-- /page content -->

            </div>

        </div>

        <div class="footer">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="">
                              <div class="x_title">
                                  <h2> Về chúng tôi </h2>

                                  <div class="clearfix"></div>
                              </div>
                              <div class="x_content">

                                  <div class="">
                                      <!-- required for floating -->
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs">
                                          <li class="active"><a href="#gioithieu" data-toggle="tab">Giới thiệu</a>
                                          </li>
                                          <li><a href="#lienhe" data-toggle="tab">Liên hệ</a>
                                          </li>
                                          <li><a href="#dautu" data-toggle="tab">Cơ hội đầu tư</a>
                                          </li>
                                      </ul>
                                  </div>

                                  <div class="">
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="gioithieu">
                                              <p class="">&nbsp;&nbsp;&nbsp;Chúng tôi là tập hợp 1 nhóm chuyên gia về khoa học dữ liệu, trí tuệ nhân tạo, công nghệ tìm kiếm và phân tích thị trường có kinh nghiệm làm việc nhiều năm trong các công ty lớn của Việt Nam và thế giới.</p>
                                              <p class="">&nbsp;&nbsp;&nbsp;Dù đã nhiều năm sử dụng các bộ máy tìm kiếm hàng đầu nhưng chúng tôi có nhiều điểm không hài lòng và đi đến quyết định phải tạo ra một công nghệ tìm kiếm đặc biệt, chuyên dùng cho chuyên ngành kinh tế và chứng khoán với tiêu chí miễn phí và tối ưu cho tiếng Việt.</p>
                                          </div>

                                          <div class="tab-pane" id="lienhe">
                                              <p class="">&nbsp;&nbsp;&nbsp;Bạn có thể liên hệ với chúng tôi qua email <a href='mailto:hao@duchungtech.com'>hao@duchungtech.com</a></p>
                                              <p class="">&nbsp;&nbsp;&nbsp;Hoặc liên hệ với chúng tôi qua fanpage <a href='https://www.facebook.com/tradachungkhoan/'>https://www.facebook.com/tradachungkhoan/</a> hoặc sử dụng chức năng chat ở cuối trang web</p>
                                              <div class="fb-page" data-href="https://www.facebook.com/tradachungkhoan" data-width="" data-hide-cover="false" data-show-facepile="true">
                                              </div>
                                          </div>
                                          <div class="tab-pane" id="dautu">
                                              <p class="">&nbsp;&nbsp;&nbsp;Chúng tôi đã và đang phát triển các công cụ phục vụ cho cộng đồng tài chính Việt Nam. Như công cụ tìm kiếm tin tức chứng khoán <a href="https://tradachungkhoan.com">TĐCK</a>,
                                                Trang tin tức, bảng giá, và công cụ phân tích Nghiên cứu Cổ phiếu <a href="https://dautuxuhuong.com">Đầu Tư Xu Hướng</a> (Cập nhật theo thời gian thực),... </p>
                                              <p class="">&nbsp;&nbsp;&nbsp;Hiện tại, việc vận hành hệ thống đang sử dụng các máy chủ chuyên dụng được tối ưu,
                                                  công tác nghiên cứu phát triển các hệ thống và tính năng mới đang sử dụng đội ngũ kỹ sư chất lượng và rất giàu kinh nghiệm.</p>
                                              <p class="">&nbsp;&nbsp;&nbsp;Nếu bạn muốn tham gia đầu tư hay có ý tưởng muốn đóng góp vào dự án vui lòng liên hệ trực tiếp với chúng tôi. Chúng tôi luôn đón chào những thành viên và nhà đầu tư muốn hợp tác một cách lâu dài với tradachungkhoan.</p>
                                          </div>
                                      </div>

                                      <div class="clearfix"></div>

                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright">
                              <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                                  <span>© Một sản phẩm của <a href="http://duchungtech.com" target="_blank" ><b>duchungtech.com</b></a></span>
                              </div>
                              <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                                  <a href="https://www.facebook.com/tradachungkhoan" target="_blank" >Fanpage</a>
                              </div>
                          </div>
                      </div>




                  </div>
              </div>
          </div>


    <!-- jQuery -->
    <script src="./resource/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./resource/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="./resource/custom/build/js/custom.min.js"></script>


  </body>
</html>
