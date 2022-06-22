<?php
/**
 * @author Fudio101
 * Date: 20/06/2022
 * Time: 22:37
 */
?>

@extends('layouts._main')

@section('top-custom')
    <!-- breadcrumb-section -->
    @if(isset($secondTitle) && isset($title))
        <div class="breadcrumb-section breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="breadcrumb-text">
                            <p>{{$secondTitle}}</p>
                            <h1>{{$title}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- end breadcrumb section -->
@endsection
