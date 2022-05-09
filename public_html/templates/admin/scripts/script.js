/**
 * @name Site
 * @description Global variables and functions
 * @version 1.0
 */
 $(document).ready(function(e) {
  LoadNotification();
  $('.up').click(function(){
     $("html, body").animate({ scrollTop: 0 }, 300);
  })
  $('.levInner>ul>li').each(function(){
      if($(this).children().length ==2) {
        $(this).find('ul').css("display","none");
      }
  });
  $('.levInner >ul>li:not(.current) >span').click(function(event){
    $(this).next().slideToggle('slow');
  });
  $('.levInner >ul>li >ul li:not(.current) span').click(function(event){
    $(this).next().slideToggle('slow');
  })

  $('#lev').hover(function(){
    $('.levInner').fadeIn();
  },
  function(){
    $('.levInner').fadeOut();
  });
  $(window).scroll(function() {
    if($(window).scrollTop() > 97) {
      $('#lev').addClass('fixed');
      $('#nav').addClass('fixed');
      $('.up').addClass('show_up');
      $('.checcccc').addClass('fix_form_search');
    }
    else{
      $('#lev').removeClass('fixed');
      $('#nav').removeClass('fixed');
      $('.up').removeClass('show_up');
      $('.checcccc').removeClass('fix_form_search');
    }
  });
  /*Ajax danh sach cong viec*/
 // AjaxListService();
  AjaxListService($('.selectlistsv'));
  AjaxListProduct($('.selectlistsp'));
  /*end*/
   $(".archiland--form-search").submit(function(){
     var keyword=$('.ipt-search').val();
     if(keyword=="")
     {
      alert("Chưa nhập thông tin tìm kiếm . Mời nhập lại");
    }else{
     window.location.href = '/search.html&keyword='+keyword;	
   }
   return false;
 });
 });
 $(function () {
  $("div.kt_all").slice(0, 5).show();
  $("#morechat").on('click', function (e) {
    e.preventDefault();
    $("div.kt_all:hidden").slice(0,5).slideDown();
    if ($("div.kt_all:hidden").length == 0) {
      $("#load").fadeOut('slow');
      $("div.button-loadKTAll").addClass('hidden-comment');
    }
  });
});
 $(function () {
  $("tr.kt_track").slice(0, 10).show();
  $("#moretrack").on('click', function (e) {
    e.preventDefault();
    $("tr.kt_track:hidden").slice(0,5).slideDown();
    if ($("tr.kt_track:hidden").length == 0) {
      $("#load").fadeOut('slow');
      $("div.button-loadTrack").addClass('hidden-comment');
    }
  });
});

 function ShowNotification(){
  $('.notifi-div').removeClass('hiddendiv');
  $('.bell2').removeClass('hiddendiv');
  $('.bell1').addClass('hiddendiv');
}
function HidenNotification(){
  $('.bell1').removeClass('hiddendiv');
  $('.notifi-div').addClass('hiddendiv');
  $('.bell2').addClass('hiddendiv');
}

function ReadNotification(ob){
 var id = $(ob).parents('li.li-item').find('input.idtomove').val();
 var link = $(ob).parents('li.li-item').find('input.linktomove').val();
 // alert(id);
 // alert(link);
 var op="notification";
 var ob_that=$(ob);
 $.ajax({
      type:'post',
      url:'/ajax.php',
      dataType:"json",
      data:{op:op,id:id,link:link},
      success:function(data)
      {
        if(data['success'] == 1){
          window.location.href = data['link'];
        }
        
      }
        }); 
}

