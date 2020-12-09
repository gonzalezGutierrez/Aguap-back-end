<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login de acceso</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="{{asset('css/mdb.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);
        html,
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #eee;
        }

        * {
            font-family: 'Roboto', sans-serif;
            font-size: 100%;
            font-weight: normal;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border: none;
            box-shadow: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        h1,
        h2,
        h3 {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            height: 500px;
            margin: 0 auto;
        }

        .form-header {
            margin: 32px 0;
            padding: 0 16px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: rgba(0, 0, 0, .87);
        }

        h2 {
            font-size: 18px;
            color: rgba(0, 0, 0, .54);
        }

        h3 {
            font-size: 18px;
            line-height: 64px;
            width: 100%;
            height: 64px;
            padding: 0 16px;
            color: #fff;
            background: #1c2a48 !important;
            -webkit-border-top-left-radius: 2px;
            -webkit-border-top-right-radius: 2px;
            -moz-border-top-left-radius: 2px;
            -moz-border-top-right-radius: 2px;
            border-top-right-radius: 2px;
            border-top-left-radius: 2px;
        }

        form {
            position: relative;
            width: 100%;
            height: auto;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            background: #fff;
            -webkit-box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            -moz-box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
        }

        .form-group {
            position: relative;
            max-width: 100%;
            height: 72px;
            margin: 0 16px;
        }

        input {
            font-size: 16px;
            font-size: 16px;
            position: absolute;
            bottom: 0;
            left: 0;
            display: block;
            width: 100%;
            padding: 8px 0 16px;
            color: rgba(0, 0, 0, .87);
            background: transparent;
        }

        input[type='text'],
        input[type='password'] {
            padding: 8px 24px 16px 0;
        }

        input:focus {
            outline: none;
        }

        label {
            font-size: 16px;
            position: absolute;
            top: 21px;
            left: 0;
            display: block;
            width: 100%;
            padding: 16px 0 8px;
            -webkit-transition: all .45s;
            -moz-transition: all .45s;
            -ms-transition: all .45s;
            -o-transition: all .45s;
            transition: all .45s;
            pointer-events: none;
            color: rgba(0, 0, 0, .54);
        }

        input:focus + label {
            font-size: 12px;
            top: 0;
            left: 0;
            color: #2196f3;
        }

        input:focus + label::after,
        input.fixed + label::after {
            content: ':';
        }

        input.fixed + label {
            font-size: 12px;
            top: 0;
            left: 0;
            color: rgba(0, 0, 0, .54);
        }

        input:focus.fixed + label {
            color: #2196f3;
        }

        input ~ .bar {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 1px;
            margin-bottom: 7px;
            background: rgba(0, 0, 0, .12);
        }

        input ~ .bar::before,
        input ~ .bar::after {
            position: absolute;
            bottom: 0;
            width: 0;
            height: 2px;
            content: '';
            -webkit-transition: all .45s;
            -moz-transition: all .45s;
            -ms-transition: all .45s;
            -o-transition: all .45s;
            transition: all .45s;
            background: #2196f3;
        }

        input ~ .bar::before {
            left: 50%;
        }

        input ~ .bar::after {
            right: 50%;
        }

        input:focus ~ .bar::before,
        input:focus ~ .bar::after {
            width: 50%;
        }

        input:invalid ~ .error {
            display: block;
        }

        input:invalid ~ .bar,
        input:invalid ~ .bar::before,
        input:invalid ~ .bar::after {
            background: #f44336;
        }

        input:valid ~ .error {
            display: none;
        }

        input ~ .error {
            font-size: 12px;
            line-height: 24px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            width: 100%;
            height: 24px;
            margin-bottom: -18px;
            padding: 0;
            pointer-events: none;
            color: #f44336;
            background: transparent;
        }

        input ~ .error::after {
            position: absolute;
            right: 0;
            width: 24px;
            height: 24px;
            content: '';
            background: transparent url(http://5.firepic.org/5/images/2016-01/19/1e8aj91282u1.png) no-repeat local center;
        }

        input ~ .visible {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 24px;
            height: 24px;
            margin-bottom: 14px;
            cursor: pointer;
            background: transparent url(http://5.firepic.org/5/images/2016-01/19/ex2xjvosoxrm.png) no-repeat local center;
        }

        input ~ .visible:active {
            background: transparent url(http://5.firepic.org/5/images/2016-01/19/mgz13k7aprvk.png) no-repeat local center;
        }

        .form-submit {
            width: 100%;
            height: auto;
            padding: 16px;
        }

        button {
            font-size: 16px;
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 36px;
            padding: 0;
            cursor: pointer;
            text-transform: uppercase;
            color: #fff;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }

        button:hover {
            background: #2196f3;
            -webkit-box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            -moz-box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            box-shadow: 0 1px 2.5px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
        }

        .ripple {
            position: absolute;
            display: block;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -o-transform: scale(0);
            transform: scale(0);
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            background: rgba(255, 255, 255, .3);
        }

        .animate {
            -webkit-animation: ripple .65s linear;
            -moz-animation: ripple .65s linear;
            -ms-animation: ripple .65s linear;
            -o-animation: ripple .65s linear;
            animation: ripple .65s linear;
        }

        @-webkit-keyframes ripple {
            100% {
                -webkit-transform: scale(2.5);
                opacity: 0;
            }
        }

        @-moz-keyframes ripple {
            100% {
                -moz-transform: scale(2.5);
                opacity: 0;
            }
        }

        @-o-keyframes ripple {
            100% {
                -o-transform: scale(2.5);
                opacity: 0;
            }
        }

        @keyframes ripple {
            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }
    </style>

</head>
<body>


    <div class="container">
        <div class="form-header">
            <h1 class="text-center">Aguap Admin</h1>
        </div>
        <form action="{{asset('login')}}" method="post">
            @csrf
            <h3 class="text-uppercase">Acceso a la administración</h3>
            <div class="form-group">
                <input class="form-control-lg" type="email" name="email">
                <label for="email">Correo Electronico</label>
                <div class="error">Email is incorrect.</div>
                <span class="bar"></span>
            </div>
            <div class="form-group">
                <input class="" type="password" name="password" />
                <label for="password">Contraseña</label>
                <div class="visible"></div>
                <span class="bar"></span>
            </div>
            <div class="form-submit">
                <button class="mdb-color darken-3" type="submit">Acceder</button>
            </div>
        </form>
    </div>


    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/mdb.js')}}"></script>
    <script src="{{asset('js/layout.js')}}"></script>

    <script>
        $(document).ready(function() {
            var $input = $('input[type="email"],input[type="password"]');
            $input.val('');
            $input.change(function() {
                var $this = $(this);
                if ($this.val().length > 0) {
                    $this.addClass('fixed');
                } else {
                    $this.removeClass('fixed');
                }
            });

            var $pass = $('input[name="password"]');
            $('.visible').mousedown(function() {
                $pass.attr('type', 'text');
            });
            $('.visible').mouseup(function() {
                $pass.attr('type', 'password');
            });

            var ink, d, x, y;
            $('button').click(function(e) {
                if ($(this).find('.ripple').length === 0) {
                    $(this).prepend("<span class='ripple'></span");
                }
                ripple = $(this).find('.ripple');
                ripple.removeClass('animate');
                if (!ripple.height() && !ripple.width()) {
                    d = Math.max($(this).outerWidth(), $(this).outerHeight());
                    ripple.css({
                        height: d,
                        width: d
                    });
                }
                x = e.pageX - $(this).offset().left - ripple.width() / 2;
                y = e.pageY - $(this).offset().top - ripple.height() / 2;
                ripple.css({
                    top: y + 'px',
                    left: x + 'px'
                }).addClass('animate');
            });
        });
    </script>
</body>
</html>
