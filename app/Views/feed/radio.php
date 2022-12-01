<?php
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Radio Magelang FM</title>
  <!--Add jQuery library-->


 
  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans');

    body{
      background-color:#133960;
      padding:0;
      margin:0;
      max-height:400px;
      height:300px;
    }

    #radiobox{
      background-color:#133960;
      padding-left:20%;
      padding-right:20%;
      text-align:center;
      padding-top:45.32px;
      padding-bottom:45.32px;
    }

    .radio-title{
      color:white;
      padding-top:33px;
      padding-bottom:0px;

      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 700;
      font-size: 13px;
      line-height: 18px;
    }

    .radio-des{
      color:white;
      padding-top:3px;
      padding-bottom:33.5px;

      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 400;
      font-size: 13px;
      line-height: 18px;
    }
  
   
  

   
  </style>
</head>
<body>
  <div id="radiobox">
      <div>
        <img src="<?= base_url() ?>/assets/img/radio.png" width="60%">
      </div>

      <div class="radio-title">
        <span>103.5 MAGELANG FM</span>
      </div>

      <div class="radio-des">
        <span>LPPL Pemerintah Kota Magelang</span>
      </div>

      <!--OnlineRadioBox Player widget-->
      <div class="orbP cmpct" id="orb_player_197bfcb6f33738e3" vlm="0.8" style="border-radius:20px !important;">
      <style media="screen">
          /* General */
        .orbP{position:relative;box-sizing:border-box;overflow:hidden;font-weight:normal;border:1px solid transparent;user-select:none;text-align:left}.orbP br,.orbP>br{display:none!important;}.orbP p,.orbP>p{margin:0!important;padding:0!important;line-height:normal!important;font-size:inherit!important}.orbPh{display:block;position:absolute;z-index:100;top:50%;margin-top:-12px!important;right:10px;width:21px!important;text-decoration:none!important;cursor:pointer}.orbPh>img{margin:0!important;border:none;height:24px!important;-webkit-filter:drop-shadow(2px 2px 0 rgba(47,99,160,.2));filter:drop-shadow(2px 2px 0 rgba(47,99,160,.2))}.orbPt{text-decoration:none!important}.orbPti{float:left;margin:0 10px 0 0!important;vertical-align:top!important;height:48px!important;width:89px!important;border:none!important;border-radius:2px!important;opacity:1!important}.orbPtn{display:block;margin-right:52px;line-height:24px!important;font-size:17px!important;font-weight:bold!important;text-overflow:ellipsis;overflow:hidden;white-space:nowrap}.orbPtt{display:block;margin-right:52px;text-decoration:none!important;line-height:24px!important;font-size:12px!important;opacity:.85;transition:opacity .2s;text-overflow:ellipsis;overflow:hidden;white-space:nowrap}.orbPtt:hover{opacity:1}.orbPp,.orbPs{float:left!important;margin:0 10px 0 0!important;padding:0!important;height:48px!important;width:48px!important;line-height:48px!important;border-radius:2px!important;border:none!important;text-align:center!important;cursor:pointer;-webkit-appearance:none;-moz-appearance:none;appearance:none!important;}.orbPp::before,.orbPs::before{display:inline-block;vertical-align:middle;content:'';width:0;height:0;border-style:solid}.orbPp::before{border-width:16px 0 16px 26px}.orbPs::before{border-width:16px}.orbPp:hover,.orbPs:hover{-webkit-transform:scale(1.087);transform:scale(1.087)}.orbPhc{position:relative!important;box-sizing:border-box!important;padding:10px!important;overflow:hidden}
          /* Playlist */
        .orbPpl{position:relative;overflow:auto;overflow-x:hidden;overflow-y:auto;margin:0!important;padding:0!important;list-style:none!important}.orbPpli{box-sizing:border-box;margin:0!important;padding:0 10px!important;list-style:none!important;background-image:none;float:none!important;height: auto!important}.orbPpli>a,.orbPpli>span{display:block!important;padding:0!important;margin:0!important;height:auto!important;font-weight:normal!important;text-decoration:none!important;line-height:32px!important;font-size:14px!important;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;transition:color .125s;border:none !important}.orbPpli>a:hover,.orbPpli>span:hover{background:transparent!important}.orbPpli>a>time,.orbPpli>span>time{display:inline-block;font-size:12px!important;width:3em!important}.orbPpli+li{border-style:solid!important;border-width:1px 0 0!important}
          /* Volume */
          .orbV{position:absolute;z-index:1!important;width:24px!important;right:48px!important;top:0!important;bottom:0!important;line-height:1!important;overflow:hidden!important;transition:width .3s}.orbV:hover{width:160px!important}.orbVC{position:absolute!important;height:18px!important;left:24px!important;top:50%!important;margin:-9px 0 0 11px!important}.orbVC::after{display:block;content:'';margin-top:4px;width:0;height:0;border-style:solid;border-width:4px 100px 4px 0;opacity:.33}.orbVCs{position:absolute!important;z-index:2!important;top:0!important;width:18px!important;height:18px!important;border-radius:50%!important;cursor:ew-resize!important;box-shadow:0 6px 8px -2px rgba(0,9,18,0.36)}.orbVb{position:absolute!important;width:24px!important;height:24px!important;top:50%!important;left:0!important;margin-top:-12px;white-space:nowrap!important;cursor:pointer;transition:opacity .3s}.orbVb::before{display:inline-block;content:'';vertical-align:middle;width:7px;height:12px}.orbVb::after{display:inline-block;content:'';vertical-align:middle;border-width:12px 12px 12px 0;border-style:solid;height:0;width:0;margin-left:-6px}.orbV:hover .orbVb{opacity:.33!important;cursor:default}.orbVb>._m{display: block!important;width:7px!important;height:18px!important;position:absolute!important;top:50%;margin-top:-9px!important;right:0; overflow: hidden!important;}.orbVb>._m::before{display:block;content:'';position:absolute;right:0;top:50%;width:28px;height:24px;margin-top:-12px;border:1px solid;border-radius:50%}.orbVb>._m::after{display:block;content:'';position:absolute;right:4px;top:50%;width:14px;height:14px;margin-top:-7px;border:1px solid;border-radius:50%}
          /* Flags*/
        .orbF{padding:0 0 10px 10px!important;border-top:1px solid;display:-ms-flexbox;display:-webkit-box;display:flex;-ms-flex-flow:row nowrap!important;flex-flow:row nowrap!important}
        .orbFl{margin:0!important;padding:0!important;list-style:none!important}
        .orbFli,.orbFh{display:inline-block!important;vertical-align:top!important;line-height:18px!important;white-space:nowrap!important;margin:10px 7px 0 0!important;padding:0 6px 0 0!important;text-indent:0!important;list-style:none!important;font-size:11px!important;text-align:right}
        .orbFlif{float:left!important;width:27px!important;height:18px!important;margin-right:5px!important}
        .orbFhi{position:relative!important;display:inline-block!important;vertical-align:baseline!important;width:8px!important;height:9px!important;margin:0 8px 0 5px!important;border-style:solid!important;border-width:2px 1px 0 1px!important;border-radius:5px 5px 0 0!important;opacity:.5}
        .orbFhi::before,.orbFhi::after{display:block;content:'';position:absolute;bottom:-2px;width:0;height:3px;border-style:solid;border-width:2px;border-radius:3px}
        .orbFhi::before{left:-4px}.orbFhi::after{right:-4px}
          /* Multiselect */
        .orbPm{margin:0!important;padding:0!important;list-style:none!important}
        .orbPmi{position:relative;margin:0!important;padding:10px!important;list-style:none!important;border:dotted rgba(204,204,204,0.5);border-width:1px 0 0;font-size:12px!important;overflow:hidden;white-space:nowrap;line-height:1!important;cursor:pointer}
        .orbPmi::before{display:block;content:'';position:absolute;z-index:1;top:50%;right:10px;margin-top:-8px;width:0;height:0;border-style:solid;border-width:8px 0 8px 13px;opacity:.5;filter:alpha(opacity=50);transition:opacity .2s;}
        .orbPmi:hover::before{opacity:1;filter:alpha(opacity=100)}
        .orbPmi::after{display:block;content:'';position:absolute;top:0;bottom:0;right:0;width:36px}
        .orbPmii{display:inline-block;vertical-align:middle;margin-right:10px;width:30px;height:16px;border:none!important;border-radius:2px!important}
        .orbPmin{display:inline-block;vertical-align:middle;}

          /* Compact General */
        .cmpct .orbPti{height:24px!important;width:44px!important}
        .cmpct .orbPtn{line-height:12px!important;font-size:12px!important}
        .cmpct .orbPtt{line-height:12px!important;font-size:10px!important}
        .cmpct .orbPp,.cmpct .orbPs{height:24px!important;width:24px!important;line-height:24px!important}
        .cmpct .orbPp::before{border-width:8px 0 8px 13px !important}
        .cmpct .orbPs::before{border-width:8px !important}
          /* Compact w/Playlist */
        .cmpct .orbPpli>a,.cmpct .orbPpli>span{line-height:24px!important;font-size:12px!important}
        .cmpct .orbPpli>a>time,.cmpct .orbPpli>span>time{font-size:11px!important}

      </style>
      <style media="screen" id="orb_player_197bfcb6f33738e3_settings">.orbP{background-color:#ebebeb !important;}/*common player background*/.orbP{border:none;}/*common player container border, radius, width*/.orbPp,.orbPs{background:#435b75 !important}/*buttons play/stop bg*/.orbPp::before{border-color:transparent transparent transparent #cfcfcf !important} /* play button color */.orbPs::before{border-color:#cfcfcf !important} /* stop button color */.orbPtn,.orbPtt,.orbPtt:hover{color:#7d7d7d !important;}/*station name & track link color*/.orbF{background:#ffffff !important;color:#444444 !important;border-color:#ebebeb !important}/* geo background & text color  */.orbFli,.orbFlif{box-shadow:0 0 1px 0 #444 inset !important}.orbFhi,.orbFhi::before,.orbFhi::after{border-color:#444 !important}</style>
      <div class="orbPhc">
        
      <audio id="orb_player_197bfcb6f33738e3_p" crossorigin="true" style="width:1px;height:1px;overflow:hidden;position:absolute;"></audio>

        <button class="orbPp" title="Listen live" country="id" alias="magelangfm" stream="1" style="background-color:rgba(0,0,0,0.0) !important; color:grey !important;"></button>
        <a class="orbPt" href="https://onlineradiobox.com/id/magelangfm/" target="_blank">
          <img class="orbPti" src="//cdn.onlineradiobox.com/img/l/2/79562.v4.png" alt="Radio Magelang FM" style="display: none;">
          <span class="orbPtn" style="display: block; padding-top:5px;">Radio Magelang FM</span>
        </a>
        <span class="orbPtt" loading="loading" playing="playing" error="playback error" not_supported="this browser can't play it" external="Listen now (Opens in popup player)" geo_blocked="Not available in your country" style="display: block;"></span>
        
      </div>

      <!-- <div class="orbF" style="display:none"></div> -->
      <script>
        var orbp_w = orbp_w || { lang: "en-us" };
        orbp_w.cmd = orbp_w.cmd || [];
        orbp_w.apiUrl = "https://onlineradiobox.com";
        orbp_w.cmd.push(function() {
          orbp_w.init("orb_player_197bfcb6f33738e3");
        });
        var s, t; s = document.createElement('script'); s.type = 'text/javascript';
      s.src = "//ecdn.onlineradiobox.com/js/pwidget2.min.235ca64e.js";
        t = document.getElementsByTagName('script')[0]; t.parentNode.insertBefore(s, t);
      </script>
      </div>
      <!--OnlineRadioBox Player widget-->

  </div>
      

</body>
</html>


      
      