function LoadNotification(){
  var ob = ("a.notifi");
  var idCur = $('input#idCurUs').val();
  var op="loadnotification";
  var ob_that=$(ob);

  $.ajax({
      type:'post',
      url:'/ajax.php',
      dataType:"json",
      data:{op:op,idCur:idCur},
      success:function(data)
      {
        if(data['sum'] > 0){
          $('.datetime .bg-green').text(data['sum']);
          $('.datetime .bg-green').show('slow');
        }else{
          $('.datetime .bg-green').hide();
        }
         var html = '';
         $('ul.listNotiul').html('');
        $.each(data['listNot'], function(key,data1){
          html +="<li class='li-item'>";
          html +="<a onclick='ReadNotification(this);'>";
          html += data1['details'];
          html +="</a>";
          html +="<input type='hidden' class='linktomove' value='" + data1['linktomove'] + "' />";
          html +="<input type='hidden' class='idtomove' value='" + data1['idtomove'] + "' />";
          html +="</li>";
    
        });
        html +="<li class='marsk-noti'>";
        html +="<a class='a-marsk-noti' href='/admin.php?op=manage&act=article&mod=clearnoti'>";
        html +="Xóa tất cả";
        html +="<i class='fa fa-angle-right'></i>";
        html +=" </a>";
        html +=" </li>";
        $('ul.listNotiul').append(html);
        start('now',2);
        
      }
        }); 
}
 function CountSum(ob){
      //var sl=$(ob).val();
      var price=$(ob).parents('.addmoresp').find('td.price input').val();
      var sl=$(ob).parents('.addmoresp').find('td.quantity input').val();
      var peroff=$(ob).parents('.addmoresp').find('td.peroff input').val();
      var ttoff=$(ob).parents('.addmoresp').find('td.ttoff input').val();
      var sum=price*sl;
      var change=1;
      if(peroff<0 || peroff>100){
       $(ob).parents('.addmoresp').find('td.peroff input').val(0);
       $(ob).parents('.addmoresp').find('td.ttoff input').val(0);
     }else{
      peroffservice=(sum*peroff)/100;
      change=2;
      sum=sum-peroffservice;
    }
    var nf = new Intl.NumberFormat();
    var check = minprice($(ob).parents('.addmoresp').find('td.price input'));
    if(check==true){
     
       if(change==2){
     $(ob).parents('.addmoresp').find('td.sum strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
     $(ob).parents('.addmoresp').find('td.sum input').val(sum);
     $(ob).parents('.addmoresp').find('td.ttoff input').val(peroffservice);
    }else{
       $(ob).parents('.addmoresp').find('td.sum strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
     $(ob).parents('.addmoresp').find('td.sum input').val(sum);
      $(ob).parents('.addmoresp').find('td.peroff input').val(0);
      $(ob).parents('.addmoresp').find('td.ttoff input').val(0);
    }
    GiamTotal();
     CountTotal();
     CountTotalTong();
     ThueVAT();
    TongAll();
   }
   else{
    $(ob).parents('.addmoresp').find('td.price input').val($(ob).parents('.addmoresp').find('td.price input').attr('value'));
  }
}
function CountSum1(ob){
     
      var price=$(ob).parents('.addmoresp').find('td.price input').val();
      var sl=$(ob).parents('.addmoresp').find('td.quantity input').val();
      var peroff=$(ob).parents('.addmoresp').find('td.peroff input').val();
      var ttoff=+$(ob).parents('.addmoresp').find('td.ttoff input').val();
      var sum=price*sl;
      var change=1;
      if(ttoff>0 && ttoff<sum){
        peroffservice=(ttoff*100)/sum;
        change=2;
        sum=sum-ttoff;
      }else{
        $(ob).parents('.addmoresp').find('td.peroff input').val(0);
        $(ob).parents('.addmoresp').find('td.ttoff input').val(0);
      }
    var nf = new Intl.NumberFormat();
    var check = minprice($(ob).parents('.addmoresp').find('td.price input'));
    if(check==true){
      if(change==2){
        $(ob).parents('.addmoresp').find('td.sum strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $(ob).parents('.addmoresp').find('td.sum input').val(sum);
        $(ob).parents('.addmoresp').find('td.peroff input').val(addPeriod(Math.round(peroffservice*10)/10));
      }else{
        $(ob).parents('.addmoresp').find('td.sum strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $(ob).parents('.addmoresp').find('td.sum input').val(sum);
        $(ob).parents('.addmoresp').find('td.peroff input').val(0);
        $(ob).parents('.addmoresp').find('td.ttoff input').val(0);
      }
      GiamTotal();
     CountTotal();
     CountTotalTong();
     ThueVAT();
    TongAll();
   }
   else{
    $(ob).parents('.addmoresp').find('td.price input').val($(ob).parents('.addmoresp').find('td.price input').attr('value'));
  }
}
function CountSumSV(ob){
      //var sl=$(ob).val();
      var price=$(ob).parents('.addmoredv').find('td.priceservice input').val();
      var peroff=$(ob).parents('.addmoredv').find('td.peroffservice input').val();
      var ttoffsv=$(ob).parents('.addmoredv').find('td.ttoffservice input').val();
      var peroffservice=0;
      var peroffservice1=0;
      var change=1;
      if(peroff<0 || peroff>100){
       $(ob).parents('.addmoredv').find('td.peroffservice input').val(0);
       $(ob).parents('.addmoredv').find('td.ttoffservice input').val(0);
     }else{
      peroffservice=(price*peroff)/100;
      change=2;
      sum=price-peroffservice;
    }
    var nf = new Intl.NumberFormat();
    var check = minprice($(ob).parents('.addmoredv').find('td.priceservice input'));
    if(check==true){
     if(change==2){
      $(ob).parents('.addmoredv').find('td.sumservice strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $(ob).parents('.addmoredv').find('td.sumservice input').val(sum);
      $(ob).parents('.addmoredv').find('td.ttoffservice input').val(peroffservice);
    }else{
       $(ob).parents('.addmoredv').find('td.sumservice strong').text(price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $(ob).parents('.addmoredv').find('td.sumservice input').val(price);
      $(ob).parents('.addmoredv').find('td.peroffservice input').val(0);
      $(ob).parents('.addmoredv').find('td.ttoffservice input').val(0);
    }
    GiamTotalSV();
    CountTotalSV();
    CountTotalTong();
    ThueVAT();
    TongAll();
  }
  else{
    $(ob).parents('.addmoredv').find('td.priceservice input').val($(ob).parents('.addmoredv').find('td.priceservice input').attr('value'));
  }
}

function CountSumSV1(ob){
      //var sl=$(ob).val();
      var price=$(ob).parents('.addmoredv').find('td.priceservice input').val();
      var peroff=$(ob).parents('.addmoredv').find('td.peroffservice input').val();
      var ttoffsv=+$(ob).parents('.addmoredv').find('td.ttoffservice input').val();
      var peroffservice=0;
      var peroffservice1=0;
      var change=1;
      if(ttoffsv>0 && ttoffsv<price){
        peroffservice=(ttoffsv*100)/price;
        //alert(peroffservice);
      //peroffservice1=peroffservice.toFixed(1);
      change=2;
      sum=price-ttoffsv;
    }else{
      $(ob).parents('.addmoredv').find('td.peroffservice input').val(0);
      $(ob).parents('.addmoredv').find('td.ttoffservice input').val(0);
    }
    var nf = new Intl.NumberFormat();
    var check = minprice($(ob).parents('.addmoredv').find('td.priceservice input'));
    if(check==true){
     if(change==2){
        $(ob).parents('.addmoredv').find('td.sumservice strong').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $(ob).parents('.addmoredv').find('td.sumservice input').val(sum);
        //$(ob).parents('.addmoredv').find('td.peroffservice input').val(peroffservice1);
        $(ob).parents('.addmoredv').find('td.peroffservice input').val(addPeriod(Math.round(peroffservice*10)/10));
      }else{
        $(ob).parents('.addmoredv').find('td.sumservice strong').text(price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $(ob).parents('.addmoredv').find('td.sumservice input').val(price);
        $(ob).parents('.addmoredv').find('td.peroffservice input').val(0);
        $(ob).parents('.addmoredv').find('td.ttoffservice input').val(0);
      }
      GiamTotalSV();
      CountTotalSV();
      CountTotalTong();
      ThueVAT();
      TongAll();
    }
    else{
      $(ob).parents('.addmoredv').find('td.priceservice input').val($(ob).parents('.addmoredv').find('td.priceservice input').attr('value'));
    }
  }
  function addPeriod(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
  }
  function AjaxRules(ob){

       //var product_id=$(ob).val();
       var rule_id=$(ob).parents('.addmoresp').find('select.rules_name_load').val();

       var op="rules";
       var ob_that=$(ob);

       $.ajax({
        type:'post',
        url:'/ajax.php',
        dataType:"json",
        data:{op:op,rule_id:rule_id},
        success:function(data){

         $(ob).parents('.addmoresp').find('td.noidung input.rule_id').attr('value',data['rule_id']);
         $(ob).parents('.addmoresp').find('td.noidung input.vitri').attr('value',data['vitri']);
       }
     })
     }
     $('#capital_id').change(function(){
      var id_tinh=$(this).val();
      var op="billvenue";
      $.ajax({
        type:'post',
        url:'/ajax.php',
        data:{op:op,id_tinh:id_tinh},
        success:function(data){
          $('#load_debt').html(data);
        }
      })
    })
     function AjaxProduct(ob){

       //var product_id=$(ob).val();
       var product_id=$(ob).parents('.addmoresp').find('select.product_name_load').val();
       var quantity= $('input.quantitysum').val();
       var price= $('input.pricesum').val();
       var op="product";
       var ob_that=$(ob);

       $.ajax({
        type:'post',
        url:'/ajax.php',
        dataType:"json",
        data:{op:op,product_id:product_id,quantity:quantity,price:price},
        success:function(data){
            // console.log($(ob).parents('.addmoresp').find('td.msp .product_series'));
            // $(ob).parents('.addmoresp').find('td.msp .product_series').attr('value','asd');
            $(ob).parents('.addmoresp').find('td.msp strong').text(data['series']);
            $(ob).parents('.addmoresp').find('td.msp .product_series').val(data['series']);
            $(ob).parents('.addmoresp').find('td.msp .proid').val(data['masp']);

            $(ob).parents('.addmoresp').find('td.price input.pricesum').attr('value',data['price']);
            $(ob).parents('.addmoresp').find('td.price input.pricesum').val(data['price']);
            $(ob).parents('.addmoresp').find('td.price input.pricepro').val(data['price']);
            $(ob).parents('.addmoresp').find('td.quantity .quantitysum').val(data['quantity']);

            $(ob).parents('.addmoresp').find('td.sum strong').text((data['sumprice']).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            $(ob).parents('.addmoresp').find('td.sum input').val(data['sumprice']);
            $(ob).parents('.addmoresp').find('td.peroff input').val(0);
            $(ob).parents('.addmoresp').find('td.ttoff input').val(0);

           // $(ob).parents('.addmoresp').find('td.price input.pricesum').attr('min',+data['price']);
           GiamTotal();
           CountTotal();
           CountTotalTong();
           ThueVAT();
          TongAll();
         }
       })
     }
     function AjaxService(ob){

       //var product_id=$(ob).val();
       var product_id=$(ob).parents('.addmoredv').find('select.service_name_load').val();

       var price= $('input.pricesumservice').val();
       var op="service";
       var ob_that=$(ob);

       $.ajax({
        type:'post',
        url:'/ajax.php',
        dataType:"json",
        data:{op:op,product_id:product_id,price:price},
        success:function(data){
          $(ob).parents('.addmoredv').find('td.mspservice strong').text(data['series']);
          $(ob).parents('.addmoredv').find('td.mspservice .product_series').val(data['series']);
          $(ob).parents('.addmoredv').find('td.mspservice .proid').val(data['masp']);
          $(ob).parents('.addmoredv').find('td.priceservice input.pricesumservice').attr('value',data['price']);
          $(ob).parents('.addmoredv').find('td.priceservice input.pricesumservice').val(data['price']);
          $(ob).parents('.addmoredv').find('td.priceservice input.priceproservice').val(data['price']);
          $(ob).parents('.addmoredv').find('td.sumservice strong').text((data['sumprice']).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
          $(ob).parents('.addmoredv').find('td.sumservice input').val(data['sumprice']);
          $(ob).parents('.addmoredv').find('td.peroffservice input').val(0);
          $(ob).parents('.addmoredv').find('td.ttoffservice input').val(0);
          $(ob).parents('.addmoredv').find('td.noteservice input').val('');
          GiamTotalSV();
          CountTotalSV();
          CountTotalTong();
          ThueVAT();
          TongAll();
        }
      })
     }
     function minprice(that){
      var check;
      +$(that).val()<+$(that).attr('value')?check=false:check=true;
      if(check==true){
        return true;
      }
      return false;
    }
    function minpriceSV(that){
      var check;
      +$(that).val()<+$(that).attr('value')?check=false:check=true;
      if(check==true){
        return true;
      }
      return false;
    }

    function CountTotal(){
      var sum = 0;
      var pv=0;
      $('input.sum1').each(function(){
        sum += +$(this).val();
      });
      $('input.sumpv1').each(function(){
        pv += +$(this).val();
      });
      $('.TongTien').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('.totaltien').val(sum);

    }
    function CountTotalTong(){
      var tonga=+$('input.totaltienSV').val();
      var tongb=+$('input.totaltien').val();
      var tongc=tonga+tongb;
      $('.Tong').text(tongc.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('input.tong').val(tongc);

    }
     function ThueVAT(){
    
      var tongc=+$('input.tong').val();
      
      var tongd=tongc*0.1;
      $('.TongThue').text(tongd.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('input.tongthue').val(tongd);

    }
    function TongAll(){
      var tongc=+$('input.tong').val();
      var tongd=+$('input.tongthue').val();
      
      var tonge=tongc+tongd;
      $('.TongCong').text(tonge.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('input.tongcong').val(tonge);

    }
     function GiamTotal(){
      var sum = 0;
      var pv=0;
      $('input.giamtt').each(function(){
        sum += +$(this).val();
      });
      $('input.sumpv1').each(function(){
        pv += +$(this).val();
      });
      $('.GiamGia').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('.totalGiam').val(sum);

    }
    function CountTotalSV(){
      var sum = 0;
      $('input.sum1service').each(function(){
        sum += +$(this).val();
      });

      $('.TongTienSV').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('.totaltienSV').val(sum);

    }
     function GiamTotalSV(){
      var sum = 0;
      $('input.giamttservice').each(function(){
        sum += +$(this).val();
      });

      $('.GiamGiaSV').text(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      $('.totalGiamSV').val(sum);

    }
    $('#customer_id').change(function(){
      var customer_id=$(this).val();
      var op="customer";
      $.ajax({
        type:'post',
        url:'/ajax.php',
        data:{op:op,customer_id:customer_id},
        success:function(data){
          $('#load_customer').html(data);
        }
      })
    });
    $('#rules_id').change(function(){
      var rules_id=$(this).val();
      var op="rules";
      $.ajax({
        type:'post',
        url:'/ajax.php',
        data:{op:op,rules_id:rules_id},
        success:function(data){
          $('#load_rules').html(data);
        }
      })
    });
    $(document).ready(function(e) {
      $('.selectpicker').selectpicker();

      $('.honnhan').click(function(){
        if($(this).prop("selected", true).val()==2){
          $('.tag_vochong').show('slow');
        }
        else{
          $('.tag_vochong').hide('slow');
        }
      })

      $('.vanhoa').click(function(){
        if($(this).prop("selected", true).val()==7){
          $('.tag_tdvh').show('slow');
        }
        else{
          $('.tag_tdvh').hide('slow');
        }
      })
      $('.cc_lcd').click(function(){     
          $('.tag_LCD').show('slow');
      })
      $('.cc_ltt').click(function(){     
          $('.tag_LCD').hide('slow');
      })

      $('.cc_thuecd').click(function(){     
          $('.tag_TLCD').show('slow');
      })
      $('.cc_thuett').click(function(){     
          $('.tag_TLCD').hide('slow');
      })
	  
      $('.luongkhoan').click(function(){     
          $('.tag_LK').show('slow');
		  $('.tag_LG').hide('slow');
      })
      $('.luonggio').click(function(){     
          $('.tag_LK').hide('slow');
          $('.tag_LG').show('slow');
      })
		
      $('.type_one_time_off').click(function(){
          $('.tag_type_time_off').hide('slow');
      })
      $('.type_more_time_off').click(function(){     
          $('.tag_type_time_off').show('slow');
      })
    });
    var Site = (function($, window, undefined) {
      'use strict';

      var body = $('body');


      var initToggleNav = function() {
        $('.icon-nav').on('click', function() {
          var ctMenu = $('.ct-navbar-menu');

          if(ctMenu.hasClass('show-menu')) {
            ctMenu.removeClass('show-menu');
          }
          else {
            ctMenu.addClass('show-menu');
          }

          (ctMenu.hasClass('show-menu') === true)
          ? body.css('overflow', 'hidden')
          : body.css('overflow', 'auto');
        });

        $('.close-nav').on('click', function() {
          $('.icon-nav').trigger('click', true);
        });
      }

      var initToggleFormSearch = function() {
        $('.icon-search').on('click', function() {
          var formSearch = $('.ct-form-search');

          if(formSearch.hasClass('show-form')) {
           formSearch.removeClass('show-form');
         }
         else {
          formSearch.addClass('show-form');
        }

        (formSearch.hasClass('show-form') === true)
        ? body.css('overflow', 'hidden')
        : body.css('overflow', 'auto');
      });

        $('.close-search').on('click', function() {
          $('.icon-search').trigger('click', true);
        });
      }

      var heroSlider = function() {
        $('.hero-slider').slick({
          autoplay: true,
          fade: true,
          cssEase: 'ease',
          speed: 800,
          autoplaySpeed: 2000,
        });
      }

      var serviceSlider = function() {
        $('.service-slider').slick({
          cssEase: 'ease',
          speed: 500,
          slidesToShow: 2,
          slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
          ]
        });
      };

      var projectSlider = function() {
        $('.project-slider').slick({
          cssEase: 'ease',
          speed: 500,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
          ]
        });
      };

      var projectListTab = function() {
        $('.project--list-tab').slick({
          cssEase: 'ease',
          speed: 500,
          slidesToShow: 7,
          slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          }
          ]
        });
      };

      var initProjectTab = function() {
        var listTabProject = $('.projects-tab');
        var tabLinks = listTabProject.find('[data-project-tabtop]');
        var tabContents = listTabProject.find('[data-project-tabcontent]');
        tabLinks.on('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          var self = $(this);
          var curTabContent = $(self.data('target'));

          tabLinks.removeClass('active');
          tabContents.removeClass('active');

          self.addClass('active');
          curTabContent.addClass('active');
        });
      };

      var newsSlider = function() {
        $('.news-slider').slick({
          cssEase: 'ease',
          speed: 500,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1300,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
          ]
        });
      };

      var teamSlider = function() {
        $('.teams-slider').slick({
          cssEase: 'linear',
          speed: 800,
          fade: true,
        });
      }

      var memberSlider = function() {
        $('.member-slider').slick({
          cssEase: 'ease',
          speed: 500,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          }
          ]
        });
      }

      var commentSlider = function() {
        $('.comment-slider').slick({
          cssEase: 'ease',
          speed: 500,
          dots: true,
        });
      }

      var initFixBot = function() {
        $(window).scroll(function() {
          if ($(this).scrollTop() > 250) {
            $('.fix-bot').fadeIn(500);
          }

          else {
            $('.fix-bot').fadeOut(500);
          }
        });

        $('.fix-bot').click(function(e) {
          e.preventDefault();
          e.stopPropagation();
          $('html, body').animate({scrollTop: 0}, 400);
          return false;
        });
      }

      var scrollListTabs = function() {
        var win = $(window);
        var scrollSection = $('.tab-scroll');
        var listTab = $('.project--list-tab');

        var resizeTimeout = 0;
        var scrollTimeout = 0;

        win
        .off('resize.scrollTab')
        .on('resize.scrollTab', function() {
          clearTimeout(resizeTimeout);
          resizeTimeout = setTimeout(function() {
            win.trigger('scroll.scrollTab');
          }, 50);
        });

        win
        .off('scroll.scrollTab')
        .on('scroll.scrollTab', function() {
          clearTimeout(scrollTimeout);
          scrollTimeout = setTimeout(function() {
            var scrollSectionTop = scrollSection.offset().top;
            var scrollSectionHeight = scrollSection.outerHeight(true);
            var listTabHeight = listTab.outerHeight(true);
            var scrollTop = win.scrollTop();

            if (scrollTop >= scrollSectionTop && scrollTop < scrollSectionHeight - listTabHeight) {
              listTab.animate({'top': (scrollTop - scrollSectionTop + 180) + 'px'}, 'slow');
            }
            else if (scrollTop < scrollSectionTop) {
              listTab.css('top', '');
            }
          }, 200);
        });
      };

      var projectDetailSlider = function() {
        $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          nextArrow: '<button type="button" class="slick-next"><img class="img" alt="icon-next" src="images/next.png"></button>',
          prevArrow: '<button type="button" class="slick-prev"><img class="img" alt="icon-prev" src="images/prev.png"></button>',
          asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          focusOnSelect: true,
          responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          },

          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },
          ]
        });
      };

      var initGalleryTab = function() {
        var listTabGallery = $('.ct-gallery-tab');
        var tabLinks = listTabGallery.find('[data-gallery-taptop]');
        var tabContents = listTabGallery.find('[data-gallery-tapcontent]');
        tabLinks.on('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          var self = $(this);
          var curTabContent = $(self.data('target'));

          tabLinks.removeClass('active');
          tabContents.removeClass('active');

          self.addClass('active');
          curTabContent.addClass('active');
        });
      };

      var initClickedText = function() {
        if (window.innerWidth < 768) {
          $('.link-tab').on('click', function() {
            var clickedLink = $(this);
            var clickedLinkText = clickedLink.text();
            var filterLabel = $('.label-tab');
            filterLabel.text(clickedLinkText);
            $('.list-recruitment').removeClass('show-list');
          })

          var listFil = $('.label-tab');
          listFil
          .off('click.showAcc')
          .on('click.showAcc', function() {
            var acc = $(this);
            listFil.not(acc).removeClass('active').next().removeClass('show-list');
            acc.toggleClass('active').next().toggleClass('show-list');
          });
        };
      }

      var initrecruitmentTab = function() {
        var listTab = $('.tabs-recruitment');
        var tabLinks = listTab.find('[data-recruitment-taptop]');
        var tabContents = listTab.find('[data-recruitment-tapcontent]');
        tabLinks.on('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          var self = $(this);
          var curTabContent = $(self.data('target'));

          tabLinks.removeClass('active');
          tabContents.removeClass('active');

          self.addClass('active');
          curTabContent.addClass('active');
        });
      };

      var initSelectMenu = function(){
       var selectMenus = $('.select-custom');
       selectMenus.selectmenu({
         change: function(event, data) {
           $(event.target).prop('selectedIndex', data.index);
           $(event.target).trigger('change');
         }
       });
     };

     var initReSize = function() {
      $(window).resize(function() {
        var ctMenu = $('.ct-navbar-menu');
        if (window.innerWidth >= 1200) {
          if (ctMenu.hasClass('show-menu')) {
            ctMenu.removeClass('show-menu');
            body.css('overflow', 'auto');
          }
        };
      });
    };

    var initValidateForm = function() {
      $(".validate").validate({
        rules: {
          name: "required",
          mail: "required",
          tel: {
            required: true,
            minlength: 10
          }
        },

        messages: {
          name: "Vui lòng nhập tên",
          mail: "Vui lòng nhập Email",
          tel: {
            required: "Vui lòng nhập Số Điện Thoại",
            minlength: "Số điện thoại chưa đúng"
          }
        }
      });
    }


    var homePage = function() {
      initToggleNav();
      initToggleFormSearch();
      heroSlider();
      serviceSlider();
      projectSlider();
      projectListTab();
      initProjectTab();
      newsSlider();
      teamSlider();
      commentSlider();
      memberSlider();
      initFixBot();
      initReSize();
    };

    var aboutUsPage = function() {
      initToggleNav();
      initToggleFormSearch();
      teamSlider();
      commentSlider();
      memberSlider();
      initFixBot();
      initReSize();
    };

    var projectPage = function() {
      initToggleNav();
      initToggleFormSearch();
      commentSlider();
      memberSlider();
      initFixBot();
      scrollListTabs();
      initProjectTab();
      initReSize();
    };

    var projectDetailPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      projectDetailSlider();
      initGalleryTab();
      initReSize();
      initValidateForm();
    };

    var newsPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      initReSize();
    };

    var newsDetailPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      initReSize();
      initValidateForm();
    };

    var contactPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      initReSize();
      initValidateForm();
    };

    var videoPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      initReSize();
    };

    var recruitmentPage = function() {
      initToggleNav();
      initToggleFormSearch();
      initFixBot();
      initClickedText();
      initrecruitmentTab();
      initSelectMenu();
      initReSize();
    };



    return {
      homePage: homePage,
      aboutUsPage: aboutUsPage,
      projectPage: projectPage,
      projectDetailPage: projectDetailPage,
      newsPage: newsPage,
      newsDetailPage: newsDetailPage,
      contactPage: contactPage,
      videoPage: videoPage,
      recruitmentPage: recruitmentPage,
    };


  })(jQuery, window);

  jQuery(function() {
   if ($('.home-page').length) {
     Site.homePage();
   };

   if ($('.about-us-page').length) {
    Site.aboutUsPage();
  };

  if ($('.project-page').length) {
    Site.projectPage();
  };

  if ($('.project-detail').length) {
    Site.projectDetailPage();
  };

  if ($('.news-page').length) {
    Site.newsPage();
  };

  if ($('.news-detail-page').length) {
    Site.newsDetailPage();
  };

  if ($('.contact-page').length) {
    Site.contactPage();
  };

  if ($('.video-page').length) {
    Site.videoPage();
  };

  if ($('.recruitment-page').length) {
    Site.recruitmentPage();
  };
  
});
  $(document).ready(function(){
   $(".cp3").CanvasColorPicker();
  // $(".sub li").each(function(){
  //   if($(this).hasClass("<?=$_REQUEST["com"].'_'.$_REQUEST["act"]?>")){
  //     $(this).addClass("this");
  //   }
  // })
  $.fn.exists = function(){return this.length>0;}
  $(".categories_li").each(function(){
    if($(this).find("ul").find("li").exists()==false){
      $(this).hide();
    }
  })
  
});
  $(document).ready(function(e) {
    $('button[name=ok]').click(function(){
      var mau = $('.cp3').val();
      if(mau!='' && mau!='Thêm màu')
      {
        var maucu = $('.mausac').val();
        if(maucu=='')
        {
          $('.mausac').val(mau);
        }
        else
        {
         $('.mausac').val(mau);
       }
       $('.cp3').val('Set Color');
       $('.add_mau span').remove();
       $('.add_mau').append('<span data-mau="'+mau+'" style="background-color:'+mau+'"><b title="Xóa màu này"></b></span>');
       $('.add_mau span b').click(function(){
        var mausac = $('.mausac').val();
        var mauxoa = $(this).parent('span').data('mau');
        var chuoimoi = mausac.replace(','+mauxoa, '');
        chuoimoi = chuoimoi.replace(mauxoa+',', '');
        chuoimoi = chuoimoi.replace(mauxoa, '');
        $('.mausac').val(chuoimoi);
        $(this).parent('span').remove();
      });
     }
   });
    $('.add_mau span b').click(function(){
      var mausac = $('.mausac').val();
      var mauxoa = $(this).parent('span').data('mau');
      var chuoimoi = mausac.replace(','+mauxoa, '');
      chuoimoi = chuoimoi.replace(mauxoa+',', '');
      chuoimoi = chuoimoi.replace(mauxoa, '');
      $('.mausac').val(chuoimoi);
      $(this).parent('span').remove();
    });
  });
