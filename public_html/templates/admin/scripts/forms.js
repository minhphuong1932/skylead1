
$(document).ready(function(e) {

	// $("#submit_to_quote").click(function() {
	// var x = $("#show_quote_demo").val();
 //  $("input#content").val(0);
 //  // document.getElementById("#content")

 //  });

	// $('.ui-datepicker tr td a').click(function(){
	// 	alert("a");
	// 	setTimeout(function(){
	//       var financial =  $('.financial_year').attr('value');
	//       $('#month_processed').attr('value',financial);
	//       //alert(address);
	//     },1000);
	// });
	$('body').click(function(){
		$('#suggesstion-box').hide();
		$('#search-npp').val('');
	});
	
	$('body').click(function(){
		$('#suggesstion-box-nvul').hide();
		$('#search-nvul').val('');
	});
	
	$( "#financial_year1" ).datepicker({
      	dateFormat: 'dd/mm/yy'});

});

// $('#province').change(function(){
//       var id_tinh=$(this).val();
//       var op="tinhthanh";
//       $.ajax({
//           type:'post',
//           url:'/ajax.php',
//           data:{op:op,id_tinh:id_tinh},
//           success:function(data){
//             $('#national').html(data);
//           }
//         })
//     });
$('#samett').click(function(){
  if($(this).is(":checked")){
  	$('#addresslh').val($('#addresstt').val());
  	$('#province1').val($('#province').val());
  	$('#national1').val($('#national').val());
  	//$('#province1  option[value='+$("#province").val()+']').prop("selected", true);

  	//$('#national1  option[value='+$("#national").val()+']').prop("selected", true);
//  	ajaxprovince('#province','#national1');
//  	setTimeout(function(){
//  		$('#province1  option[value='+$("#province").val()+']').prop("selected", true);
//  		$('#national1  option[value='+$("#national select").val()+']').prop("selected", true);
//  	},100);
  	
  }
  else{
  	$('#addresslh').val('').focus();
  }
});
function ajaxprovince(id_province,result){
	   var id_tinh=$(id_province).val();
      var op="tinhthanh";
      $.ajax({
          type:'post',
          url:'/ajax.php',
          data:{op:op,id_tinh:id_tinh},
          success:function(data){
            $(result).html(data);
          }
        })
}

function downloadpdf(){
	var x = $("textarea .detailtext").val();

	var y = document.getElementById("sapo").value;
	alert(y);
 	
}   	
function changedate(val){
	  $('#month_processed').val(val.substr(3,7));
}

function changeColor(color,color_opa) {
	$('#changeColor').empty().append(":root{"+
				"--primary-color:"+color+";--primary-color-opacity:"+color_opa+";}")
}
// function fromday(val){
// 	  $('#to').val(val);
// }

$(document).ready(function(){
  if($('#result-user > .sid').length > 0) {
    $('.checkin-edit').attr("disabled", "disabled");
  }

	$("#gioithieu").focus(function(){
		$(this).select();
	});
	$("#gioithieu").keyup(function(){
		var op="nggioithieu";
		var id_gioithieu=$(this).val();
		if(id_gioithieu.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,id_gioithieu:id_gioithieu},
			success: function(data){
			$("#result-box").show();
			$("#result-box").html(data);
			}
			});
		} else {
			$("#result-box").hide();
		}
	});
	// $("#gioithieu").focusout(function(){
	// 	$("#result-box").hide();
	// });
  
  $("#doitruong").focus(function(){
		$(this).select();
	});
	$("#doitruong").keyup(function(){
		var op="doitruong";
		var id_doitruong=$(this).val();
		if(id_doitruong.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,id_doitruong:id_doitruong},
			success: function(data){
			$("#result-doitruong").show();
			$("#result-doitruong").html(data);
			}
			});
		} else {
			$("#result-doitruong").hide();
		}
	});
	// $("#doitruong").focusout(function(){
	// 	$("#result-doitruong").hide();
	// });

	$("#mahd").focus(function(){
		$(this).select();
	});
	$("#mahd").keyup(function(){
		var op="hopdong";
		var id_hd=$(this).val();
		var id_khachhang = $("#id_khachhang").val();
		if(id_hd.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,id_hd:id_hd,id_khachhang:id_khachhang},
			success: function(data){
			$("#result-hd").show();
			$("#result-hd").html(data);
			}
			});
		} else {
			$("#result-hd").hide();
		}		
	});
	// $("#mahd").focusout(function(){
	// 	$("#result-hd").hide();
	// });

	$("#catruong").focus(function(){
		$(this).select();
	});
	$("#catruong").keyup(function(){
		var op="catruong";
		var id_catruong=$(this).val();
		var starttime = $("#timestart").val();
		var finishtime = $("#timefinish").val();
		if(id_catruong.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,id_catruong:id_catruong,starttime:starttime,finishtime:finishtime},
			success: function(data){
			$("#result-ct").show();
			$("#result-ct").html(data);
			}
			});
		} else {
			$("#result-ct").hide();
		}
	});

	$("#search-profile").focus(function(){
		$(this).select();
	});
	
	$("#search-profile").bind("keyup click",function(){
		var length = 1;
		if($('#result-profile').children().length !== 0){
			length = $('#result-profile .sid').length;  
		}
		var list_other = [];
		var op="profile";
		var ten_profile=$(this).val();
		if(ten_profile.length > 2) {
			if($('#result-profile').children().length !== 0) {
				$('#result-profile .sid>div:first-child').each(function(){
					if(list_other.length <= length) {
						list_other.push($(this).children('input').val());
					}
				});
			}
			
			$.ajax({
				type: "POST",
				url: "/ajax.php",
				data:{op:op,ten_profile:ten_profile,list_other:list_other},
				success: function(data){
					$("#suggestion-profile").show();
					$("#suggestion-profile").html(data);
				}
			});
		} else {
			$("#suggestion-profile").hide();
		}
	});
	
	$("#muctieu").focus(function(){
		$(this).select();
	});
