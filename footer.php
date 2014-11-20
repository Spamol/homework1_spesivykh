<?php session_start(); ?>
<footer>
    <script>
    function getName (str){
        if (str.lastIndexOf('\\')){
            var i = str.lastIndexOf('\\')+1;
        }
        else{
            var i = str.lastIndexOf('/')+1;
        }                       
        var filename = str.slice(i);            
        var uploaded = document.getElementById("fileformlabel");
        uploaded.innerHTML = filename;
    }
    </script>
    <div class="wrapSmall">&copy; 2014. Это мой сайт, пожалуйста, не копируйте и не воруйте его=)</div>
    <div class="gradient"></div>
</footer>
<div class="openMobileMenu">&nbsp;</div>
<?php if(isset($_SESSION["is_auth"])){ ?>
<div class="popupLayout" id="openPopupAddWork">
    <div class="popupAddWork">
        <div class="popupHead">Добавление проекта</div>
        <form action="upload.php" method="POST" id="formaAddWork" enctype="multipart/form-data">
            <div class="inputWrap">
                <p><label for="titleWork">Название проекта</label></p>
                <p><input type="text" name="titleWork" id="titleWork" placeholder="Введите название"></p>
            </div>
            <div class="inputWrap picWork">
                <p><label for="files">Картинка проекта</label></p>
                <div class="fileform">
                    <div id="fileformlabel">Загрузите изображение</div>
                    <div class="selectbutton"></div>
                    <input id="upload" type="file" name="files" onchange="getName(this.value);" />
                </div>
            </div>
            <div class="inputWrap">
                <label for="urlWork">URL проекта</label>
                <p><input type="text" name="urlWork" id="urlWork" placeholder="Добавьте ссылку"></p>
            </div>
            <div class="inputWrap">
                <label for="descWork">Описание</label>
                <p><textarea name="descWork" id="descWork" placeholder="Пара слов о Вашем проекте"></textarea></p>
            </div>
            <div class="wrapSubmit">
                <input type="submit" value="Добавить" class="submitAddWork">
                <p class="answerServ">Ошибка</p>
            </div>
        </form>
        <div id="closePopup"></div>
    </div>
</div>
<?php } ?>

<script src="js/vendor/jquery-1.11.1.min.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
        <script>//window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/vendor/jquery.form.min.js"></script>
        <script src="js/vendor/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
            <script src="js/vendor/jquery.placeholder.js"></script>
            <script>
                $(function() { $('input, textarea').placeholder();});
            </script>
    </body>
</html>