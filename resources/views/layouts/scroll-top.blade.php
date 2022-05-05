<?php
/**
 * @author Fudio101
 * Date: 04/05/2022
 * Time: 14:09
 */
?>

<div class="backtop">
    <i class="backtop-icon fas fa-angle-up"></i>
</div>

<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop()) {
                $('.backtop').fadeIn();
            } else {
                $('.backtop').fadeOut();
            }
        });
        $(".backtop").click(function () {
            $('html,body').animate({
                scrollTop: 0
            }, 50);
        })
    });

    var clickMenu = document.querySelector('.js-menu__icon');
    var clickDelete = document.querySelector('.js-hearder-modal');
    var stopPropaga = document.querySelector('.js-list__menu');
    var clickIcon = document.querySelector('.js-icon__times');
    clickMenu.onclick = function () {
        clickDelete.classList.add('open');
    }
    clickIcon.onclick = function () {
        clickDelete.classList.remove('open');
    }
    clickDelete.onclick = function () {
        clickDelete.classList.remove('open');
    }
    stopPropaga.onclick = function (event) {
        event.stopPropagation();
    }
</script>