//	$("#muctieu").keyup(function(){
//		var op="muctieu";
//		var ten_target=$(this).val();
//		if(ten_target.length >=3){
//			$.ajax({
//			type: "POST",
//			url: "/ajax.php",
//			data:{op:op,ten_target:ten_target},
//			success: function(data){
//				$("#result-mt").show();
//				$("#result-mt").html(data);
//			}
//			});
//		} else {
//			$("#result-mt").hide();
//		}
//	});
	$("#muctieu").bind("keyup click",function(){
		var op="muctieu";
		var ten_target=$(this).val();
		if(ten_target.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,ten_target:ten_target},
			success: function(data){
				$("#result-mt").show();
				$("#result-mt").html(data);
			}
			});
		} else {
			$("#result-mt").hide();
		}
	});
	
	
	
	$("#search-nvul").focus(function(){
		$(this).select();
	});
	
	$("#search-nvul").bind("keyup click",function(){
		var length = 1;
		if($('#result-nvul').children().length !== 0){
			length = $('#result-nvul .sid').length;  
		}
		var list_nvul = [];
		var op="nhanvienungluong";
		var ten_nv=$(this).val();
		if(ten_nv.length > 2) {
			if($('#result-nvul').children().length !== 0) {
				$('#result-nvul .sid>div:first-child').each(function(){
					if(list_nvul.length <= length) {
						list_nvul.push($(this).children('input').val());
					}
				});
			}
			
			$.ajax({
				type: "POST",
				url: "/ajax.php",
				data:{op:op,ten_nv:ten_nv,list_nvul:list_nvul},
				success: function(data){
					$("#suggestion-nvul").show();
					$("#suggestion-nvul").html(data);
				}
			});
		} else {
			$("#suggestion-nvul").hide();
		}
	});
	
	// $("#muctieu").focusout(function(){
	// 	$("#result-mt").hide();
	// });

	$("#name_customer").focus(function(){
		$(this).select();
	});
	
	$('form[name = "formEditMC"] > fieldset > div > p > input#name_customer').on("change", function() {
		var name_cus = $('form[name = "formEditMC"] > fieldset > div > p > input#name_customer').val();
		if(name_cus === '' || typeof(name_cus) === 'undefined')
		{
			$('#id_kh').attr('value','');
			$('#id_target').attr('value','');
			$('#result-tg').empty();
//				$('form[name = "formEditMC"] > fieldset > p.btn > input[name = "btnSubmit"]').prop("disabled", true);
		}
//		else
//			{
//				$('form[name = "formEditMC"] > fieldset > p.btn > input[name = "btnSubmit"]').prop("disabled", false);
//			}
	});
	
	$("#name_customer").keyup(function(){
		// var op="khachhang";
		// var ten_customer=$(this).val();
		// if(ten_customer.length >=3){
		// 	$.ajax({
		// 	type: "POST",
		// 	url: "/ajax.php",
		// 	data:{op:op,ten_customer:ten_customer},
		// 	success: function(data){
		// 	$("#result-ct").show();
		// 	$("#result-ct").html(data);
		// 	}
		// 	});
		// } else {
		// 	$("#result-ct").hide();
		// }
	});

	$("#name_customer_searchck").keyup(function(){
		var op="khachhang_search";
		var ten_customer=$(this).val();
		if(ten_customer.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,ten_customer:ten_customer},
			success: function(data){
			$("#result-ct-search").show();
			$("#result-ct-search").html(data);
			}
			});
		} else {
			$("#result-ct-search").hide();
		}
	});
	// $("#name_customer").focusout(function(){
	// 	$("#result-ct").hide();
	// });
	
	$("#name_contract").focus(function(){
		$(this).select();
	});
	$("#name_contract").keyup(function(){
		var op="contract";
		var ten_ct=$(this).val();
		var id_dt=$("#id_dt").val();
		if(ten_ct.length >=3){
			$.ajax({
				type: "POST",
				url: "/ajax.php",
				data:{op:op,ten_ct:ten_ct,id_dt:id_dt},
				success: function(data){
				$("#result-contract1").show();
				$("#result-contract1").html(data);
				}
			});
		} else {
			$("#result-contract1").hide();
		}
	});
	// $("#name_contract").focusout(function(){
	// 	$("#result-contract1").hide();
	// });
  
	$("#search-npp").keyup(function(){
    var length = 1;
    if($('#result-user').children().length!==0){
      length = $('#result-user .sid').length;  
    } 
    var fruits = [];
    var op="nhanvien";
    var id_op=$(this).val().trim();
    var id_cus=$("#id_kh").val();
    var id_tar=$("#id_target").val();
    var id_time=$("#id_time").val();
    var date_checkin =$("#datetimepicker").val();  // checkin chọn ngày  
    if(id_op.length>=3){
      if($('#result-user').children().length!==0){
      $('#result-user .sid>div:first-child').each(function(){
        if(fruits.length <= length)
          fruits.push($(this).children('input').val());
      });
       //console.log(fruits);
    }
    // console.log(id_op);
    // console.log(user_group);
      $.ajax({
		  type: "POST",
		  url: "/ajax.php",
		  data:{
			op:op,
			id_op:id_op,
			fruits:fruits,
			id_cus:id_cus,
			id_tar:id_tar,
			id_time:id_time,
			date_checkin:date_checkin // checkin chọn ngày
		  },
		  success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			// $('.selectpicker10').selectpicker();
			// $('#suggesstion-box').find('.btn-group.bootstrap-select.10.medium').addClass('open').focus();
			// $('#suggesstion-box').find('button.btn.dropdown-toggle.btn-default').attr('aria-expanded','true');
			// $('#suggesstion-box').find('ul.dropdown-menu.inner').attr('aria-expanded','true');
			// $('#suggesstion-box').find('ul.dropdown-menu.inner').children().eq(0).addClass('selected active');
			// $('#search-npp').focusout();
		  }
      });
    }
    else {
      $("#suggesstion-box").hide();
    }
  	});

  
	$("#search-npp").keyup(function(){
    var length = 1;
    if($('#result-user').children().length!==0){
      length = $('#result-user .sid').length;  
    } 
    var fruits = [];
    var op="nhanvien";
    var id_op=$(this).val().trim();
    var id_cus=$("#id_kh").val();
    var id_tar=$("#id_target").val();
    var id_time=$("#id_time").val();
    if(id_op.length>=3){
      if($('#result-user').children().length!==0){
      $('#result-user .sid>div:first-child').each(function(){
        if(fruits.length <= length)
          fruits.push($(this).children('input').val());
      });
       //console.log(fruits);
    }
    // console.log(id_op);
    // console.log(user_group);
      $.ajax({
      type: "POST",
      url: "/ajax.php",
      data:{
      	op:op,
      	id_op:id_op,
      	fruits:fruits,
      	id_cus:id_cus,
      	id_tar:id_tar,
      	id_time:id_time
      },
      success: function(data){
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $('.selectpicker10').selectpicker();
        // $('#suggesstion-box').find('.btn-group.bootstrap-select.10.medium').addClass('open').focus();
        // $('#suggesstion-box').find('button.btn.dropdown-toggle.btn-default').attr('aria-expanded','true');
        // $('#suggesstion-box').find('ul.dropdown-menu.inner').attr('aria-expanded','true');
        // $('#suggesstion-box').find('ul.dropdown-menu.inner').children().eq(0).addClass('selected active');
        // $('#search-npp').focusout();
      }
      });
    }
    else {
      $("#suggesstion-box").hide();
    }
  });
	
	// $("#search-npp").focusout(function(){
	// 	$("#suggesstion-box").hide();
	// });


	// $("#result-position1").click(function(){
	// 	// var id_target=$("#id_target").val();
	// 	// var id_time=$("#id_time").val();
	// 	// $.ajax({
	// 	// 	type: "POST",
 //  //     url: "/ajax.php",
 //  //     data:{op:"vitri_dt",id_target:id_target,id_time:id_time},
 //  //     success: function(data){
 //  //      $("#result-position1").show();
 //  //      $("#result-position1").html(data);
 //  //     }
	// 	// 	})
	// });
});
function close_sid(that) {
	$(that).parents('.sid').remove();
	$('#search-nvul').removeAttr("disabled");
	$('.checkin-edit').removeAttr("disabled");
}
function selectEvent(val) {
  $("#search-box").val(val);
  $("#suggesstion-box").hide(); 	
}
function clickaddnpp(ob){
	var parent_tag = $(ob).parents('.parent_ajax');
	var id = $(parent_tag).find('[id*="search-npp-"]').attr('id');
	var content=$(ob).html();
	var id_user=$(ob).data('id');
	var html='<div class="sid"><input type="hidden" name="user_'+id+'[]" value="'+id_user+'" /> '+content+'<span class="close-sid" onClick="close_sid(this)">x</span></div>';
	$(parent_tag).find('#result-user').append(html);
	$(parent_tag).find('#suggesstion-box').css('display','none');
	$(parent_tag).find('#search-npp').val('');
}

