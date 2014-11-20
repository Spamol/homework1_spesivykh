<?php 
    session_start();
    include "header.php"; ?>
<?php include "config.php"; ?>
            <div class="wrapSmall">
                <div class="mainContent">
                    <section>
                        <h1><span>Мои работы</span></h1>
                        <div class="projects">
                            <?php
                            $pdo = connectToDB();
                            $res = getDataAsArray($pdo, $data_sql['getWorks']);
                            foreach ($res as $item):
                            ?>
                            <div class="project">
                                <div class="picProject">
                                    <img src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>">
                                    <a href="<?php echo $item['url'] ?>" class="nameProject">
                                        <div>
                                            <span><?php echo $item['title'] ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="linkProject"><a href="<?php echo $item['url'] ?>"><?php echo $item['url'] ?></a></div>
                                <div class="deskProject"><?php echo $item['description'] ?></div>
                            </div>

                            <?php endforeach;
                            if(isset($_SESSION["is_auth"])){ ?>
                            <div class="project">
                                <div class="picProject addProject">
                                    <a href="#" id="openPopup">Добавить проект</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </section>
                </div>
        <?php include "nav.php"; ?>
        <?php include "footer.php"; ?>