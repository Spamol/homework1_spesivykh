jQuery( document ).ready(function( $ ) {
	//Ф-ция отбрезание длинной строки и добавление многоточия
	var cutStr = function(elem,length){
		$(elem).each(function(indx, element){
			var elemStr = $(element).text();
			if(elemStr.length > length){
				$(element).text(elemStr.slice(0, length-1)+'...');
			}
		});
	}
	var elem = $(".project").find(".nameProject").children("div").children("a");
	cutStr(elem,22);
	var elem2 = $(".project").find(".deskProject");
	cutStr(elem2,46);

	//открытие меню для мобильной версии
	$('.openMobileMenu').click(function (e){
		if ($('.mainMenu:visible').length > 0) {
			$('.mainMenu').fadeOut();
		}else{
			$('.mainMenu').fadeIn();
		}
	});
	$(document).click(function (e) {
		if(e.target.className == 'openMobileMenu' || $('.openMobileMenu:hidden').length > 0) { 
		}else{
  			$('.mainMenu').fadeOut();
  		}
	});

	//переключатель активной ссылки
	var path = window.location.pathname;
    path = path.split('/');
    if(path[path.length-1]){
    	$('.mainMenu').children('.active').removeClass('active');
    	$('.mainMenu').children('#'+path[path.length-1]+'').addClass('active');
    }else{
    	$('.mainMenu').children('.active').removeClass('active');
    	$('.mainMenu').children('#about').addClass('active');
    }
    //ajax форма
    var options = { 
	    target:     '#respServer',
	    url:        'feedback.php',
	    success:    function(responseText,statusText,xhr,jquery) { 
    		if(responseText == 'Сообщение отправлено, спасибо!'){
	      		$("#respServer").addClass('green');
	    	}  
	      $("#respServer").fadeIn();
	    } 
	}; 
    $('#formFeedback').ajaxForm(options);
    //валидация формы на клиенте
    $("#formFeedback").validate({
       rules:{
            name:{
                required: true
            },
            email:{
                required: true,
                email:	true
            },
			mess:{
                required: true,
                minlength: 5
            },
       },
       messages:{

            name:{
                required: "Заполните имя"
            },
            email:{
                required: "Заполните Email",
                email: "Неверный Email",
            },
			mess:{
                required: "Заполните сообщение",
                minlength: "Мин. 5 символов"
            },
       }
    });
});