function clicknhavien(ob){
	var parent_tag = $(ob).parents('.parent_ajax');
	//var id = $(parent_tag).find('[id*="search-npp-"]').attr('id');
	// console.log(id);
	var sogio=$('#id_time').data('time');
	console.log(sogio);
  var content=$(ob).html();
  var id_user=$(ob).data('id');
  var html='<div class="sid sid--time">'+
  						'<div><input type="hidden" name="user[]" value="'+id_user+'" />'+
  						 content+'</div>'+
  						 '<div><input type="text" class="timeW" name="timeW[]" value='+sogio+'><span class="close-sid" onClick="close_sid(this)">x</span></div></div>';
  $(parent_tag).find('#result-user').append(html);
  $(parent_tag).find('#suggesstion-box').css('display','none');
  $(parent_tag).find('#search-npp').val('');
  var count = $('#result-user > .sid').length;
	if(count > 0) {
    $('.checkin-edit').attr("disabled", "disabled");
  }
}

function clickprofilenhavien(profile){
	var parent_tag = $(profile).parents('.parent_ajax');
	//var id = $(parent_tag).find('[id*="search-npp-"]').attr('id');
	//console.log(parent_tag);
	// var sogio=$('#id_time').data('time');
  var content=$(profile).html();
  var id_user=$(profile).data('id');
  var html='<div class="sid sid--time cc">'+
  						'<div><input type="hidden" name="user[]" value="'+id_user+'" />'+
  						 content+'<span class="close-sid" onClick="close_sid(this)">x</span></div>'+
  						 '<div><textarea class="noteuser" name="noteuser[]" rows="4" cols="50" placeholder="Nhập ghi chú..."></textarea></div></div>';
  $(parent_tag).find('#result-profile').append(html);
  $(parent_tag).find('#suggestion-profile').css('display','none');
  $(parent_tag).find('#search-profile').val('');
}

