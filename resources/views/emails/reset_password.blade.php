<!DOCTYPE html>
<html>
<head>
    <title>Сброс пароля</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <style>
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            background: #edf2ff;
        }
    </style>
</head>
<body>
    <table align="center">
        <tr>
            <td height="40">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="800">
                    <tr>
                        <td style="background: #fff" align="center">
                            <table width="600">
                                <tr>
                                    <td height="50">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%">
                                            <tr>
                                                <td align="center">
                                                    <a href="http://fullstack" style="text-decoration:none;"><img src="{{ $message->embed(public_path().'/img/logo.png') }}" style="width: 60px;" /></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="15">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:'Open Sans', sans-serif, Verdana; font-size:20px; color:#3b3a3a; font-weight:bold; line-height:46px; text-transform:none;" align="center">
                                                    Запрос на сброс пароля
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:'Open Sans', sans-serif, Verdana; font-size:14px; color:#3b3a3a; font-weight:normal; line-height:34px;" align="left">
                                                    <strong>Привет, {{ ucfirst($data['name']) }}!</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:'Open Sans', sans-serif, Verdana; font-size:14px; color:#3b3a3a; font-weight:normal; line-height:24px;" align="left">
                                                    Мы получили запрос на сброс вашего пароля. Если вы не делали запрос, просто проигнорируйте это письмо. В противном случае вы можете сбросить пароль, используя следующий код:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:'Open Sans', sans-serif, Verdana; font-size:14px; color:#3b3a3a; font-weight:normal; line-height:48px; border-bottom: 1px solid #cf4520">Ваш код для сброса пароля: <strong>{{ $data['random'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td style="line-height:5px;" height="5" align="center">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:'Open Sans', sans-serif, Verdana; font-size:14px; color:#3b3a3a; font-weight:normal; line-height:22px; font-style: italic">
                                                    С уважением <br> специалисты кадрового центра "Работа России"
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="50">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>