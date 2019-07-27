<html>
<head>
  <title>Trà Đá Chứng Khoán - Search Engine cho tin tức chứng khoán</title> 
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
  <link href="/resource/css/main.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="/resource/images/fav.ico" />

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140455259-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());  

  gtag('config', 'UA-140455259-1');
</script>

<style>
.pill_search{
    font-size: 14px;
    font-family: 'Helvetica', sans-serif;
    display: inline-block;
    background: #f2f2f2;
    padding: 0 15px;
    line-height: 32px;
    color: #fff;
    border-radius: 16px;
    margin-right: 10px;
    margin-bottom: 10px;
    color: #5F6368;
}
</style>

</head>
<body>
  <div class="s006">
      <div class="container">
        <form method="GET" action='./search.php'>
          <fieldset>
          <div class="icon"><img src="/resource/images/icon.png" alt="tradachungkhoan" height="100" width="100" data-atf="1"></div>
            <div class="banner" style="color:#0d7762;text-shadow:0px !importance;font-size: 40px;text-align: center; font-family: 'Roboto Condensed', sans-serif;padding-bottom: 30px;">Trà Đá Chứng Khoán</div>
            <div class="inner-form">
              <div class="input-field">
                <button class="btn-search" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                  </svg>
                </button>
                <input id="search" name="q" style="border: 1px solid #dfe1e5;" type="text" placeholder="VCB, FLC, FPT, phái sinh, Vietcombank..." value=""  autofocus="autofocus" />
              </div>
            </div>
            <div class="suggestion-wrap">
              <?php
              
                    require('config.php');
                    $data = array(
                            'secret_key' => $SECRET_KEY
                    );
                    $recents = json_decode(file_get_contents("$ENDPOINT_LASTEDSEARCH?".http_build_query($data)),true, 512, JSON_UNESCAPED_UNICODE);

                  for($i = 0; $i < count($recents);$i++){
                      echo "<a class=\"pill_search\" style='text-decoration: none;' href='./search.php?q=".$recents[$i]."'>".$recents[$i]."</a>";
                  }
              ?>
            </div>
          </fieldset>
        </form>
      </div>

      <div class="footer" style="background: #f2f2f2; color: #5f6368;margin-bottom: 0px;">
          <a style="color: #5f6368; font-size: 13px; line-height:30px;cursor:pointer;" href="mailto:admin@apichungkhoan.com" target="_blank">Contact</a>
          <a style="color: #5f6368; font-size: 13px; line-height:30px;cursor:pointer;" href="https://developer.apichungkhoan.com" target="_blank">API</a>
          <a style="color: #5f6368; font-size: 13px; line-height:30px;cursor:pointer;" href="https://github.com/JulianoLoren/tradachungkhoan.com" target="_blank">Github</a>
          <a style="color: #5f6368; font-size: 13px; line-height:30px;cursor:pointer;" href="https://www.facebook.com/tradachungkhoan" target="_blank">Fanpage</a>
          <a style="color: #5f6368; font-size: 13px; line-height:30px;cursor:pointer;" href="http://duchungtech.com" target="_blank">duchungtech.com</a>
     
      </div>
  </div>
  
<style>

</style>


</body>

</html>