function clicknvul(nvul){
	var parent_tag = $(nvul).parents('.parent_ajax');
	var content = $(nvul).html();
	var id_user = $(nvul).data('id');
	var html = '<div class="sid sid--time">'+
  						'<div><input type="hidden" name="user[]" value="'+id_user+'" />'+
  						 content+'</div>'+
  						 '<div><span class="close-sid" onClick="close_sid(this)">x</span></div></div>';
	
	$(parent_tag).find('#result-nvul').append(html);
	$(parent_tag).find('#suggestion-nvul').css('display','none');
	$(parent_tag).find('#search-nvul').val('');
	$('#search-nvul').attr("disabled", "disabled");
	
	result_sum();
}

function changeMaxAP() {
	var op = "changemaxap";
	var user_group = $("#user_group").val();
	
	$.ajax({
      type: "POST",
      url: "/ajax.php",
      data:{
      	op:op,
		user_group:user_group
	  },
	  success: function(data){
		  $("#max_advance_payment").val(data);
		  console.log(data);
	  }
	});
}

$('#salary_period').on('change',function(){result_sum();});

function result_sum() {
	var count = $('#result-nvul > .sid').length;
	if(count > 0) {
		$('input[name^="user"]').each(function() {
			var id_u = $(this).val();
			var op = "tienung";
			var salary_period = $("#salary_period").val();
			
			$.ajax({
				type: "POST",
				url: "/ajax.php",
				dataType : "text",
				data:{
					op:op,
					id_u:id_u,
					salary_period:salary_period
				},
				success: function(data){
					 var max_advance_payment = parseInt($('#max_advance_payment1').val());
					$('#max_advance_payment').val((max_advance_payment-parseInt(data)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				}
			});
		});
	}
}

function clickmuctieu(mt){
	$('#muctieu').val($(mt).data('name'));
	$('#id_target').attr('value',$(mt).data('id'));
	$('#result-mt').hide();
}
function clickpeople(q){
	//$('#gioithieu').val($(q).data('name'));
	$('#gioithieu').val($(q).data('name'));
	$('#id_angt').attr('value',$(q).data('id'));
	$('#result-box').hide();
}

function clickdoitruong(dt){
	//$('#gioithieu').val($(q).data('name'));
	$('#doitruong').val($(dt).data('name'));
	$('#id_doitruong').attr('value',$(dt).data('id'));
	$('#result-doitruong').hide();
}

function clickhopdong(h){
	$('#mahd').val($(h).data('name'));
	$('#id_hd').attr('value',$(h).data('id'));
	$('#result-hd').hide();
} 

function clickkh(k){
	//Load ajax tên trụ sở

			$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"truso",id_customer:$(k).data('id')},
      success: function(data){
       $("#result-tg").show();
       $("#result-tg").html(data);
      }
			})

	$('#name_customer').val($(k).data('name'));
	$('#id_kh').attr('value',$(k).data('id'));
	$('#result-ct').hide();
} 

