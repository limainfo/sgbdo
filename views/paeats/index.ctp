<pre><?php

                        ?></pre>
<div class="periodicidades index" style='float:center;top:0px;position:relative;background-color:#fff;'>
    <table cellpadding="0" cellspacing="0" align="center">
        <tr><td> 
                <h2><p align="center" style="font-weight:bold;font-family:arial;font-size:0.8em;">
                        DIVISÃO DE OPERAÇÕES<BR>
                        INDICAÇÃO PARA CURSOS
                        <!-- <img border="0" onclick="gerabroffice(0);" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/broffice.png"> -->
                    <style>
                        body { 
                            background: #555;
                        }

                        h1 {
                            color: #eee;
                            font: 30px Arial, sans-serif;
                            -webkit-font-smoothing: antialiased;
                            text-shadow: 0px 1px black;
                            text-align: center;
                            margin-bottom: 50px;
                        }

                        input[type=checkbox] {
                            visibility: hidden;
                        }

                        /* SLIDE ONE */
                        .slideOne {
                            width: 50px;
                            height: 10px;
                            background: #333;
                            margin: 20px auto;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            position: relative;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                        }

                        .slideOne label {
                            display: block;
                            width: 16px;
                            height: 16px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;

                            -webkit-transition: all .4s ease;
                            -moz-transition: all .4s ease;
                            -o-transition: all .4s ease;
                            -ms-transition: all .4s ease;
                            transition: all .4s ease;
                            cursor: pointer;
                            position: absolute;
                            top: -3px;
                            left: -3px;

                            -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                        }

                        .slideOne input[type=checkbox]:checked + label {
                            left: 37px;
                        }

                        /* SLIDE TWO */
                        .slideTwo {
                            width: 80px;
                            height: 30px;
                            background: #333;
                            margin: 20px auto;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            position: relative;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                        }

                        .slideTwo:after {
                            content: '';
                            position: absolute;
                            top: 14px;
                            left: 14px;
                            height: 2px;
                            width: 52px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            background: #111;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                        }

                        .slideTwo label {
                            display: block;
                            width: 22px;
                            height: 22px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;

                            -webkit-transition: all .4s ease;
                            -moz-transition: all .4s ease;
                            -o-transition: all .4s ease;
                            -ms-transition: all .4s ease;
                            transition: all .4s ease;
                            cursor: pointer;
                            position: absolute;
                            top: 4px;
                            z-index: 1;
                            left: 4px;

                            -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                        }

                        .slideTwo label:after {
                            content: '';
                            position: absolute;
                            width: 10px;
                            height: 10px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            background: #333;
                            left: 6px;
                            top: 6px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,1), 0px 1px 0px rgba(255,255,255,0.9);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,1), 0px 1px 0px rgba(255,255,255,0.9);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,1), 0px 1px 0px rgba(255,255,255,0.9);
                        }

                        .slideTwo input[type=checkbox]:checked + label {
                            left: 54px;
                        }

                        .slideTwo input[type=checkbox]:checked + label:after {
                            background: #00bf00;
                        }

                        /* SLIDE THREE */
                        .slideThree {
                            width: 80px;
                            height: 26px;
                            background: #333;
                            margin: 20px auto;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            position: relative;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
                        }

                        .slideThree:after {
                            content: 'OFF';
                            font: 12px/26px Arial, sans-serif;
                            color: #000;
                            position: absolute;
                            right: 10px;
                            z-index: 0;
                            font-weight: bold;
                            text-shadow: 1px 1px 0px rgba(255,255,255,.15);
                        }

                        .slideThree:before {
                            content: 'ON';
                            font: 12px/26px Arial, sans-serif;
                            color: #00bf00;
                            position: absolute;
                            left: 10px;
                            z-index: 0;
                            font-weight: bold;
                        }

                        .slideThree label {
                            display: block;
                            width: 34px;
                            height: 20px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;

                            -webkit-transition: all .4s ease;
                            -moz-transition: all .4s ease;
                            -o-transition: all .4s ease;
                            -ms-transition: all .4s ease;
                            transition: all .4s ease;
                            cursor: pointer;
                            position: absolute;
                            top: 3px;
                            left: 3px;
                            z-index: 1;

                            -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                        }

                        .slideThree input[type=checkbox]:checked + label {
                            left: 43px;
                        }

                        /* ROUNDED ONE */
                        .roundedOne {
                            width: 28px;
                            height: 28px;
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                            margin: 20px auto;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            position: relative;
                        }

                        .roundedOne label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 20px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            left: 4px;
                            top: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);

                            background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -o-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
                            background: linear-gradient(top, #222 0%, #45484d 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
                        }

                        .roundedOne label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 16px;
                            height: 16px;
                            background: #00bf00;

                            background: -webkit-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -moz-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -o-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -ms-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: linear-gradient(top, #00bf00 0%, #009400 100%);

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            top: 2px;
                            left: 2px;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                        }

                        .roundedOne label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.3;
                        }

                        .roundedOne input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }

                        /* ROUNDED TWO */
                        .roundedTwo {
                            width: 28px;
                            height: 28px;
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                            margin: 20px auto;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            position: relative;
                        }

                        .roundedTwo label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 20px;

                            -webkit-border-radius: 50px;
                            -moz-border-radius: 50px;
                            border-radius: 50px;
                            left: 4px;
                            top: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);

                            background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -o-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
                            background: linear-gradient(top, #222 0%, #45484d 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
                        }

                        .roundedTwo label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 9px;
                            height: 5px;
                            background: transparent;
                            top: 5px;
                            left: 4px;
                            border: 3px solid #fcfff4;
                            border-top: none;
                            border-right: none;

                            -webkit-transform: rotate(-45deg);
                            -moz-transform: rotate(-45deg);
                            -o-transform: rotate(-45deg);
                            -ms-transform: rotate(-45deg);
                            transform: rotate(-45deg);
                        }

                        .roundedTwo label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.3;
                        }

                        .roundedTwo input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }

                        /* SQUARED ONE */
                        .squaredOne {
                            width: 28px;
                            height: 28px;
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                            margin: 20px auto;
                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            position: relative;
                        }

                        .squaredOne label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 20px;
                            left: 4px;
                            top: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);

                            background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -o-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
                            background: linear-gradient(top, #222 0%, #45484d 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
                        }

                        .squaredOne label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 16px;
                            height: 16px;
                            background: #00bf00;

                            background: -webkit-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -moz-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -o-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: -ms-linear-gradient(top, #00bf00 0%, #009400 100%);
                            background: linear-gradient(top, #00bf00 0%, #009400 100%);

                            top: 2px;
                            left: 2px;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                        }

                        .squaredOne label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.3;
                        }

                        .squaredOne input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }

                        /* SQUARED TWO */
                        .squaredTwo {
                            width: 28px;
                            height: 28px;
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                            margin: 20px auto;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            position: relative;
                        }

                        .squaredTwo label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 20px;
                            left: 4px;
                            top: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);

                            background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -o-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
                            background: linear-gradient(top, #222 0%, #45484d 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
                        }

                        .squaredTwo label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 9px;
                            height: 5px;
                            background: transparent;
                            top: 4px;
                            left: 4px;
                            border: 3px solid #fcfff4;
                            border-top: none;
                            border-right: none;

                            -webkit-transform: rotate(-45deg);
                            -moz-transform: rotate(-45deg);
                            -o-transform: rotate(-45deg);
                            -ms-transform: rotate(-45deg);
                            transform: rotate(-45deg);
                        }

                        .squaredTwo label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.3;
                        }

                        .squaredTwo input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }


                        /* SQUARED THREE */
                        .squaredThree {
                            width: 20px;	
                            margin: auto;
                            position: relative;
                        }

                        .squaredThree label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 14px;
                            top: 0;
                            border-radius: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);
                            -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);
                            box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);

                            background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -o-linear-gradient(top, #222 0%, #45484d 100%);
                            background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
                            background: linear-gradient(top, #222 0%, #45484d 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
                        }

                        .squaredThree label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 9px;
                            height: 5px;
                            background: transparent;
                            top: 4px;
                            left: 4px;
                            border: 3px solid #fcfff4;
                            border-top: none;
                            border-right: none;

                            -webkit-transform: rotate(-45deg);
                            -moz-transform: rotate(-45deg);
                            -o-transform: rotate(-45deg);
                            -ms-transform: rotate(-45deg);
                            transform: rotate(-45deg);
                        }
                        .squaredThree label {
                            width:22px;
                        }
                        .squaredThree label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.3;
                        }

                        .squaredThree input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }

                        /* SQUARED FOUR */
                        .squaredFour {
                            width: 20px;	
                            margin: auto;
                            position: relative;
                        }

                        .squaredFour label {
                            cursor: pointer;
                            position: absolute;
                            width: 20px;
                            height: 10px;
                            top: 0;
                            border-radius: 4px;

                            -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                            background: #fcfff4;

                            background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
                        }

                        .squaredFour label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                            filter: alpha(opacity=0);
                            opacity: 0;
                            content: '';
                            position: absolute;
                            width: 9px;
                            height: 5px;
                            background: transparent;
                            top: 4px;
                            left: 4px;
                            border: 3px solid #333;
                            border-top: none;
                            border-right: none;

                            -webkit-transform: rotate(-45deg);
                            -moz-transform: rotate(-45deg);
                            -o-transform: rotate(-45deg);
                            -ms-transform: rotate(-45deg);
                            transform: rotate(-45deg);
                        }

                        .squaredFour label:hover::after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
                            filter: alpha(opacity=30);
                            opacity: 0.5;
                        }

                        .squaredFour input[type=checkbox]:checked + label:after {
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                            filter: alpha(opacity=100);
                            opacity: 1;
                        }    
                        #wrapper label {
                            width:22px;
                        }

                    </style>
                    </p>
            </td>
            <td width="20%"> 
                <table border="1">
                    <tr>
                        <td colspan="4"><center><b><u>LEGENDAS</u></b></center></td>
        </tr>
        <tr>
            <td width="10px" border='1'  style="background-color:#FFFF00;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>PROSIMA</b>
            </td>

            <td width="10px" border='1'  style="background-color:#FFFFFF;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>PAEAT</b>
            </td>
        </tr>
        <tr>
            <td width="10px" border='1'  style="background-color:#FF8C00;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>ADIADO</b>
            </td>

            <td width="10px" border='1'  style="background-color:#FF0000;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>CANCELADO</b>
            </td>
        </tr>
        <tr>
            <td width="10px" border='1'  style="background-color:#CFCFCF;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>ARQUIVADO</b>
            </td>

            <td width="10px" border='1'  style="background-color:#A52A2A;border: 2px solid #000000;">
                &nbsp;
            </td>
            <td>
                <b>SEM INDICAÇÃO</b>
            </td>
        </tr>
    </table>
