<?php
    require("./config.php");
?>
<html>
<head>
  <title>Trà Đá Chứng Khoán - Search Engine cho tin tức chứng khoán</title> 
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
  <link href="./resource/custom/css/main.css?v=1.0.3" rel="stylesheet" />
  <link rel="icon" href="./images/fav.ico" type="image/x-icon">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

</head>
<body>
  <div class="s006">
      <div class="container">
        <form method="GET" action='./search'>
          <fieldset>
              <div class="icon"><img src="./resource/custom/images/icon.png" alt="logo" height="100" width="100" data-atf="1"></div>
              <div class="legend">Trà Đá Chứng Khoán</div>
            <div class="inner-form">
              <div class="input-field">
                <button class="btn-search" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                  </svg>
                </button>
                <input id="search" name="q" type="text" placeholder="VCB, FLC, FPT, phái sinh, Vietcombank..." value=""  autofocus="autofocus" />
              </div>
            </div>
            <div class="suggestion-wrap">
              <span><b>TỪ KHÓA GẦN ĐÂY </b></span>
              <?php
                        $data = array(
                            'secret_key' => $SECRET_KEY,
                        );
                        
                        $allData = json_decode(file_get_contents("$ENDPOINT_LASTEDSEARCH?".http_build_query($data)),true, 512, JSON_UNESCAPED_UNICODE);
                        for($i = 0; $i < count($allData);$i++)
                          echo "<span><a style='text-decoration: none;color:white;' href='./search.php?q={$allData[$i]}'>{$allData[$i]}</a></span>";
                      
              ?>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="footer" >
          <span>© Một sản phẩm của <a href="http://duchungtech.com" target="_blank" ><b>duchungtech.com</b></a></span>
          <a href="https://www.facebook.com/tradachungkhoan" target="_blank" >Fanpage</a>
      </div>
  </div>
  
<style>

</style>


</body>

</html>