function clickkhsearch(k){
	//Load ajax tên trụ sở

			$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"truso_search",id_customer:$(k).data('id')},
      success: function(data){
       $("#result-tg-search").show();
       $("#result-tg-search").html(data);
      }
			})

	$('#name_customer_searchck').val($(k).data('name'));
	$('#id_kh_search').attr('value',$(k).data('id'));
	$('#result-ct-search').hide();
} 

function clickct(cota){
	//Load ajax tên trụ sở
  var id_truong = $("#id_dt").val();
			$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"truso_dt",id_ct:$(cota).data('id'),id_truong:id_truong},
      success: function(data){
       $("#result-tg1").show();
       $("#result-tg1").html(data);
      }
			})
	$('#name_contract').val($(cota).data('name'));
	$('#id_kh').attr('value',$(cota).data('id'));
	$('#result-contract1').hide();
} 
function clicktarget(t){
	//load ca trực
	var data=$(t).find('option:selected');
	var id_kh = $("#id_kh").val();
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"catruc",id_catruc:data.data('id'),id_kh:id_kh},
      success: function(data){
       $("#result-time").show();
       $("#result-time").html(data);
      }
			})
	// $.ajax({
	// 		type: "POST",
 //      url: "/ajax.php",
 //      data:{op:"vitri",id_catruc:data.data('id')},
 //      success: function(data){
 //       $("#result-position").show();
 //       $("#result-position").html(data);
 //      }
	// 	})
	$('#id_target').attr('value',data.data('id'));	
} 

function clicktargetsearch(t){
	//load ca trực
	var data=$(t).find('option:selected');
	var id_kh = $("#id_kh").val();
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"catruc_search",id_catruc:data.data('id'),id_kh:id_kh},
      success: function(data){
       $("#result-time-search").show();
       $("#result-time-search").html(data);
      }
			})
	// $.ajax({
	// 		type: "POST",
 //      url: "/ajax.php",
 //      data:{op:"vitri",id_catruc:data.data('id')},
 //      success: function(data){
 //       $("#result-position").show();
 //       $("#result-position").html(data);
 //      }
	// 	})
	$('#id_target_search').attr('value',data.data('id'));	
} 

function clicktruso(truso){
	//load ca trực
	var data=$(truso).find('option:selected');
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"catruc_dt",id_truso:data.data('id')},
      success: function(data){
       $("#result-time1").show();
       $("#result-time1").html(data);
      }
			})
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"vitri_dt",id_trs:data.data('id')},
      success: function(data){
       $("#result-position1").show();
       $("#result-position1").html(data);
      }
			})
	$('#id_target').attr('value',data.data('id'));	
} 

// function clickcuto(custo){
// 	var data=$(custo).find('option:selected');
// 	// $.ajax({
// 	// 		type: "POST",
//  //      url: "/ajax.php",
//  //      data:{op:"truso_dt",id_khdt:data.data('id')},
//  //      success: function(data){
//  //       $("#result-tg1").show();
//  //       $("#result-tg1").html(data);
//  //      }
// 	// 		})
// 	$('#id_kh').attr('value',data.data('id'));
//  	// $('#id_time').attr('data-time',data.data('time'));
// }

function clicktime(z){
	var data=$(z).find('option:selected');
	// var id_target=$("#id_target").val();
	// var id_time=$("#id_time").val();
	// console.log(id_target);
	// console.log(id_time);
	// $.ajax({
	// 		type: "POST",
 //      url: "/ajax.php",
 //      data:{op:"vitri",id_target:id_target,id_time:id_time},
 //      success: function(data){
 //       $("#result-position").show();
 //       $("#result-position").html(data);
 //      }
	// 	})
	$('#timetarget').val(data.data('name'));
	$('#id_time').attr('value',data.data('id'));
 	$('#id_time').attr('data-time',data.data('time'));

 	var id_target=$("#id_target").val();
	var id_time=$("#id_time").val();
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"vitri",id_target:id_target,id_time:id_time},
      success: function(data){
       $("#result-position").show();
       $("#result-position").html(data);
      }
		})
} 

