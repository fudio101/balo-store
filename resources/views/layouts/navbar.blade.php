<?php
/**
 * @author Fudio101
 * Date: 04/05/2022
 * Time: 14:04
 */
?>

<div class="hearder-from hearder-modal js-hearder-modal">
    <div class="hearder-modal__over">
        <i class="hearder-modal__over-time fas fa-times js-icon__times"></i>
    </div>
    <ul class="hearder-footer__list hearder-footer__list-culumn hearder-modal-footer js-list__menu">
        <li class="hearder-footer__link hearder-footer__menu-seach">
            <img src="{{'?= $baseUrl ?'}}assets/images/logo.png" alt="">
        </li>
        <li class="hearder-footer__link hearder-footer__menu ">
            <a href="{{'?= $baseUrl ?'}}index.html" class="hearder-footer__href hearder-footer__black">
                Trang chủ
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu hearder-footer__link-href hearder-footer__link-focus">
            <span href="{{'?= $baseUrl ?'}}sanpham1.html" class="hearder-footer__href hearder-footer__menu-prodct">
                Sản phẩm
                <i class="hearder-footer__href-icon fas fa-angle-down"></i>
            </span>
            <ul class="hearder-footer__sugget-list hearder-footer__menu-cart hearder-footer__menu-cart-product">

                @foreach ($categories as $key => $item)
                    <a href="{{route('category',$item->id)}}" class="hearder-footer__sugget-link">
                        <li class="hearder-footer__sugget-li">{{$item->name}}</li>
                    </a>
                @endforeach

            </ul>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Phụ kiện
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Tin tức
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Liên hệ
            </a>
        </li>
    </ul>
</div>