</td><tr><td colspan="2">
        </h2>
        <?php
//print_r($paeats);
//iconv('UTF-8','ISO-8859-1',
//print_r($pams);
        $u = $this->Session->read('Usuario');
        $iniciocurso = '2010-01-25 23:59';
        $datainiciocurso = strtotime($iniciocurso);
        $datahoje = strtotime(date('Y-m-d'));
        $limitesetor = strtotime($iniciocurso . ' -10 days');
        $prazosetores = "";
        $statusoplac = "";
        $statussetor = "";

        $intervalosetor01 = $datahoje - $datainiciocurso;
        if ($intervalosetor01 <= 0) {
            $prazosetores = 'laranja';
        } else {
            $prazosetores = 'vermelho';
        }

        $intervalosetor01 = $datahoje - $limitesetor;
        if ($intervalosetor01 < 0) {
            $prazosetores = 'verde';
        }

        $bloqueio = 0;
        if (($u[0]['Usuario']['privilegio_id'] == 6) || ($u[0]['Usuario']['privilegio_id'] == 12)) {
            $exibe = array('prazosetores' => 1, 'prazooplac' => 0, 'ano' => 1, 'indicacao' => 0, 'indicacaosetor' => 1, 'codcurso' => 1, 'vagas' => 1, 'local' => 1, 'turma' => 1, 'inicio' => 1, 'fim' => 1, 'observacoes' => 1, 'ativado' => 1, 'status_atual' => 1, 'ativado' => 1, 'conclusao' => 1, 'codplano' => 1, 'semhotel' => 1, 'local2' => 1, 'inicio2' => 1, 'fim2' => 1, 'local3' => 1, 'inicio3' => 1, 'fim3' => 1, 'vagasreserva' => 1, 'avisos' => 1);
            if ($prazosetores == 'vermelho') {
                $bloqueio = 1;
            }
        }
        if (($u[0]['Usuario']['privilegio_id'] == 1)  ) {
            $exibe = array('prazosetores' => 1, 'prazooplac' => 1, 'ano' => 1, 'indicacao' => 1, 'indicacaosetor' => 1, 'codcurso' => 1, 'vagas' => 1, 'local' => 1, 'turma' => 1, 'inicio' => 1, 'fim' => 1, 'observacoes' => 1, 'ativado' => 1, 'status_atual' => 1, 'ativado' => 1, 'conclusao' => 1, 'codplano' => 1, 'semhotel' => 1, 'local2' => 1, 'inicio2' => 1, 'fim2' => 1, 'local3' => 1, 'inicio3' => 1, 'fim3' => 1, 'vagasreserva' => 1, 'avisos' => 1);
            $bloqueio = 0;
        }

        $fundo = '#fff';

        //echo 'limitesetor='.$limitesetor.' statussetor='.$statussetor.' datahoje='.$datahoje.' datainiciocurso='.$datainiciocurso.' intervalosetor01='.$intervalosetor01;
//echo '  data:'.date('d-m-Y',$datahoje);
        ?>

        <table cellpadding="0" cellspacing="0"  width="100%">
            <tr><th  bgcolor="#608060" >
            <div style="position: relative;text-align:center;width:100%; border-style: solid; background-color: white; padding: 0px; border: 2px solid rgb(0, 0, 0); z-index: 10">
                <p style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">
                    <?php
                    echo $form->create('Paeat', array('action' => 'index', 'inputDefaults' => array('label' => false, 'div' => false)));
                    $anoatual = date('Y');
                    $anoatual += 2;
                    for($anoini=$anoatual-3;$anoini<=$anoatual;$anoini++){
                    	$vetorano[$anoini]=$anoini;
                    }
                    echo 'PAEAT' . $form->select('ano', $vetorano, $this->data['Paeat']['ano'], array('class' => 'formulario', 'id' => 'PaeatAnoConsulta'), false);
                    echo $form->end(array('label' => 'Selecionar', 'class' => 'botoes', 'div' => false));
                    ?>

                </p></div>
            </th>
<?php if (!$bloqueio) { ?>
                <th width="30px" id="novopaeat"  style="background-color:#fff;" onclick="ShowContent('acrescentapaeat');
            $('PaeatExternocadastropaeatForm').reset();
            alteraPaeat(0, 'INSERIR');" onmouseover="$('novopaeat').setStyle({backgroundColor: '#fff'});" onmouseout="$('novopaeat').setStyle({backgroundColor: '<?php echo $fundo; ?>'});"><a href="#">&nbsp;&nbsp;&nbsp;<img style="float:right;" width="40px" height="40px" title="Cadastrar novo curso" border="0"  src="<?php echo $this->webroot . 'img/novodoc.png'; ?>">&nbsp;&nbsp;&nbsp;</a></th>
            <?php } else { ?>
                <th width="30px" id="novopaeat"  ></th>
                    <?php } ?>
</tr>
<tr>
    <td colspan="2">
<?php
$soma = 0;
$rodape = '#c0b0a0';
$cabecalho = '#f0f0f0';
$altura = '<img border="0"  src="' . $this->webroot . 'img/altura.png">';
?>
        <!-- Coluna Gestores -->
        <table cellpadding="0" cellspacing="0" border="1" width="100%">