function clicktimesearch(z){
	var data=$(z).find('option:selected');
	// var id_target=$("#id_target").val();
	// var id_time=$("#id_time").val();
	// console.log(id_target);
	// console.log(id_time);
	// $.ajax({
	// 		type: "POST",
 //      url: "/ajax.php",
 //      data:{op:"vitri",id_target:id_target,id_time:id_time},
 //      success: function(data){
 //       $("#result-position").show();
 //       $("#result-position").html(data);
 //      }
	// 	})
	$('#timetarget').val(data.data('name'));
	$('#id_time_search').attr('value',data.data('id'));
 	$('#id_time_search').attr('data-time',data.data('time'));

 	var id_target=$("#id_target_search").val();
	var id_time=$("#id_time_search").val();
	$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"vitri_search",id_target:id_target,id_time:id_time},
      success: function(data){
       $("#result-position-search").show();
       $("#result-position-search").html(data);
      }
		})
} 

function clickpositionsearch(k){
	var data=$(k).find('option:selected');
	$('#id_position_search').attr('value',data.data('id'));
} 

function clickposition(k){
	var data=$(k).find('option:selected');
	$('#id_position').attr('value',data.data('id'));
} 
function clickcatruc(tua){
	var data=$(tua).find('option:selected');
	// $('#timetarget').val(data.data('name'));
	$('#id_time').attr('value',data.data('id'));
 	$('#id_time').attr('data-time',data.data('time'));
 	
 	var id_target=$("#id_target").val();
	var id_time=$("#id_time").val();
		$.ajax({
			type: "POST",
      url: "/ajax.php",
      data:{op:"vitri_dt",id_target:id_target,id_time:id_time},
      success: function(data){
       $("#result-position1").show();
       $("#result-position1").html(data);
      }
			})
} 

function clickvitri(vtri){
	var data=$(vtri).find('option:selected');
	$('#id_position').attr('value',data.data('id'));
} 
function clickcatruong(c){
	$('#catruong').val($(c).data('name'));
	$('#id_catruong').attr('value',$(c).data('id'));
	$('#result-ct').hide();
} 


function changlayout(){
	var id_op=$("#cat_id").val();
	var op="layout";
	var id_pro=$('#id_product').val();
	$.ajax({
		type:'get',
		url:'/ajax.php',
		data:{op:op,id:id_op,id_pro:id_pro},
		success:function(data11){
			$('#insert-data').html(data11);
		}
	})
}
function delete_value(ob){
	var id_check=$(ob).val();
	var id_pro=$('#id_product').val();
	var op="delete_option";
	$.ajax({
		type:'get',
		url:'/ajax.php',
		data:{op:op,id:id_check,id_pro:id_pro},
		success:function(data11){
		}
	})
}
// function AjaxSessionCustomer(ob){
//       var customerSession=$(ob).parents('.sessioncus').find('select.sesscus').val();
//       alert(customerSession);
//       $.ajax({
//           type:'get',
//           url:'/admin.php',
         
//           data:{customerSession:customerSession},
//           success:function(data){
//         }
//         })
// }
function Ajax_search_name(that) {
		var length = 1;
		var Tag_parent = $(that).parents('.parent_ajax');
    if($(Tag_parent).find('#result-user').children().length!=0){
      length = $(Tag_parent).find('#result-user .sid').length;  
    } 
    var fruits = [];
    var op="truongca";
    var id_op=$(that).val().trim();
    var user_group = $('#user_group :selected').val();
    if(id_op.length>=3){
      if($(Tag_parent).find('#result-user').children().length!=0){
      	$(Tag_parent).find('#result-user .sid').each(function(){
	        if(fruits.length <= length)
	          fruits.push($(this).children('input').val());
	      });
      // console.log(fruits);
    }
    // console.log(id_op);
    // console.log(user_group);
      $.ajax({
      type: "POST",
      url: "/ajax.php",
      data:{op:op,id_op:id_op,user_group:user_group,fruits:fruits},
      success: function(data){
        $(Tag_parent).find("#suggesstion-box").show();
        $(Tag_parent).find("#suggesstion-box").html(data);
        // $('.selectpicker10').selectpicker();
        // $('#suggesstion-box').find('.btn-group.bootstrap-select.10.medium').addClass('open').focus();
        // $('#suggesstion-box').find('button.btn.dropdown-toggle.btn-default').attr('aria-expanded','true');
        // $('#suggesstion-box').find('ul.dropdown-menu.inner').attr('aria-expanded','true');
        // $('#suggesstion-box').find('ul.dropdown-menu.inner').children().eq(0).addClass('selected active');
        // $('#search-npp').focusout();
      }
      });
    }
    else {
       $(Tag_parent).find("#suggesstion-box").hide();
    }
}
function addinput(){
	var data='<tr>';
		data=data+'<td colspan="3"><input style="text-align: left;" type="text" name="kichco[]" class="kichco"></td>';
		data=data+'<td ><input style="text-align: left;" type="text" name="chenhlech[]" class="chenhlech"></td>';
	data=data+'</tr>';
	$('.addcolsize').append(data);
}
function showinfooption(ob){
	var show=$(ob).data('show');
	if(show==true)
		$('.option-show').addClass('active-show');
	else
		$('.option-show').removeClass('active-show');
}
function MM_sortField(targ,osk,sk,sd){
  var url = document.location.href;
  url = url.replace('&sk='+osk,'');
  url = url.replace('&sk='+sk,'');
  url = url.replace('&sd=ASC','');
  url = url.replace('&sd=DESC','');
  url = url.replace('&ecode=','&code=');
  url = url.replace('&rcode=','&code=');
  eval(targ+".location='"+url+"&sk="+sk+"&sd="+sd+"'");
}
function xoaoption(ob){

	var name=$(ob).val();
	var op="size";
	var pid=$(ob).data('id');
	$.ajax({
		type:'get',
		url:'/ajax.php',
		data:{name:name,op:op,pid:pid},
		success:function(data11){
		}
	})

}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+document.location.href+'&ipp='+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_jump(targ,selObj,url) {
	document.getElementById(targ).src=url+selObj.options[selObj.selectedIndex].value;
}

