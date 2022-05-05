<div class="footer">
    <div class="footer-hearder">
        <div class="grid wide">
            <div class="row sm-gutter">
                <div class="col l-3 m-12 c-12 container-shoping__culum-75">
                    <div class="footer-hearder__list">
                        <p class="footer-hearder__span-p">
                           Staskoverflow19 – Kênh mua sắm đồ công nghệ cao cấp
                        </p>
                        <p class="footer-hearder__span-p">
                            Địa chỉ: 556/191 Nguyễn thái sơn, Phường 5, Gò Vấp.
                        </p>
                        <span class="footer-hearder__span footer-hearder__span-h2">
                            Hotline 1: 0999999999
                        </span>
                        <span class="footer-hearder__span footer-hearder__span-h2">
                            CSKH: 0999999999
                        </span>
                        <p class="footer-hearder__span-p">
                            Copyright © 2016 Staskoverflow19
                        </p>
                    </div>
                </div>
                <div class="col l-3 m-12 c-12 container-shoping__culum-75">
                    <div class="footer-hearder__list">
                        <h2>HỖ TRỢ KHÁCH HÀNG</h2>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Câu hỏi thường gặp (FAQ)
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Hướng dẫn mua hàng
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Chính sách giao hàng
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Chính sách bảo hành
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Điều khoản bảo mật
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col l-3 m-12 c-12 container-shoping__culum-75">
                    <div class="footer-hearder__list">
                        <p class="footer-hearder__list-noti">
                            (Phản hồi trong thời gian sớm nhất)
                        </p>
                        <h2>VỀ  Staskoverflow19</h2>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Giới thiệu về  Staskoverflow19
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Quy trình tư vấn
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Ưu đãi khách hàng thân thiết
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Sản phẩm ở  Staskoverflow19
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Vì sao chọn  Staskoverflow19?
                            </a>
                        </span>
                        <span class="footer-hearder__span">
                            <a href="#" class="footer-hearder__link">
                                Tuyển dụng
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col l-3 m-12 c-12 container-shoping__culum-75">
                    <div class="footer-hearder__list">
                        <div class="footer-hearder__flex">
                            <a href="#" class="footer-hearder__flex-link">
                                <i class="hearder-top-icon footer-hearder__flex-icon fab fa-facebook"></i>
                            </a>
                            <a href="#" class="footer-hearder__flex-link">
                                <i class="hearder-top-icon footer-hearder__flex-icon fab fa-instagram"></i>
                            </a>
                            <a href="#" class="footer-hearder__flex-link">
                                <i class="hearder-top-icon footer-hearder__flex-icon fab fa-twitter"></i>
                            </a>
                            <a href="#" class="footer-hearder__flex-link">
                                <i class="hearder-top-icon footer-hearder__flex-icon fas fa-envelope"></i>
                            </a>
                            <a href="#" class="footer-hearder__flex-link footer-hearder__flex-red">
                                <i class="hearder-top-icon footer-hearder__flex-icon fab fa-youtube"></i>
                            </a>
                        </div>
                        <p class="footer-hearder__span-p">
                            Được chứng nhận
                        </p>
                        <a href="#" class="footer-hearder__flex-list-link">
                            <img src="<?= $baseUrl ?>assets/images/anh7.png" alt="" class="footer-hearder__flex-list-img">
                        </a>
                        <p class="footer-hearder__span-p">
                            Cách thức thanh toán
                        </p>
                        <div class="footer-hearder__flex">
                            <a href="#" class="footer-hearder__flex-link-pay">
                                <i class="hearder-top-icon footer-hearder__flex-icon-pay fab fa-cc-visa"></i>
                            </a>
                            <a href="#" class="footer-hearder__flex-link-pay">
                                <i class="hearder-top-icon footer-hearder__flex-icon-pay fab fa-cc-paypal"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="footer-hearder__footer footer-hearder__span-p">
                Copyright 2021 © | Giao diện web đẹp | Staskoverflow19
            </p>
        </div>
    </div>
</div>

<div class="backtop">
    <i class="backtop-icon fas fa-angle-up"></i>
</div>

<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop()) {
                $('.backtop').fadeIn();
            } else {
                $('.backtop').fadeOut();
            }
        });
        $(".backtop").click(function() {
            $('html,body').animate({
                scrollTop: 0
            }, 50);
        })
    });

    var clickMenu = document.querySelector('.js-menu__icon');
    var clickDelete = document.querySelector('.js-hearder-modal');
    var stopPropaga = document.querySelector('.js-list__menu');
    var clickIcon = document.querySelector('.js-icon__times');
    clickMenu.onclick = function() {
        clickDelete.classList.add('open');
    }
    clickIcon.onclick = function() {
        clickDelete.classList.remove('open');
    }
    clickDelete.onclick = function() {
        clickDelete.classList.remove('open');
    }
    stopPropaga.onclick = function(event) {
        event.stopPropagation();
    }
</script>
