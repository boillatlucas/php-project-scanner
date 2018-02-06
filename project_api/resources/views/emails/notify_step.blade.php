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
                <img src="{{ $message->embed(public_path() . '/img/search.svg') }}" alt="Loupe résultat rapport" height="75"/>
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
                <p style="background-color: #cbcbcb; padding: 10px; border: solid #1d1d1d 2px; color: #1d1d1d;">
                    Vous pourrez retrouvez votre rapport depuis <strong>l'application</strong>.<br><br>
                    <a style="color: #1d1d1d; text-decoration: none; background-color: #eaeaea; padding: 7px; border: solid #505050 1px; border-radius: 5px; font-size: 14px;" href="{{ $route_project_get_logs }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 325 325" enable-background="new 0 0 325 325" style="height: 15px;">
                            <g>
                                <g>
                                    <path d="m299,0h-273c-9.374,0-17,7.626-17,17v291c0,9.374 7.626,17 17,17h273c9.374,0 17-7.626 17-17v-291c0-9.374-7.626-17-17-17zm7,308c0,3.859-3.141,7-7,7h-273c-3.86,0-7-3.141-7-7v-291c0-3.86 3.14-7 7-7h273c3.859,0 7,3.14 7,7v291z"></path>
                                    <path d="m74,216h-21c-9.374,0-17,7.626-17,17v21c0,9.374 7.626,17 17,17h21c9.374,0 17-7.626 17-17v-21c0-9.374-7.626-17-17-17zm7,38c0,3.859-3.14,7-7,7h-21c-3.86,0-7-3.141-7-7v-21c0-3.859 3.14-7 7-7h21c3.86,0 7,3.141 7,7v21z"></path>
                                    <path d="M87.756,61.051C84.664,56.788,79.657,54,74,54H53c-9.374,0-17,7.626-17,17v21c0,9.374,7.626,17,17,17h21    c9.374,0,17-7.626,17-17V71c0-0.533-0.032-1.059-0.08-1.58l12.748-12.748l-5.766-5.767L87.756,61.051z M81,92c0,3.86-3.14,7-7,7    H53c-3.86,0-7-3.14-7-7V71c0-3.86,3.14-7,7-7h21c2.917,0,5.42,1.795,6.471,4.336L65.216,83.591L54.928,73.304l-5.656,5.656    l13.576,13.576l0.015-0.016L65.34,95L81,79.34V92z"></path>
                                    <path d="m97.902,131.905l-10.146,10.146c-3.092-4.263-8.099-7.051-13.756-7.051h-21c-9.374,0-17,7.626-17,17v21c0,9.374 7.626,17 17,17h21c9.374,0 17-7.626 17-17v-21c0-0.533-0.032-1.059-0.08-1.58l12.748-12.748-5.766-5.767zm-16.902,41.095c0,3.859-3.14,7-7,7h-21c-3.86,0-7-3.141-7-7v-21c0-3.86 3.14-7 7-7h21c2.917,0 5.42,1.795 6.471,4.336l-15.255,15.255-10.288-10.287-5.656,5.656 13.576,13.576 .015-.016 2.477,2.48 15.66-15.66v12.66z"></path>
                                    <rect width="153" x="113" y="59" height="9"></rect>
                                    <rect width="81" x="113" y="77" height="9"></rect>
                                    <rect width="153" x="113" y="149" height="9"></rect>
                                    <rect width="126" x="113" y="167" height="9"></rect>
                                    <rect width="144" x="113" y="230" height="9"></rect>
                                </g>
                            </g>
                        </svg>
                        Voir le rapport
                    </a>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0; text-align: center; width: 100%;">
                <p>
                    <strong>RAPPEL :</strong><br>
                    Si vous étiez connecté à votre compte, vous pourrez retrouver le rapport d'analyse dans <strong><a style="color: #1d1d1d;" href="{{ $route_user_projects }}">la liste de vos projets analaysés</a></strong>.
                </p>
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