function showFieldValueControl(selObj,id)
{
	if (selObj.options[selObj.selectedIndex].value == 4 || selObj.options[selObj.selectedIndex].value == 5 || selObj.options[selObj.selectedIndex].value == 6 || selObj.options[selObj.selectedIndex].value == 7) {
		document.getElementById(id).className = "";
	} else document.getElementById(id).className = "hidden";
}
function showFieldValueControl2(selObj)
{
	if (selObj.options[selObj.selectedIndex].value > 3) {
		document.getElementById('value_p').className = "";
		document.getElementById('value_wysiwyg_p').className = "hidden";
		document.getElementById('value_textarea_p').className = "hidden";
		document.getElementById('value_textbox_p').className = "hidden";
	} else if(selObj.options[selObj.selectedIndex].value == 3) {
		document.getElementById('value_p').className = "hidden";
		document.getElementById('value_wysiwyg_p').className = "";
		document.getElementById('value_textarea_p').className = "hidden";
		document.getElementById('value_textbox_p').className = "hidden";
	} else if(selObj.options[selObj.selectedIndex].value == 2) {
		document.getElementById('value_p').className = "hidden";
		document.getElementById('value_wysiwyg_p').className = "hidden";
		document.getElementById('value_textarea_p').className = "";
		document.getElementById('value_textbox_p').className = "hidden";
	} else {
		document.getElementById('value_p').className = "hidden";
		document.getElementById('value_wysiwyg_p').className = "hidden";
		document.getElementById('value_textarea_p').className = "hidden";
		document.getElementById('value_textbox_p').className = "";
	}
}

function showControl(id)
{
	document.getElementById(id).className = "";
}

// JavaScript Document
function checkSelect( ojSelect, text ) {
	var k ;
	for (k=ojSelect.options.length-1; k>=0; k--) {
		if (ojSelect.options(k).value == text) {
			ojSelect.options(k).selected = true;
			return true;			
		}
	}
	return false;
}


function checkValue( ojSelect, value ) {
	var k;
	for (k=ojSelect.options.length-1; k>=0; k--) {
		if (ojSelect.options(k).value == value) {
			ojSelect.options(k).selected = true;
			return true;			
		}
	}
	return false;
}

function checkRadio( ojSelect, value ) {
	var k;
	for (k=ojSelect.length-1; k>=0; k--) {
		if (ojSelect(k).value == value) {
			ojSelect(k).checked = true;
			return true;			
		}
	}
	return false;
}
function checkCheck( ojSelect, value ) {
	var k;
	if (ojSelect.value == value) {
		ojSelect.checked = true;
		return true;			
	}
	return false;
}
/* cach su dung 
<script language="javascript" >
	var oj = document['tenForm']['tenSelect'];
	checkSelect(oj,'{TinhTrang}');
</script>
*/

function toggleAllChecks(formName, prefix)
{
	n = "all";

    if (prefix)
    {
        n = prefix + n;
    }
    i = 0;
    e = document.getElementById(n);
    s = e.checked;
    f = document.getElementById(formName);

    while (e = f.elements[i])
    {
        if (e.type == "checkbox" && e.id != n)
        {
            if (!prefix || e.id.indexOf(prefix) != -1)
            {
                e.checked = s;
            }
        }

        i++;
    }
}

function toggleAllChecksPrefix(formName, prefix)
{
	n = "all";

    if (prefix)
    {
        n = prefix + '_' + n;
    }
    i = 0;
    e = document.getElementById(n);
    s = e.checked;
    f = document.getElementById(formName);

    while (e = f.elements[i])
    {
        if (e.type == "checkbox" && e.id != n)
        {
            if (e.id.indexOf(prefix) != -1)
            {
                e.checked = s;
            }
        }
        i++;
    }
}