<?php
$i = 0;
$arquivados = 0;
foreach ($paeats as $paeat):
    //$class = null;
    $ltitulo = '';
    $laluno1 = '';
    $laluno2 = '';
    $linstrutor1 = '';
    $linstrutor2 = '';
    $paeatID = $paeat['Paeat']['id'];
    if ($paeat['Paeat']['status'] == 'ATIVO') {
        $ltitulo = 'FFFFFF';
        $laluno1 = 'EFF5FB';
        $laluno2 = 'FAFAFA';
        $linstrutor1 = 'D8D8D8';
        $linstrutor2 = 'E6E6E6';
    }

    if ($paeat['Paeat']['subtipo'] == 'PROSIMA') {
        $ltitulo = 'FFFF00';
        $laluno1 = 'F3F781';
        $laluno2 = 'F2F5A9';
        $linstrutor1 = 'F4FA58';
        $linstrutor2 = 'F7FE2E';
    }

    if ($paeat['Paeat']['status'] == 'ADIADO') {
        $ltitulo = 'FF8000';
        $laluno1 = 'F5D0A9';
        $laluno2 = 'F6E3CE';
        $linstrutor1 = 'F7D358';
        $linstrutor2 = 'F5DA81';
    }

    $class = ' style="background-color:#fff;" ';
    $i++;

    $classcurso = ' style="background-color:#f0f0f0;" ';


    if ($paeat['Paeat']['status'] == 'CANCELADO') {
        $ltitulo = 'FF0000';
        $laluno1 = 'F7BE81';
        $laluno2 = 'F5D0A9';
        $linstrutor1 = 'FE2E2E';
        $linstrutor2 = 'FA5858';
    }

    if ($paeat['Paeat']['status'] == 'SEM INDICAÇÃO') {
        $ltitulo = '6E000B';
        $laluno1 = '785357';
        $laluno2 = '796265';
        $linstrutor1 = '773239';
        $linstrutor2 = '773F45';
    }

    if ($paeat['Paeat']['arquivado'] == 1) {
        $ltitulo = '6E6E6E';
        $laluno1 = 'BDBDBD';
        $laluno2 = 'D8D8D8';
        $linstrutor1 = '848484';
        $linstrutor2 = 'A4A4A4';
        $arquivados++;
    }
    if ($arquivados == 1) {
        echo '<tr><td colspan="14" style="background-color:#585858;font-size:25px;text-align:center;font-weight:bold;">CURSOS Jí ARQUIVADOS<br><br></td></tr>';
    }
    ?>
                <tr  <?php echo "bgcolor=\"$cabecalho\""; ?>>
                <?php if ($exibe['prazosetores']) { ?>
                        <th><?php __('Prazo Setores'); ?></th>
                <?php } ?>
                    <?php if ($exibe['prazooplac']) { ?>
                        <th><?php __('Prazo OPG'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['indicacao']) { ?>
                        <th><?php __('DT_Limite_SGC'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['codcurso']) { ?>
                        <th><?php __('Curso'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['vagas']) { ?>
                        <th><?php __('Vagas'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['local']) { ?>
                        <th><?php __('Local'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['turma']) { ?>
                        <th><?php __('Turma'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['inicio']) { ?>
                        <th><?php __('DT_Iní­cio'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['fim']) { ?>
                        <th><?php __('DT_Término'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['observacoes']) { ?>
                        <th><?php __('OBS'); ?></th>
                    <?php } ?>
                    <?php if ($exibe['avisos']) { ?>
                        <th><?php __('Avisos'); ?></th>
                    <?php } ?>
                    <th colspan="6">Ações</th>
                </tr>

                <tr <?php echo $class; ?>>
    <?php
    $class = ' style="background-color:#' . $ltitulo . ';"'; //9dd3cc		
    if ($exibe['prazosetores']) {
        ?>
                        <td <?php echo $class; ?>>
                        <?php
                        $iniciocurso = $paeat['Paeat']['indicacao'];
                        $datahoje = strtotime("now");
                        $limitesetor = strtotime($iniciocurso.' -24 days');
                        
                        $dateLimite = new DateTime(date('Y-m-d',$limitesetor));     
                        $dateHoje = new DateTime(date('Y-m-d'));     

                        if (($dateHoje < $dateLimite)) {
                            $prazosetores = 'verde';
                        } else {
                            $prazosetores = 'vermelho';
                        }




                             if ($prazosetores == 'laranja') {
                            ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/laranja.gif"><?php echo date('d-m-Y',$limitesetor); ?>
                            <?php } ?>

                            <?php if ($prazosetores == 'verde') { ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/verde.gif"><?php echo date('d-m-Y',$limitesetor); ?>
                            <?php } ?>
                            <?php if ($prazosetores == 'vermelho') { ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/vermelho.gif"><?php echo date('d-m-Y',$limitesetor); ?></td>
                            <?php } ?>
                            <?php
//echo '25-01-2011';
                            ?>		
                        <?php } ?>
                    <?php if ($exibe['prazooplac']) { ?>
                        <td <?php echo $class; ?>>
                        <?php
                        $iniciocurso = $paeat['Paeat']['indicacao'];
                        $datahoje = strtotime("now");
                        $limitesetor = strtotime($iniciocurso.' -21 days');


                        $dateLimite = new DateTime(date('Y-m-d',$limitesetor));     
                        $dateHoje = new DateTime(date('Y-m-d'));     

                        if (($dateHoje < $dateLimite)) {
                            $statusoplac = 'verde';
                        } else {
                            $statusoplac = 'vermelho';
                        }
                        ?>
                            <?php if ($statusoplac == 'laranja') { ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/laranja.gif"><?php echo date('d-m-Y',$limitesetor); ?>
                            <?php } ?>
                            <?php if ($statusoplac == 'verde') { ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/verde.gif"><?php echo date('d-m-Y',$limitesetor); ?>
                            <?php } ?>
                            <?php if ($statusoplac == 'vermelho') { ?>
                                <img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/vermelho.gif"><?php echo date('d-m-Y',$limitesetor); ?></td>
                            <?php } ?>
                            <?php
//echo date('d-m-Y',$limitesetor);
                            ?>		
                        </td>
                        <?php }
                        ?>
                        <?php if ($exibe['indicacao']) { ?>
                        <td <?php echo $class; ?>><?php echo $altura . '&nbsp;';
                    echo date('d-m-Y', strtotime($paeat['Paeat']['indicacao']));
                    ?></td>
                        <?php } ?>
                        <?php if ($exibe['codcurso']) { ?>
                        <td <?php echo $classcurso; ?>><b><?php echo $altura . '&nbsp;';
                    echo $paeat['Paeat']['codcurso'];
                            ?></b>
                        <?php
                        if (($u[0]['Usuario']['privilegio_id'] == 1)  ) {
                            $excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir # O curso {$paeat['Paeat']['codcurso']} iniciando em {$paeat['Paeat']['inicio']} ?' ,'javascript:excluiRegistro({$paeat['Paeat']['id']},{$paeat['Paeat']['id']});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";
                            $excluir .= "&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\"return false;\" onmousedown=\"atualiza('{$paeatID}','{$militarID}');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Atualiza\" alt=\"Atualiza\" src=\"{$this->webroot}img/filtro.gif\"/></a>";

                           
                            if (($arquivados == 0) && ($paeat['Paeat']['status'] != 'CANCELADO')) {
                                echo $excluir;
                            }
                        }
                        ?>
                        </td>
                        <?php } ?>
                    <?php if ($exibe['vagas']) { ?>
                        <td <?php echo $class; ?>><?php
                echo $altura . '&nbsp;';
                //echo $paeat['Paeat']['vagas']; 
                //foreach(){}

                $vaga = '';
                foreach ($paeat['Paeatsdistribuicao'] as $vagas) {
                    $vaga .= '<tr><td>' . $vagas['vagas'] . '</td></tr>';
                }
                if (strlen($vaga) > 0) {
                    $vaga = '<table><tr><th>Objetivo</th></tr><tr><td>' . (iconv('UTF-8', 'ISO-8859-1', $vagas['objetivo'])) . '</td></tr><th>Pr&eacute;-Requisitos</th></tr><tr><td>' . (iconv('UTF-8', 'ISO-8859-1', $vagas['prerequisitos'])) . '</td></table><table width="100%"><tr><th>Vagas</th></tr>' . $vaga . '</table>';
                }
                echo '<a  onclick="exibeDetalhes(\'' . (iconv('ISO-8859-1', 'UTF-8', rawurlencode($vaga))) . '\',\'Vagas - ' . $vagas['codcurso'] . '\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="' . $this->webroot . 'img/documento.gif"></a>';
                ?>
                        </td>
                        <?php } ?>
                        <?php if ($exibe['local']) { ?>
                        <td <?php echo $class; ?>><?php echo $altura . '&nbsp;';
                    echo $paeat['Paeat']['local'];
                            ?></td>
                        <?php } ?>
                        <?php if ($exibe['turma']) { ?>
                        <td <?php echo $class; ?>><?php echo $altura . '&nbsp;';
                    echo $paeat['Paeat']['turma'];
                            ?></td>
                        <?php } ?>
                        <?php if ($exibe['inicio']) { ?>
                        <td <?php echo $class; ?>><?php echo $altura . '&nbsp;';
                    echo date('d-m-Y', strtotime($paeat['Paeat']['inicio']));
                    ?></td>
                    <?php } ?>
                        <?php if ($exibe['fim']) { ?>
                        <td <?php echo $class; ?>><?php
                        echo $altura . '&nbsp;';
                        echo date('d-m-Y', strtotime($paeat['Paeat']['fim']));
                        ?></td>
                        <?php } ?>
                    <?php if ($exibe['observacoes']) { ?>
                        <td <?php echo $class; ?>><?php
                echo $altura . '&nbsp;';
                echo $paeat['Paeat']['status'];
                if (strlen($paeat['Paeat']['observacoes']) > 0) {
                    //	echo '<a  onclick="exibeDetalhes(\''.strip_tags($paeat['Paeat']['observacoes']).'\',\'Referíªncia\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
                    echo '<a  onclick="exibeDetalhes(\'' . htmlspecialchars($paeat['Paeat']['observacoes'], ENT_QUOTES) . '\',\'Observaí§íµes - ' . $paeat['Paeat']['codcurso'] . '\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/documento.gif"></a>';
                }
                        ?>
                        </td>
                    <?php } ?>
                        <?php if ($exibe['avisos']) { ?>
                        <td <?php echo $class; ?>><?php
                            echo $altura . '&nbsp;';
                            if (strlen($paeat['Paeat']['avisos']) > 0) {
                                //	echo '<a  onclick="exibeDetalhes(\''.$paeat['Paeat']['avisos'].'\',\'Referíªncia\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/documento.gif"></a>';
                                //	echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',rawurlencode($paeat['Paeat']['avisos'])).'\',\'Avisos - '.$paeat['Paeat']['codcurso'].'\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/documento.gif"></a>';
                            }
                            echo $paeat['Paeat']['avisos'];
                            ?>
                        </td>
                    <?php
                    }
                    
                        $iniciocurso = $paeat['Paeat']['indicacao'];
                        $datahoje = strtotime("now");
                        $limitesetor = strtotime($iniciocurso.' + 23 hours');
                        //echo $dtini;
                        $intervalosetor01 = $datahoje - $limitesetor;
                        $prazosetores = (($intervalosetor01 <= 0) ? 'verde' : 'vermelho');

                        


                        $valida01 = ($u[0]['Usuario']['privilegio_id'] == 6) || ($u[0]['Usuario']['privilegio_id'] == 12);
                        $valida02 = strcmp($prazosetores, "vermelho");

                        switch ($valida02) {
                            case 0: $valida02 = 1;
                                break;
                            default: $valida02 = 0;
                                break;
                        }
 
                        if ($valida01 && $valida02) {
                            $bloqueio = 1;
                            $excluir = '';
                        } else {
                            $bloqueio = 0;
                        }

                    if (($arquivados == 0) && ($paeat['Paeat']['status'] != 'CANCELADO')&&(!$bloqueio)) {
                    	
                        ?>
                        <td title="Inserir aluno/instrutor" id="td<?php echo $paeat['Paeat']['id']; ?>"  <?php echo $class; ?> onclick="$('PaeatId').value =<?php echo $paeat['Paeat']['id']; ?>;
                consultadistribuicao(<?php echo $paeat['Paeat']['id']; ?>);
                ShowContent('inclusao');" onmouseover="$('td<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#f0f040'});" onmouseout="$('td<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#<?php echo $ltitulo; ?>'});"><img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/add.png"></td>
                            <?php
                        } else {
                            ?>
                        <td title="Inserir aluno/instrutor" id="td<?php echo $paeat['Paeat']['id']; ?>"  <?php echo $class; ?> ></td>
                        <?php
                    }
                    ?>
                    <td title="Gerar listagem em planilha do BROffice" id="broffice<?php echo $paeat['Paeat']['id']; ?>"  <?php echo $class; ?> onclick="$('PaeatId').value =<?php echo $paeat['Paeat']['id']; ?>;
            gerabroffice(<?php echo $paeat['Paeat']['id']; ?>);" onmouseover="$('broffice<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#f0f040'});" onmouseout="$('broffice<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#<?php echo $ltitulo; ?>'});"><img border="0" style="cursor:hand;cursor:pointer;" src="<?php echo $this->webroot; ?>img/broffice.png"></td>
                    <?php if (!$bloqueio) { ?>
                        <td title="Alterar dados do curso atual" id="edita<?php echo $paeat['Paeat']['id']; ?>"  <?php echo $class; ?> onclick="ShowContent('acrescentapaeat');
                $('PaeatIdM').value =<?php echo $paeat['Paeat']['id']; ?>;
                alteraPaeat(<?php echo $paeat['Paeat']['id']; ?>, 'LER');" onmouseover="$('edita<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#f0f040'});" onmouseout="$('edita<?php echo $paeat['Paeat']['id']; ?>').setStyle({backgroundColor: '#<?php echo $ltitulo; ?>'});"><img style="float:right;" border="0"  src="<?php echo $this->webroot . 'img/modifica.gif'; ?>"></td>
                        <?php } else { ?>
                        <td id="edita<?php echo $paeat['Paeat']['id']; ?>"  <?php echo $class; ?> ></td>
                    <?php } ?>

                </tr>

                <tr style="height:1px;"><td colspan="30"  style="height:1px;">
                        <div id='i<?php echo $paeat['Paeat']['id']; ?>'>
                    <?php
                    // if(($arquivados>0)||($paeat['Paeat']['status']=='CANCELADO')){$excluir='';}

                    $mensagem = "<table cellpadding='0' cellspacing='0'  width='100%'><tr><td{$class}>Prioridade</td><td{$class}>Atributo</td><td{$class}>Indicado</td><td{$class}>Setor</td><td{$class}>Vaga</td><td{$class}>Respons&aacute;vel pela indica&ccedil;&atilde;o</td><td{$class}>dtRegistro</td><td{$class}>Env.SIAT</td><td{$class}>OS</td><td{$class}>Matriculado</td><td{$class}>Passagem</td><td{$class}>A&ccedil;&otilde;es</td></tr>";
                    $i = 0;
//<td{$class}>Privil&eacute;gio</td>

                    foreach ($paeat['Paeatsindicado'] as $indicados) {
                    	$militarID= $indicados['militar_id'];
                    	$paeatID= $indicados['paeat_id'];
                    	
                        $class = ' style="background-color:#' . $laluno1 . ';"';
                        if ($indicados['atributo'] != 'ALUNO') {
                            $class = ' style="background-color:#' . $linstrutor1 . ';"';
                        }
                        if ($i++ % 2 == 0) {
                            $class = ' style="background-color:#' . $laluno2 . ';"';
                            if ($indicados['atributo'] != 'ALUNO') {
                                $class = ' style="background-color:#' . $linstrutor2 . ';"';
                            }
                        }
                        $ciente = '<img border="0" title="Ciente" alt="ciente" src="' . $this->webroot . 'img/accept.png"/>';
                        $ciente = '<input type="checkbox" id="' . $indicados['id'] . '"  value="' . $indicados['id'] . '" />';
                        $despacho = '<img border="0" title="Despacho" alt="despacho" src="' . $this->webroot . 'img/documento.gif"/>';
                        //  if(($u[0]['Usuario']['privilegio_id']==1)){}



                        $excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir #" . addslashes($indicados['nomecompleto']) . " do curso {$indicados['codcurso']} ?' ,'javascript:excluiRegistro({$indicados['id']},{$indicados['paeat_id']});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";
                        $excluir .= "&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\"return false;\" onmousedown=\"atualiza('{$paeatID}','{$militarID}');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Atualiza\" alt=\"Atualiza\" src=\"{$this->webroot}img/filtro.gif\"/></a>";
                        
                        $datafimmissao =  date('Y/m/d', strtotime("+1 days",strtotime($paeat['Paeat']['fim'])));
                        $datainiciomissao =  date('Y/m/d', strtotime("-1 days",strtotime($paeat['Paeat']['inicio'])));
                        $data01inicio = new DateTime($datainiciomissao);
                        $data01fim = new DateTime($datafimmissao);
                        $datafimmissao .= ' 09:00';
                        $datainiciomissao .= ' 14:00'; 
                        $diferencadias = $data01inicio->diff($data01fim);
                        $qtddias = $diferencadias->days;
                        
                        $qtddias = $qtddias+0.5;
                        
                            $excluir .= "&nbsp;&nbsp;&nbsp;&nbsp;<a  href=\"/siop/controller_menorcusto.php?d=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&i=menorcusto&acao=calculo&curso=".urlencode($paeat['Paeat']['codcurso'])."&local=".urlencode($paeat['Paeat']['local'])."&inicio=".urlencode($datainiciomissao)."&fim=".urlencode($datafimmissao)."&saram=".urlencode($indicados['saram'])."&dias=".urlencode($qtddias)."\"  target=\"_blank\"><img border=\"0\"  title=\"Planilha Comparativa\" alt=\"Atualiza\" src=\"{$this->webroot}img/planejamento.gif\"/></a>";
                        
                        
//print_r($indicados['Paeat']);
                        //echo $iniciocurso.' '.$datahoje.' '.$limitesetor;
                        //$acao= $excluir.$ciente.$despacho;
                        if (($arquivados > 0) || ($paeat['Paeat']['status'] == 'CANCELADO')) {
                        	$excluir = "<a onclick=\"return false;\" onmousedown=\"atualiza('{$paeatID}','{$militarID}');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Atualiza\" alt=\"Atualiza\" src=\"{$this->webroot}img/filtro.gif\"/></a>";
                        }

                        $iniciocurso = $paeat['Paeat']['indicacao'];
                        $datahoje = strtotime("now");
                        $limitesetor = strtotime($iniciocurso.' + 23 hours');
                        //echo $dtini;
                        $intervalosetor01 = $datahoje - $limitesetor;
                        $prazosetores = (($intervalosetor01 <= 0) ? 'verde' : 'vermelho');

                        


                        $valida01 = ($u[0]['Usuario']['privilegio_id'] == 6) || ($u[0]['Usuario']['privilegio_id'] == 12);
                        $valida02 = strcmp($prazosetores, "vermelho");

                        switch ($valida02) {
                            case 0: $valida02 = 1;
                                break;
                            default: $valida02 = 0;
                                break;
                        }
 
                        if ($valida01 && $valida02) {
                            $bloqueio = 1;
                            $excluir = '';
                        } else {
                            $bloqueio = 0;
                        }
                        $acao = $excluir;
                        //$excluir = print_r($excluir . $dtini,TRUE);
                        //echo $excluir.$valida02.$dtini.' ';
                        //$confere=($valida01 && $valida02);	
                        //echo $confere;	
                        //$excluir = $confere ? '':$valida02.$dtini;


                        if (($u[0]['Usuario']['privilegio_id'] == 1)  ) {
                            $exibe = array('prazosetores' => 1, 'prazooplac' => 1, 'ano' => 1, 'indicacao' => 1, 'indicacaosetor' => 1, 'codcurso' => 1, 'vagas' => 1, 'local' => 1, 'turma' => 1, 'inicio' => 1, 'fim' => 1, 'observacoes' => 1, 'ativado' => 1, 'status_atual' => 1, 'ativado' => 1, 'conclusao' => 1, 'codplano' => 1, 'semhotel' => 1, 'local2' => 1, 'inicio2' => 1, 'fim2' => 1, 'local3' => 1, 'inicio3' => 1, 'fim3' => 1, 'vagasreserva' => 1, 'avisos' => 1);
                            $bloqueio = 0;
                        }

                       
                        //$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
//                        print_r($indicados);
                        if ($indicados['autorizado'] == 'S') {
                            $ticado = ' checked="checked" ';
                            $txt = 'S';
                        } else {
                            $ticado = ' ';
                            $txt = '';
                        }
//          $complemento = file_get_contents("http://127.0.0.1/sgbdo/acompanhamento/minibusca.php?militarID=".$militarID."&paeatID=".$paeatID."");
          //echo $complemento;
          $complemento = '<td><input type="text" value="'.$indicados['os'].'" size="10" readonly="readonly" name="osp'.$paeatID.'m'.$militarID.'" id="osp'.$paeatID.'m'.$militarID.'"></td><td><input type="text" value="'.$indicados['matriculado'].'" readonly="readonly"  size="10" name="matriculadop'.$paeatID.'m'.$militarID.'" id="matriculadop'.$paeatID.'m'.$militarID.'"></td><td><input type="text" value="'.$indicados['passagem'].'" size="10" readonly="readonly"  name="passagemp'.$paeatID.'m'.$militarID.'" id="passagemp'.$paeatID.'m'.$militarID.'"></td>';
          // $complemento = $militarID.'-'.$paeatID;

                        if (($u[0]['Usuario']['privilegio_id'] == 1)  ) {
                            $check = "<div class='squaredFour'><input type='checkbox' $ticado onchange=\"matriculado('i{$indicados['id']}', {$indicados['id']}, $(this).checked );\" value='None' id='i{$indicados['id']}' name='check{$indicados['id']}' /><label for='i{$indicados['id']}'></label></div>";
                        } else {
                            $check = "<div class='squaredFour'>{$txt}</div>";
                        }

                        $mensagem .= "	<tr ><td{$class}>{$indicados['prioridade']}</td><td{$class}>{$indicados['atributo']}</td><td{$class}>{$indicados['nomecompleto']}</td><td{$class}>{$indicados['unidade']}</td><td{$class}>{$indicados['referenciavaga']}</td><td{$class}>{$indicados['responsavel']}</td><td{$class}>{$indicados['created']}</td><td{$class}>{$indicados['matriculado']}$check</td>$complemento<td{$class}>{$acao}</td></tr>";
                       
                    }
                    $mensagem.="</table>";

                    unset($paeat);
                    if ($i > 0) {
                        echo $mensagem;
                    }
                    ?>

                        </div>
                    </td></tr>
                        <?php endforeach; ?>



        </table>
    </td><td>




    </td></tr>
</table>
</div>
<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="detalhes">
    <p id="campo" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;"></p>
    <p	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"><div id="detalhe"></div></p>
<script type="text/javascript">
<!--
    new Draggable('detalhes');
    $('wrapper').setStyle = '#wrapper table tr:hover td {}';
    $('wrapper').removeClassName('#wrapper table tr:hover td');
//-->
</script>
</div>
</td>
</tr>
</table>
</div>




<div id="inclusao" style="top:50px; z-index: 1000;position: absolute;">
<?php echo $form->create('Paeat', array('action' => 'externocadastro', 'onsubmit' => 'return false;', 'type' => 'file')); ?>
    <table cellspacing="0" cellpadding="0" id="login">
        <tbody>
            <tr>
                <td valign="middle" align="center">
                    <table cellspacing="0" cellpadding="0" id="login" width="100%">
                        <tr>
                            <th width="10%" colspan="2"><p id="campoinclusao" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">Cadastrar Indicação
                            <a href="javascript:HideContent('inclusao');"  style="float:right;" id="btfechar">X</a></p></th>
            </tr>
<?php
$titulo = '20%';
$campo = '80%';
?>
            <tr>
                <td width="<?php echo $titulo; ?>">Vaga:</td>
                <td width="<?php echo $campo; ?>">
                    <select name="data[Paeat][unidade]"  id="PaeatUnidade"  style="float:left;">
<?php
foreach ($unidades as $unidade) {
    echo '<option value="' . $unidade['unidades']['sigla_unidade'] . '">' . $unidade['unidades']['sigla_unidade'] . '</option>';
}
?>
                    </select>
                    <input type="hidden" id="opcao"  name="opcao" value="">
                    <input type="hidden" id="PaeatId" name="data[Paeat][id]"  value="">
                </td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Nome:</td>
                <td width="<?php echo $campo; ?>"><input 
                        type="text"   value=""
                        size="25" class="formulario"
                        id="PaeatNome"
                        name="data[Paeat][nome]" /><?php echo '<input type="submit" value="Busca" class="botoes" onclick="if(verificaNome()){submitForm(\'busca\');}">'; ?></td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Escolha:</td>
                <td width="<?php echo $campo; ?>"><select
                        id="PaeatEscolha"
                        class="formulario" onchange="cursosrealizados();"
                        name="data[Paeat][militarid]" /><option></option></select></td>
        </tr>
        <tr>
            <td width="<?php echo $titulo; ?>">Cursos:</td>
            <td width="<?php echo $campo; ?>">
                <div id='cursos'>
                </div>
            </td>
        </tr>
        <tr>
            <td width="<?php echo $titulo; ?>">Prioridade:</td>
            <td width="<?php echo $campo; ?>"><select
                    id="PaeatEscolha"
                    class="formulario" style="float:left;"
                    name="data[Paeat][prioridade]" />
<?php
for ($i = 1; $i < 50; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
?>

                </select></td>
        </tr>
        <tr>
            <td width="<?php echo $titulo; ?>">Atributo:</td>
            <td width="<?php echo $campo; ?>">
                <select
                    id="PaeatAtributo"
                    class="formulario" style="float:left;"
                    name="data[Paeat][atributo]" />
        <option value="ALUNO">ALUNO</option>				
        <option value="INSTRUTOR">INSTRUTOR</option>				
        <option value="COORDENADOR">COORDENADOR</option>				
        <option value="COORD/INSTRUTOR">COORD/INSTRUTOR</option>				
        <option value="PILOTO">PILOTO</option>				
        </select>

        </td>
        </tr>
        <tr>
                <td width="<?php echo $titulo; ?>">Diária/Ajuda R$ [D/A]:</td>
                <td width="<?php echo $campo; ?>"><input 
                        type="text"   value=""
                        size="25" class="formulario"
                        id="PaeatDiariaAjuda"
                        name="data[Paeat][diaria_ajuda]" />
                </td>
        </tr>
        <tr>
                <td width="<?php echo $titulo; ?>">Passagem R$ :</td>
                <td width="<?php echo $campo; ?>"><input 
                        type="text"   value=""
                        size="25" class="formulario"
                        id="PaeatPassagem"
                        name="data[Paeat][passagem]" />
                </td>
        </tr>
        <tr>
            <td width="<?php echo $titulo; ?>">INCLUIR:</td>
            <td width="<?php echo $campo; ?>"><?php echo '<input type="submit" value="SIM" class="botoes" onclick="submitForm(\'sim\');"><input type="submit" value="NAO" class="botoes"  onclick="submitForm(\'nao\');">'; ?>
            </td>
        </tr>
        <tr>
            <td  colspan="2">
                <div id="paeatobjetivo">
                </div>
            </td>
        </tr>

    </table>
</td>
</tr>
</tbody>
</table>
</form></div>

<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1010" id="mensagemtela">
    <p  style="padding:0px;height:20px;background-color: #800000; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">MENSAGEM DO SISTEMA<a href="javascript:HideContent('mensagemtela');"  style="float:right;background-color:#ffffff;" id="msgfechar">X</a></p>
    <div id='mensagemerro'>
    </div>


    <div style="display: none; position: absolute;top:50px; border-style: solid; background-color: white; padding: 0px; width: 40%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="detalheinclusao">

    </div>
    <script type="text/javascript">
    //<!--
        new Draggable('inclusao');
        $('inclusao').hide();
    //-->
    </script>
</div>


<div id="acrescentapaeat" style="border-style: solid; background-color: white; top:50px; z-index: 1000;display: none; position: absolute;">
<?php echo $form->create('Paeat', array('action' => 'externocadastropaeat', 'onsubmit' => 'return false;', 'type' => 'file')); ?>
    <table cellspacing="0" cellpadding="0" id="login">
        <tbody>
            <tr>
                <td valign="middle" align="center">
                    <table cellspacing="0" cellpadding="0" id="login" width="100%">
                        <tr>
                            <th width="10%" colspan="4"><p id="campoinclusaoacrescentapaeat" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">Cadastrar PAEAT
                            <a href="javascript:HideContent('acrescentapaeat');"  style="float:right;" id="btfecharacrescentapaeat">X</a></p></th>
<?php
$titulo = '20%';
$campo = '20%';
?>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Ano:**	<?php
$ano = date('Y') + 1;
$anoa = $ano-3;
for ($inicio = $anoa; $inicio <= $ano; $inicio++) {
    $anos[$inicio] = $inicio;
}
?>
                    <select name="data[Paeat][ano]"  id="PaeatAno"  style="float:right;">
                        <?php
                        foreach ($anos as $ano) {
                            echo '<option value="' . $ano . '">' . $ano . '</option>';
                        }
                        ?>
                    </select>
                </td>
                <td colspan="3">Obs.:<textarea cols="70" rows="6" name="data[Paeat][obs]"  id="PaeatObs"  style="float:right;"></textarea> </td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Data Limite SGC:**<br><b><u>(d-m-AAAA)</u></b></td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatIndicacao" name="data[Paeat][indicacao]" onchange="validaData('PaeatIndicacao');" /> 
                </td>
                <td width="<?php echo $titulo; ?>">Código do curso:**</td>
                <td width="<?php echo $campo; ?>">
                    <select	id="PaeatCodcurso" name="data[Paeat][codcurso]" />
                    <?php 
                    //print_r($cursos);
                    foreach ($cursos as $chave=>$valor){
                        //echo $valor['codigo'].'<br>';
                        echo '<option value="'.$valor['Curso']['codigo'].'">'.$valor['Curso']['codigo'].'</option>';
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Vagas:</td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatVagas" name="data[Paeat][vagas]" />
                </td>
                <td width="<?php echo $titulo; ?>">Local:</td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatLocal" name="data[Paeat][local]" />
                </td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Turma:**</td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatTurma" name="data[Paeat][turma]" />
                </td>
                <td width="<?php echo $titulo; ?>">Iní­cio:<br><b><u>(d-m-AAAA)</u></b>**</td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text" id="PaeatInicio" value="" size="25" class="formulario" name="data[Paeat][inicio]" onchange="validaData('PaeatInicio');" />
                </td>
            </tr>
            <tr>
                <td width="<?php echo $titulo; ?>">Fim:<br><b><u>(d-m-AAAA)</u></b>**</td>
                <td width="<?php echo $campo; ?>">
                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatFim" name="data[Paeat][fim]" onchange="validaData('PaeatFim');" />
                </td>
                <td width="<?php echo $titulo; ?>">Avisos:</td>
                <td width="<?php echo $campo; ?>">
                    <select name="data[Paeat][avisos]"  id="PaeatAvisos"  style="float:left;">
                        <option value="TEORICA">TEORICA</option>
                        <option value="PRATICA">PRATICA</option>
                        <option value="TEORICO-PRATICA">TEORICO-PRATICA</option>
                    </select>
                </td>
            </tr>
            <!--
                                            <tr>
                                                    <td width="<?php echo $titulo; ?>">Conclusí£o:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatConclusao" name="data[Paeat][conclusao]" />
                                                    </td>
                                                    <td width="<?php echo $titulo; ?>">Código do Plano:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatCodplano" name="data[Paeat][codplano]" />
                                                    </td>
                                            </tr>
            
                                            <tr>
                                                    <td width="<?php echo $titulo; ?>">Sem hotel:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatSemhotel" name="data[Paeat][semhotel]" />
                                                    </td>
                                                    <td width="<?php echo $titulo; ?>">Local 2:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatLocal2" name="data[Paeat][local2]" />
                                                    </td>
                                            </tr>
                                            <tr>
                                                    <td width="<?php echo $titulo; ?>">Iní­cio 2:<br><b><u>(d-m-AAAA)</u></b></td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatInicio2" name="data[Paeat][inicio2]" onchange="validaData('PaeatInicio2');" />
                                                    </td>
                                                    <td width="<?php echo $titulo; ?>">Fim 2:<br><b><u>(d-m-AAAA)</u></b></td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatFim2" name="data[Paeat][fim2]" onchange="validaData('PaeatFim2');" />
                                                    </td>
                                            </tr>
                                            <tr>
                                                    <td width="<?php echo $titulo; ?>">Local 3:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatLocal3" name="data[Paeat][local3]" />
                                                    </td>
                                                    <td width="<?php echo $titulo; ?>">Iní­cio 3:<br><b><u>(d-m-AAAA)</u></b></td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatInicio3" name="data[Paeat][inicio3]"  onchange="validaData('PaeatInicio3');"/>
                                                    </td>
                                            </tr>
                                            <tr>
                                                    <td width="<?php echo $titulo; ?>">Fim 3:<br><b><u>(d-m-AAAA)</u></b></td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatFim3" name="data[Paeat][fim3]" onchange="validaData('PaeatFim3');" />
                                                    </td>
                                                    <td width="<?php echo $titulo; ?>">Vagas reserva:</td>
                                                    <td width="<?php echo $campo; ?>">
                                                    <input	type="text"   value=""	size="25" class="formulario" id="PaeatVagasreserva" name="data[Paeat][vagasreserva]" />
                                                    </td>
                                            </tr>
            -->
            <tr>
        <input	type="hidden"   value="" id="acao" name="data[acao]" />
        <input	type="hidden"   value="" id="PaeatIdM" name="data[Paeat][id]" />
        <td width="<?php echo $titulo; ?>">Tipo</td>
        <td width="<?php echo $campo; ?>">
            <select name="data[Paeat][tipo]"  id="PaeatTipo"  style="float:left;">
                <option value="OPERACIONAL">OPERACIONAL</option>
            </select>
        </td>
        <td width="<?php echo $titulo; ?>">Status</td>
        <td width="<?php echo $campo; ?>">
            <select name="data[Paeat][status]"  id="PaeatStatus"  style="float:left;">
                <option value="ATIVO">ATIVO</option>
                <option value="ADIADO">ADIADO</option>
                <option value="CANCELADO">CANCELADO</option>
                <option value="SEM INDICAÇÃO">SEM INDICAÇÃO</option>
            </select>
        </td>
        </tr>
        <tr>
            <td width="<?php echo $titulo; ?>">Subtipo</td>
            <td width="<?php echo $campo; ?>">
                <select name="data[Paeat][subtipo]"  id="PaeatSubtipo"  style="float:left;">
                    <option value="PAEAT">PAEAT</option>
                    <option value="INSTRUTOR">INSTRUTOR</option>
                    <option value="PROSIMA">PROSIMA</option>
                </select>
            </td>
            <td width="<?php echo $titulo; ?>">Arquivado</td>
            <td width="<?php echo $campo; ?>">
                <select name="data[Paeat][arquivado]"  id="PaeatArquivado"  style="float:left;">
                    <option value="1">SIM</option>
                    <option value="0" selected="selected">NÃO</option>
                </select>
            </td>

        </tr>

        <tr>
            <td colspan="4" width="<?php echo $campo; ?>"><?php echo '<input type="submit" value="REGISTRAR" class="botoes" onclick="var id=$(\'PaeatIdM\').value;alteraPaeat(id,\'ATUALIZAR\');">'; ?>
            </td>
        </tr>

    </table>
</td>
</tr>
</tbody>
</table>
</form></div>
<div style="display: none; position: absolute;top:50px; border-style: solid; background-color: white; padding: 0px; width: 40%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="detalheacrescentapaeat">

</div>
<script type="text/javascript">
//<!--
    new Draggable('acrescentapaeat');
    $('acrescentapaeat').hide();
//-->
</script>
</div>


<?php
$jscript = <<<SCRIPT
<script type="text/javascript">
//<![CDATA[


                
                
function verificaNome(){
var conteudo=$('PaeatNome').value;
var dados=conteudo.toArray();
var tamanho=dados.size();
if(tamanho<4){
	$('mensagemerro').innerHTML = '<p	style="margin: 0px; background-color: #ffffff; border: 1px solid #000;"><br>A busca deve possuir no mí­nimo 4 caracteres!<br><br></p>';
	ShowContent('mensagemtela');
	return false;
}else{
	return true;
}
  
}


function matriculado(idnome, idbd, marcado) {
	new Ajax.Request('{$this->webroot}paeats/externomatriculado', {
			method: 'post',
			parameters: {'id':idbd,'valor':marcado},
				onSuccess: function(transport) {
									var resultado = transport.responseText.evalJSON(true);
									if (resultado.ok==0){
										$('mensagemerro').innerHTML = '<p	style="margin: 0px; background-color: #ffffff; border: 1px solid #000;"><br>A informação de matrí­cula ní£o foi atualizada!<br><br></p>';
										$(idnome).checked = !$(idnome).checked;
										ShowContent('mensagemtela');
										return false;        
									}
								}
			})
        
    
	return false;
}

function submitForm(opcao) {
	/*
	usa mí©todo request() da classe Form da prototype, que serializa os campos
	do formulí¡rio e submete (por POST como default) para a action especificada no form
	*/
    
	$('opcao').value=opcao;
	if($('PaeatUnidade').value==''){
		$('mensagemerro').innerHTML  = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Campo ní£o preenchido corretamente:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">O campo Vaga deve ser selecionado!</p>';
		ShowContent('mensagemtela');
		return false;
	}
	var dados = Form.serialize($('PaeatExternocadastroForm'));
	new Ajax.Request('{$this->webroot}paeats/externocadastro', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var id='i'+$('PaeatId').value;
			//$(id).innerHTML = $('PaeatUnidade').value+"<p>Registro ní£o atualizado!</p>";
			var resultado = transport.responseText.evalJSON(true);
			
			
			if (resultado.ok==0){
				$(id).innerHTML = "<p>Registro ní£o atualizado!</p>";
			}else{
				if(resultado.tipo=='lista'){
					$('PaeatEscolha').innerHTML = unescape(resultado.lista);
					$('cursos').innerHTML = '';
				}
				if($('opcao').value!='busca'){
					$(id).innerHTML = unescape(resultado.mensagem);
					if(resultado.erro==1){
						$('mensagemerro').innerHTML = unescape(resultado.mensagemerro);
						ShowContent('mensagemtela');
					}
					}
					}
				}})
        
    
	return false;
}
function cursosrealizados() {
	var dados = Form.serialize($('PaeatExternocadastroForm'));
	new Ajax.Request('{$this->webroot}paeats/externocursosrealizados', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			
			if (resultado.ok==0){
				$(id).innerHTML = "<p>Registro ní£o atualizado!</p>";
			}else{
				$('cursos').innerHTML = unescape(resultado.mensagem);
					}
				}})
        
    
	return false;
}

function consultadistribuicao(paeatid) {
	var dados = Form.serialize($('PaeatExternocadastroForm'));
	new Ajax.Request('{$this->webroot}paeatsdistribuicaos/externoconsulta/'+paeatid, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			
			if (resultado.ok==0){
				$('PaeatUnidade').innerHTML = "";
			}else{
				$('PaeatUnidade').innerHTML = unescape(resultado.mensagem);
				$('paeatobjetivo').innerHTML = unescape(resultado.objetivos);
								}
				}})
        
    
	return false;
}

