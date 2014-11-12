<?php
    session_start();
    include "header.php";
?>
            <div class="wrapSmall">
                <div class="mainContent">
                    <section>
                        <h1 class="blueTitle">У вас интересный проект? Напишите мне</h1>
                        <form action="feedback.php" method="post" class="feedback" id="formFeedback">
                            <div class="wrapInputs">
                                <div class="nameFeedback blockFloat wrapInput">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" placeholder="Как к Вам обращаться">
                                </div>
                                <div class="blockFloat wrapInput">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" placeholder="Куда мне писать">
                                </div>
                            </div>
                            <div class="wrapTextarea">
                                <label for="mess">Сообщение</label>
                                <textarea name="mess" id="messFeedback" placeholder="Кратко в чем суть"></textarea>
                            </div>
                            <div class="captcha">
                                <label for="keystring">Введите код указанный на картинке</label>
                                <div class="captchaCode blockFloat"><img src="./kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>"></div>
                                <div class="blockFloat captchaInput">
                                    <input type="text" name="keystring" placeholder="Введите код">
                                </div>
                            </div>
                            <div class="wrapInput">
                                <input type="submit" class="submitFeedback" value="Отправить">
                                <input type="reset" class="clearFeedback" value="Очистить">
                                <label id="respServer"></label>
                            </div>
                        </form>
                    </section>
                </div>
                <?php
                    include "nav.php";
                    include "footer.php";
                ?>