function formSubmit(form, vmod, vdo, vid)
{
	//alert('hi');
	f = document.getElementById(form);
	f.mod.value = vmod;
	f.doo.value = vdo;
	f.id.value = vid;
	f.submit();
}

function activeSubmit(form)
{
	f = document.forms(form);
	f.plus.value="active";
	f.submit();
}

function activePlusSubmit(form,act)
{
	f = document.forms(form);
	f.plusAct.value=act;
	f.submit();
}

//Variables for addInput functions
var counter = 1;
var limit = 5;
function addInput(divName, fieldType,fieldName,fieldValue){
	if (counter == limit)  {
          alert("Bạn chỉ được quyền tải lên tối đa " + counter + " tập tin mỗi lần!");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<p><input type='"+fieldType+"' name='"+fieldName+"' id='"+fieldName+"' value='"+fieldValue+"'></p>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}



function formatCurrency(id) {
	var variable = document.getElementById(id);	
	num = variable.value.toString().replace(/\$|\,/g,"");
	if (isNaN(num)) num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num * 100 + 0.50000000001);
	cents = num % 100;
	num = Math.floor(num / 100).toString();
	if (cents < 10) cents = "0" + cents;
	var maxi = Math.floor((num.length -1)/3);
	for(var i=0; i<maxi; i++)
	num = num.substring(0, num.length - 4*i - 3) + ',' + num.substring(num.length - 4*i -3);
	variable.value=(sign?'':'-')+num+'.'+cents;
}

function showProgressBar( elementToHide )
{
   button = document.getElementById( elementToHide );
   button.style.display = "none";     
   bar = document.getElementById("status_bar");
   bar.style.display = "block";
}

/**
 * resets the user picture/avatar in the profile page
 */
function resetAvatarPicture()
{
    window.document.updateConfig.avatarId.value = 0;
    // and reload the image path
    window.document.updateConfig.avatarPicture.src = '/images/nophoto.gif';
}

function avatarPictureSelectWindow()
{
	width  = 500;
	height = 450;
	
	x = parseInt(screen.width / 2.0) - (width / 2.0);
	y = parseInt(screen.height / 2.0) - (height / 2.0);
	
	UserPicture = window.open( '?op=manage&act=compactListResource&objectId=Avatar', 'AvatarPictureSelect','top='+y+',left='+x+',scrollbars=yes,resizable=yes,toolbar=no,height='+height+',width='+width);
}
function returnAvatarResourceInformation(resId, url)
{
	// set the picture id
    parent.opener.document.updateConfig.avatarId.value = resId;
    // and reload the image path
    parent.opener.document.updateConfig.avatarPicture.src = url;
}

/**
 * resets the map picture in the profile page
 */
function resetMapPicture()
{
    window.document.updateMap.mapId.value = 0;
    // and reload the image path
    window.document.updateMap.mapPicture.src = '/images/nophoto.gif';
}

function mapPictureSelectWindow()
{
	width  = 500;
	height = 450;
	
	x = parseInt(screen.width / 2.0) - (width / 2.0);
	y = parseInt(screen.height / 2.0) - (height / 2.0);
	
	UserPicture = window.open( '?op=manage&act=compactListResource&objectId=Map', 'MapPictureSelect','top='+y+',left='+x+',scrollbars=yes,resizable=yes,toolbar=no,height='+height+',width='+width);
}
function returnMapResourceInformation(resId, url)
{
	// set the picture id
    parent.opener.document.updateMap.mapId.value = resId;
    // and reload the image path
    parent.opener.document.updateMap.mapPicture.src = url;
}

function actionSubmit(form,action)
{
f = document.getElementById(form);
f.plus.value=action;
}

function changePosition(form,id)
{
f = document.getElementById(form);
control = document.getElementById('position_'+id);
f.plus.value='changePosition';
f.cId.value=id;
f.position.value=control.value;
f.submit();
}
$(document).ready(function() {
	$('.accordion').find('.accordion-toggle').click(function() {
		$(this).next().slideToggle('1500');
		$(".accordion-content").not($(this).next()).slideUp('1500');
	});
	$('.accordion-toggle').on('click', function() {
		$(this).toggleClass('active').siblings().removeClass('active');
	});
});
function Ajax_search_customer102(id) {
		var op="khachhang";
		var parent = $(id).parents('.search_customer_parent');
		var ten_customer=$(parent).find('input#name_customer').val();
		if(ten_customer.length >=3){
			$.ajax({
			type: "POST",
			url: "/ajax.php",
			data:{op:op,ten_customer:ten_customer},
			success: function(data){
			$(parent).find("#result-ct").show();
			$(parent).find("#result-ct").html(data);
			}
			});
		} else {
			$(parent).find("#result-ct").hide();
		}
	}