function excluiRegistro(indicadosid, paeatid) {
/*
usa mí©todo request() da classe Form da prototype, que serializa os campos
do formulí¡rio e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('PaeatExternocadastroForm'));
var divid = 'i'+paeatid;
		if(indicadosid==paeatid){
				new Ajax.Request('{$this->webroot}paeats/delete/'+paeatid, {
												method: 'get',
												postBody: dados,
												onSuccess: function(transport) {

												var resultado = transport.responseText.evalJSON(true);

												if (resultado.ok==0){
																$('mensagemerro').innerHTML = unescape(resultado.mensagemerro);
																ShowContent('mensagemtela');
													}else{
																$('mensagemerro').innerHTML = unescape(resultado.mensagem);
																ShowContent('mensagemtela');
																location.reload(true);

													}
									}
														})

		}else{
				new Ajax.Request('{$this->webroot}paeatsindicados/delete/'+indicadosid+'/'+paeatid, {
												method: 'get',
												postBody: dados,
												onSuccess: function(transport) {

												var resultado = transport.responseText.evalJSON(true);

												if (resultado.ok==0){
														if(resultado.mensagemerro.startsWith('%3Cp')){
																	$('mensagemerro').innerHTML = unescape(resultado.mensagemerro);
																				ShowContent('mensagemtela');

														}
												}else{
														$(divid).innerHTML = unescape(resultado.mensagem);

												}
									}
														})
        

	}			
}
 
function gerabroffice(id){
	porcaria = new Date().getTime();
//  	window.open('{$this->webroot}paeats/indexExcel/'+id,'','');
	window.open('{$this->webroot}paeats/externozip/'+id+'/'+porcaria,'');
}
function cadPaeat(opcao) {
	/*
	usa mí©todo request() da classe Form da prototype, que serializa os campos
	do formulí¡rio e submete (por POST como default) para a action especificada no form
	*/
    
	$('opcao').value=opcao;
	if($('PaeatUnidade').value==''){
		$('mensagemerro').innerHTML  = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Campo ní£o preenchido corretamente:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">O campo Vaga deve ser selecionado!</p>';
		ShowContent('mensagemtela');
		return false;
	}
	var dados = Form.serialize($('PaeatExternocadastropaeatForm'));
	new Ajax.Request('{$this->webroot}paeats/externocadastropaeat', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var id='i'+$('PaeatId').value;
			//$(id).innerHTML = $('PaeatUnidade').value+"<p>Registro ní£o atualizado!</p>";
			var resultado = transport.responseText.evalJSON(true);
			
			
			if (resultado.ok==0){
				$(id).innerHTML = "<p>Registro ní£o atualizado!</p>";
			}else{
				if(resultado.tipo=='lista'){
					$('PaeatEscolha').innerHTML = unescape(resultado.lista);
					$('cursos').innerHTML = '';
				}
				if($('opcao').value!='busca'){
					$(id).innerHTML = unescape(resultado.mensagem);
					if(resultado.erro==1){
						$('mensagemerro').innerHTML = unescape(resultado.mensagemerro);
						ShowContent('mensagemtela');
					}
					}
					}
				}})
        
    
	return false;
}

