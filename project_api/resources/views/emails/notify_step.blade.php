<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Des nouvelles de votre analyse PHP</title>
</head>
<body width="100%" bgcolor="#eaeaea" style="margin: 0; mso-line-height-rule: exactly; color: #363636;">
<center style="width: 100%; background: #eaeaea; text-align: left;">
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="margin: auto;">
        <tr style="width: 100%; display: flex; background-color: #c1c1c1;">
            <td style="padding: 20px 20px; text-align: center; color: #202020; width: 10%;">
                <img src="{{ $message->embed('img/search.svg') }}" alt="Loupe résultat rapport" height="75"/>
            </td>
            <td style="padding: 20px 0; text-align: center; color: #202020; width: 90%;">
                <h1>Votre analyse PHP a été terminée !</h1>
            </td>
        </tr>
    </table>

    <!-- Clear Spacer : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="90%" style="margin: auto;">
        <tr>
            <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">
                &nbsp;
            </td>
        </tr>
    </table>
    <!-- Clear Spacer : END -->

    <table cellspacing="0" cellpadding="0" border="0" align="center" width="90%" style="margin: auto;">
        <tr>
            <td style="padding: 20px 0; text-align: center; width: 100%;">
                <p>Votre projet a été analysé par nos services.</p>
            </td>
        </tr>
        <tr style="width: 100%;">
            <td style="padding: 20px 0; text-align: center; width: 100%;">
                <p style="background-color: #cbcbcb; padding: 10px; border: solid #1d1d1d 2px; color: #1d1d1d;"><strong>Pour rappel, votre repository : </strong><br>
                    <a style="color: #1d1d1d;" href="{{ $project_logs->repository_url }}">{{ $project_logs->repository_url }}</a>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0; text-align: center; width: 100%;">
                <p>Vous pourrez retrouvez votre rapport depuis l'application.</p>
            </td>
        </tr>
    </table>

    <!-- Clear Spacer : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="90%" style="margin: auto;">
        <tr>
            <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">
                &nbsp;
            </td>
        </tr>
    </table>
    <!-- Clear Spacer : END -->

    <!-- Email Footer : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
           style="max-width: 680px; font-family: sans-serif; color: #888888; font-size: 12px; line-height: 140%;">
        <tr>
            <td style="padding: 40px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 140%; text-align: center; color: #888888;"
                class="x-gmail-data-detectors">
                <webversion style="color: #9c9c9c; text-decoration: underline; font-weight: bold;">View as a Web Page
                </webversion>
                <br><br>
                PHP Scanner<br>123 Fake Street, SpringField, OR, 97477 US<br>(123) 456-7890
                <br><br>
                <unsubscribe style="color: #888888; text-decoration: underline;">unsubscribe</unsubscribe>
            </td>
        </tr>
    </table>
    <!-- Email Footer : END -->

</center>
</body>
</html>