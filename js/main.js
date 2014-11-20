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
	var elem = $(".project").find(".nameProject").children("div").children("span");
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
                $("label.error").hide();
                $("input.valid").add("textarea.valid").val('');
                $("#respServer").fadeIn();
                setTimeout(function(){
                    $("#respServer").fadeOut();
                }, 3000);
	    	} 
            if(responseText == 'Проверочный код введен неверно!'){
                $(".captchaInput").append("<label class='error'>Невереный код</label>");
            }  
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
            keystring:{
                required: true
            }
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
            keystring:{
                required: "Заполните код"
            }
       }
    });
    $("#formaAddWork").validate({
       rules:{
            titleWork:{
                required: true
            },
            picWork:{
                required: true
            },
            urlWork:{
                required: true
            },
            descWork:{
                required: true
            }
       },
       messages:{

            titleWork:{
                required: "Заполните название"
            },
            picWork:{
                required: "Загрузите картинку"
            },
            urlWork:{
                required: "Укажите ссылку"
            },
            descWork:{
                required: "Опишите проект"
            }
       }
    });
    $(".clearFeedback").click(function(){
        $("label.error").hide();
    })

    $('#openPopup').click(function(){
        $('.popupLayout').fadeIn();
    });
    $('#closePopup').click(function(){
        $('.popupAddWork label.error').fadeOut();
        $('.popupLayout').fadeOut();
    });
});