function alteraPaeat(id, acao) {
	
	if(acao=='INSERIR'){
		$('acao').value='INSERIR';
		$('PaeatIdM').value=0;
	}
	if(acao=='LER'){
		$('acao').value='LER';
		$('PaeatIdM').value=id;
	}
	if(acao=='ATUALIZAR'){
		$('acao').value='ATUALIZAR';
	}
	if(acao!='INSERIR'){
	var dados = Form.serialize($('PaeatExternocadastropaeatForm'));
	new Ajax.Request('{$this->webroot}paeats/externocadastropaeat/'+id, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			if (resultado.ok==0){
				//$(id).innerHTML = "<p>Registro ní£o atualizado!</p>";
				$('mensagemerro').innerHTML = unescape(resultado.erro);
				ShowContent('mensagemtela');
			}else{
			
			
			var c = $('PaeatAno');
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == resultado.ano){
				c.options[i].selected = true;
				break;
			}}
					$('PaeatIdM').value=resultado.id;
					$('PaeatCodcurso').value=resultado.codcurso;
					$('PaeatVagas').value=resultado.vagas;
					$('PaeatLocal').value=resultado.local;
					$('PaeatTurma').value=resultado.turma;
					$('PaeatInicio').value=resultado.inicio;
					$('PaeatFim').value=resultado.fim;
					$('PaeatObs').value=decodeURIComponent(resultado.obs);

		            $('PaeatIndicacao').value=resultado.indicacao;
        /*        
			$('PaeatObservacoes').value=resultado.observacoes;
			$('PaeatConclusao').value=resultado.conclusao;
			$('PaeatCodplano').value=resultado.codplano;
			$('PaeatSemhotel').value=resultado.semhotel;
			$('PaeatLocal2').value=resultado.local2;
			$('PaeatInicio2').value=resultado.inicio2;
			$('PaeatFim2').value=resultado.fim2;
			$('PaeatLocal3').value=resultado.local3;
			$('PaeatInicio3').value=resultado.inicio3;
			$('PaeatFim3').value=resultado.fim3;
			$('PaeatVagasreserva').value=resultado.vagasreserva;
*/
			//$('PaeatId').value=resultado.id;
			           
			var d = $('PaeatStatus');
			for (var i=0; i<d.options.length; i++){
			if (d.options[i].value == decodeURIComponent(resultado.status)){
				d.options[i].selected = true;
				break;
			}}
			var e = $('PaeatAvisos');
			for (i=0; i<e.options.length; i++){
			if (e.options[i].value == decodeURIComponent(resultado.avisos)){
				e.options[i].selected = true;
				break;
			}}
			var f = $('PaeatTipo');
			for (i=0; i<f.options.length; i++){
			if (f.options[i].value == decodeURIComponent(resultado.tipo)){
				f.options[i].selected = true;
				break;
			}}
			var g1 = $('PaeatSubtipo');
			for (i=0; i<g1.options.length; i++){
			if (g1.options[i].value == decodeURIComponent(resultado.subtipo)){
				g1.options[i].selected = true;
				break;
			}}
			var h = $('PaeatArquivado');
			for (i=0; i<h.options.length; i++){
			if (h.options[i].value == resultado.arquivado){
				h.options[i].selected = true;
				break;
			}}
						
					if(resultado.ok==1){
						$('mensagemerro').innerHTML = unescape(resultado.erro);
					//	ShowContent('mensagemtela');
						this.location.reload();
					}
			}
			//fim-else
		}
		//fim-onsuccess
	}); 
	//fim-serialize
				
	}
	return false;
	
				}
        
    