// var base_url = 'http://<?=$config_url?>'; 
// Ajax danh sach dich vu
  function AjaxListService(ob){
    var op="listservices";
    var parent_cc = $(ob).parents('.addmoredv');
    var length = 1;
    var fruits = [];
    fruits=Fruits();
    //console.log(fruits);
    // $('.service_name_load').each(function(){
    //     fruits.push($(this).val());
    //   })
    $.ajax({
      type: "POST",
      url: "/ajax.php",
      data:{op:op,fruits:fruits},
      success: function(data){
        $(parent_cc).find(".service_name_load").html(data);
      }
      });
   }
   function Fruits(){
    var fruits = [];
    $('.service_name_load').each(function(){
      fruits.push($(this).val());
    });
    return fruits;
   }
   //end ajax dich vu
   // ajax san pham
   function AjaxListProduct(ob){
    var op="listproducts";
    var parent_cc = $(ob).parents('.addmoresp');
    var length = 1;
    var fruits = [];
    fruits=FruitsPro();
//    console.log(fruits);
    // $('.service_name_load').each(function(){
    //     fruits.push($(this).val());
    //   })
    $.ajax({
      type: "POST",
      url: "/ajax.php",
      data:{op:op,fruits:fruits},
      success: function(data){
        $(parent_cc).find(".product_name_load").html(data);
      }
      });
   }
   function FruitsPro(){
    var fruits = [];
    $('.product_name_load').each(function(){
      fruits.push($(this).val());
    });
    return fruits;
   }
   //end ajax sp
   function menuactive(that){
  $(that).parent().children().each(function(){
    $(this).removeClass('active');
  })
  $(that).addClass('active');
}
function tabactive(active,tab){
  $(tab).each(function(){
    $(this).removeClass('active');
  })
  $(tab).eq(active).addClass('active');
}
$(window).scroll(function(){
	if($('#formType').length == 1){
    var h = 0;
    if ($('#product_field').length == 1) {
      h = -45;
    }
		var leng = $('#formType th').length;
		if($(window).scrollTop() > $('#formType').offset().top + h){
			if(!$('#formType thead').hasClass('fix_top')){
        if ($('#product_field').length == 1) {
          $('#product_field').append($('#formType thead').clone().addClass('fix_top'));  
        }
        else {
          $('#formType').append($('#formType thead').clone().addClass('fix_top'));  
        }
				for(i=1;i<=leng;i++){
					var w = $('#formType th:nth-child('+i+')').width();
					$('#formType thead.fix_top th:nth-child('+i+')').css('width',w+'px');
				}	
			}
		}
		else {
			$('#formType thead.fix_top').remove();
		}
	}
})