function registra(id, acao) {
	
	if(acao=='NOVO'){
		$('acao').value='INSERIR';
		$('PaeatId').value=0;
	}
	if(acao=='INSERIR'){
		$('acao').value='INSERIR';
	}
	if(acao=='ATUALIZAR'){
		$('acao').value='ATUALIZAR';
	}
	if(id>0){
	var dados = Form.serialize($('PaeatExternocadastropaeatForm'));
	new Ajax.Request('{$this->webroot}paeats/externoatualizapaeat/'+id, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			resultado.ok=1;
			if (resultado.ok==0){
				$(id).innerHTML = "<p>Registro ní£o atualizado!</p>";
			}else{
				if(resultado.erro==1){
					$('mensagemerro').innerHTML = unescape(resultado.mensagemerro);
					ShowContent('mensagemtela');
				}
			}
			//fim-else
		}
		//fim-onsuccess
	}); 
	//fim-serialize
				
	}
	return false;
	
				}
				

//]]>
</script>
 
SCRIPT;


echo $jscript;
?>
<script type="text/javascript">
<!--
    function validaData(campo) {
        var formatoValido = /([1-9]|[12][0-9]|3[01])(\/|-)([1-9]|1[0-2])(\/|-)[12][0-9]{3}/;

        //var formatoValido = /^\d{2}\/\d{2}\/\d{4}$/; 
        var valido = false;
        if (!formatoValido.test($(campo).value)) {
            alert("A data estí¡ no formato errado. Por favor corrija. Exemplo: 1-1-2011  (dia-mes-ano)");
            $(campo).value = '';
        }
        else {
            var data = $(campo).value;
            var dia = data.split("-")[0];
            var mes = data.split("-")[1];
            var ano = data.split("-")[2];
            var MyData = new Date(ano, mes - 1, dia);
            if ((MyData.getMonth() + 1 != mes) ||
                    (MyData.getDate() != dia) ||
                    (MyData.getFullYear() != ano)) {
                alert("Valores inví¡lidos para o dia, míªs ou ano. Por favor corrija.");
                $(campo).value = '';
            }
            else
                valido = true;
        }

        return valido;
    }
//-->
</script>

<script type="text/javascript">
<!--
    new Draggable('mensagemtela');
//-->
</script>
</div>


<script type="text/javascript">
    $('detalhes').hide();
    HideContent('detalhes');
    HideContent('mensagemtela');
</script>

<script type="text/javascript">
    function exibeDetalhes(detalhes, campo) {
        $('detalhe').innerHTML = unescape(detalhes);
        var excluir = '<a style="float: right; margin: 0px;" href="javascript:HideContent(\'detalhes\');"	onclick="HideContent(\'detalhes\');" 	href="javascript:HideContent(\'detalhes\');"><img border="0" width="15"	height="15" title="Fechar" alt="Fechar" 	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a>';
        $('campo').innerHTML = unescape(campo) + excluir;
        ShowContent('detalhes');
    }
    function atualiza(paeat_id, militar_id) {
    	var os = 'osp' + paeat_id + 'm'+ militar_id;
    	var matriculado = 'matriculadop' + paeat_id + 'm'+ militar_id;
    	var passagem = 'passagemp' + paeat_id + 'm'+ militar_id;
        $(os).setStyle({backgroundColor: 'black',fontSize: '12px', color:'white'});
        $(matriculado).setStyle({backgroundColor: 'black',fontSize: '12px', color:'white'});
        $(passagem).setStyle({backgroundColor: 'black',fontSize: '12px', color:'white'});
    	    	
    	new Ajax.Request('<?php echo $this->webroot; ?>acompanhamento/minibuscafracionado.php', {
    			method: 'get',
    			parameters: {militarID: militar_id, paeatID: paeat_id },
    			onSuccess: function(transport) {
    			var resultado = transport.responseText.evalJSON(true);
    			if(resultado.ok=='1'){
                    $(os).setStyle({backgroundColor: '#008000',fontSize: '12px', color:'white'});
                    $(matriculado).setStyle({backgroundColor: '#008000',fontSize: '12px', color:'white'});
                    $(passagem).setStyle({backgroundColor: '#008000',fontSize: '12px', color:'white'});
                    $(os).value = resultado.os;
                    $(matriculado).value = resultado.matriculado;
                    $(passagem).value = resultado.passagem;
				}else{
                    $(os).setStyle({backgroundColor: '#800000',fontSize: '12px', color:'white'});
                    $(matriculado).setStyle({backgroundColor: '#800000',fontSize: '12px', color:'white'});
                    $(passagem).setStyle({backgroundColor: '#800000',fontSize: '12px', color:'white'});
    			}
    		    
    			}
    	});
            
        
        return false;
    }
        

</script>