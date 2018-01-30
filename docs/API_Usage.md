# Utilisation de l'API

## Requirements

- Pour pouvoir utiliser l'API, il faut se connecté pour avoir un token, sinon les appels à l'API renverront :
```
{
    "error": "Unauthenticated."
}
```
- Pour chaque appel à l'API (sauf pour le login et le register), il faut spécifier deux headers à la requete (avec {accessToken} = le token retourné lors du login ou le register )
```

'headers' => [
    'Accept' => 'application/json',
    'Authorization' => 'Bearer {accessToken}',
]
```

## Actions

- **[POST]** http://localhost:8888/api/register _(enregistre un nouvel user en base et retourne un token pour l'user)_
  - name : nom du compte
  - email : email pour se connecter au compte
  - password : mot de passe pour se connecter au compte
  - c_password : retaper le même mot de passe
  ```
    {
        "success": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY1ZDI2MmU4YTQ5ZDAxZmE1YjM1NjRiZmVhNTYzMWQ3NGM1ZTllOGM2MDg3ZmMwMDM0MmMyY2M1YWUzOTU4MjliMmIxZjY0NDE5OWMwYTM4In0.eyJhdWQiOiIzIiwianRpIjoiNjVkMjYyZThhNDlkMDFmYTViMzU2NGJmZWE1NjMxZDc0YzVlOWU4YzYwODdmYzAwMzQyYzJjYzVhZTM5NTgyOWIyYjFmNjQ0MTk5YzBhMzgiLCJpYXQiOjE1MTczMDIwMzUsIm5iZiI6MTUxNzMwMjAzNSwiZXhwIjoxNTQ4ODM4MDM1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.hsgTA0zivSpg96GONesCiOjzAHcc8T-RB3uJokeeBLM_U6mhIT5MzSnd0ca7Vbmu58CsGt3nNcdjQyec3GKJrvDpmN0LhYGO_VWizaPJsOxbCQ15FHd4IcyfVBfNGcahQj5LNxxYXTCK7UJZ3i_IyGAGyDnKDJFe3gYtNklxhrij_OOhXpo5ILchjqsd0RmK56vgQrI8Wv8Zcws4Qz_r31iF4JkGmVna09QUOKvsjFeEvCMhs_2gh5CDM9tc1ghg9H-cY-oa804WM752qu2kVFlCcIk4SoAlei99cHafWuaxHRKY2pR_AXVPdP4Y_D2HJ9sX5hpMzOLcmAxeuUrN2FoSmO0OJl8tZO_RUdN6Yop1utBGGuvAQsnjJhB8QxmeT5QMB95Ze4AxWMJUxWFQQ1G7lgz0qH5UM_ySCCaeYoqR3MnGpUw_bH9zwbGQ55Lt1f8z7DW6xCFsqfRoU-CdqcIqph5CZ7mLIRs-44Bf3WFK527Q1AZB-sSQehx_DDijI-fqL4do6e3Aa6Lm4ITTyfn-WCSF6TCAWXhgbd6h-I5duQFQL_0G_6T1AOtNBbFCk2MrisIBjFBvvAPbUNKaLDt1zKPqjvYZswpJfhEKLBE6fT1Pi57Ac5stfoQ88SSp2q1G2JEAzZTvt7m3kZAxiSHSUT4nPfmHDDem-7rjtF4",
            "name": "Test"
        }
    }
  ```
  
- **[POST]** http://localhost:8888/api/login _(retourne un token pour l'user)_
  - email : email du compte
  - password : mot de passe du compte
  ```
    {
        "success": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjgxOGI5MGFmNjBiY2NmODZmYjllZTFiMjk0ZjY1YjZiNGY4ZGViMWI1YzAxOTM4NDk0MzI1NGYwYzlhMDg1NzVkNmRiMDk1ZGVmMGI2YmFjIn0.eyJhdWQiOiIzIiwianRpIjoiODE4YjkwYWY2MGJjY2Y4NmZiOWVlMWIyOTRmNjViNmI0ZjhkZWIxYjVjMDE5Mzg0OTQzMjU0ZjBjOWEwODU3NWQ2ZGIwOTVkZWYwYjZiYWMiLCJpYXQiOjE1MTczMDU4OTksIm5iZiI6MTUxNzMwNTg5OSwiZXhwIjoxNTQ4ODQxODk5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.XMMbWogThr-m07UxUOPvbhEvNVmtfkdrF_nv81phCFs-IucEydBogdReiUJjHHxeWzx_ZSAIq6ErJTF9PySK0cgVvWUwuB28CnmpsEjFBKAOY8zRw3saOaI-aR8jaS8ZrmSxkEt2YaiTEL-LCqeuGKEQamRBro5pxedOKsfD6xIGaD97LEw3KADFJpPLUtaUomgTOLyIyc0A5WQ3PjJgG-GhXHnu8_mRWmPGcbnZg71XnhmKlo-l3lBr7ZFCugZ-_BKNG_1iLmJshjkqtbMYV9AjLvwoiVPvECfjSPJHA_0vPQ1_IQT8C9y7ZRMYeg4JtuR3mtIxcVre15mEdTi5dAMKC0o419RqrNyQBq8G5yFZ3n28D0uGQ1KJ6axuxaKnJpgNH3y-Wp00EaNKlmBQEvLlXbSWenjdvZOCZqQY94UQKs-_VvlZ0QnVX1wp2DHgmDnk850O-CFsP7Pr63ZIqWwKElGr0ZTmnM_iBNAkrgNEZ99410NTYmWWcot2qyCxK_czkkQlmEbKqQxuSgl3NbEm79xo7mOfIo3AzBlmuHxBFvfgqFVLZcA0Hx8kPICZ-myzQIe8RsWKiJ4DWYPjQwXlqEdh3lKY98A31wp5QjtFF0KZUN2QTuAK8BvWwNxTX3ebAH9PzK40SuArv_l2CHw3-0I7wdhKK12Ku7ZnwOc"
        }
    }
  ```
  
- **[POST]** http://localhost:8888/api/get-details _(retourne les infos de l'user connecté)_
  ```
    {
        "success": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjgxOGI5MGFmNjBiY2NmODZmYjllZTFiMjk0ZjY1YjZiNGY4ZGViMWI1YzAxOTM4NDk0MzI1NGYwYzlhMDg1NzVkNmRiMDk1ZGVmMGI2YmFjIn0.eyJhdWQiOiIzIiwianRpIjoiODE4YjkwYWY2MGJjY2Y4NmZiOWVlMWIyOTRmNjViNmI0ZjhkZWIxYjVjMDE5Mzg0OTQzMjU0ZjBjOWEwODU3NWQ2ZGIwOTVkZWYwYjZiYWMiLCJpYXQiOjE1MTczMDU4OTksIm5iZiI6MTUxNzMwNTg5OSwiZXhwIjoxNTQ4ODQxODk5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.XMMbWogThr-m07UxUOPvbhEvNVmtfkdrF_nv81phCFs-IucEydBogdReiUJjHHxeWzx_ZSAIq6ErJTF9PySK0cgVvWUwuB28CnmpsEjFBKAOY8zRw3saOaI-aR8jaS8ZrmSxkEt2YaiTEL-LCqeuGKEQamRBro5pxedOKsfD6xIGaD97LEw3KADFJpPLUtaUomgTOLyIyc0A5WQ3PjJgG-GhXHnu8_mRWmPGcbnZg71XnhmKlo-l3lBr7ZFCugZ-_BKNG_1iLmJshjkqtbMYV9AjLvwoiVPvECfjSPJHA_0vPQ1_IQT8C9y7ZRMYeg4JtuR3mtIxcVre15mEdTi5dAMKC0o419RqrNyQBq8G5yFZ3n28D0uGQ1KJ6axuxaKnJpgNH3y-Wp00EaNKlmBQEvLlXbSWenjdvZOCZqQY94UQKs-_VvlZ0QnVX1wp2DHgmDnk850O-CFsP7Pr63ZIqWwKElGr0ZTmnM_iBNAkrgNEZ99410NTYmWWcot2qyCxK_czkkQlmEbKqQxuSgl3NbEm79xo7mOfIo3AzBlmuHxBFvfgqFVLZcA0Hx8kPICZ-myzQIe8RsWKiJ4DWYPjQwXlqEdh3lKY98A31wp5QjtFF0KZUN2QTuAK8BvWwNxTX3ebAH9PzK40SuArv_l2CHw3-0I7wdhKK12Ku7ZnwOc"
        }
    }
  ```
  
- **[POST]** http://localhost:8888/api/project
  - repository : adresse url d'un repository Github -en .git
  - email : email qui recevra l'alerte de l'analyse terminée
  ```
    {
        "return_code": "OK",
        "return": {
            "url_project_logs": "http://localhost:8888/api/project/5b003a7a1965a79996581b10a19fa1fb5a704584ee6e3",
            "project_saved": {
                "slug": "5b003a7a1965a79996581b10a19fa1fb5a704584ee6e3",
                "email": "d.sandron@it-akademy.fr",
                "repository_url": "https://github.com/dimsand/TP_E-Commerce.git",
                "updated_at": "2018-01-30 10:14:28",
                "created_at": "2018-01-30 10:14:28",
                "id": 28
            }
        }
    }
  ```
  
- **[GET]** http://localhost:8888/api/project/{slug}
  - slug : slug d'un projet en base
  ```
    {
        "return_code": "OK",
        "count_result": 4,
        "return": {
            "id": 24,
            "slug": "5b003a7a1965a79996581b10a19fa1fb5a7035649923a",
            "email": "d.sandron@it-akademy.fr",
            "repository_url": "https://github.com/dimsand/TP_E-Commerce.git",
            "analyzed": "2018-01-30 09:09:19",
            "created_at": "2018-01-30 09:05:40",
            "updated_at": "2018-01-30 09:09:19",
            "logs": [
                {
                    "id": 85,
                    "title": "PHPCodeFixer",
                    "status": "0",
                    "project_id": 24,
                    "log_type_id": 1,
                    "created_at": "2018-01-30 09:09:15",
                    "updated_at": "2018-01-30 09:09:15",
                    "logs_lines": [
                        {
                            "id": 1345,
                            "content": "OCI runtime exec failed: exec failed: container_linux.go:296: starting container process caused \"exec: \\\"/root/.composer/vendor/bin/phpcs\\\": stat /root/.composer/vendor/bin/phpcs: no such file or directory\": unknown",
                            "log_id": 85,
                            "created_at": null,
                            "updated_at": null
                        }
                    ],
                    "log_type": {
                        "id": 1,
                        "type": "stats"
                    }
                },
                {
                    "id": 86,
                    "title": "PHPCPD",
                    "status": "1",
                    "project_id": 24,
                    "log_type_id": 2,
                    "created_at": "2018-01-30 09:09:15",
                    "updated_at": "2018-01-30 09:09:15",
                    "logs_lines": [
                        {
                            "id": 1346,
                            "content": "PHP 7.1.12 | 10 parallel jobs",
                            "log_id": 86,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1347,
                            "content": "Checked 11 files in 0 seconds",
                            "log_id": 86,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1348,
                            "content": "No syntax error found",
                            "log_id": 86,
                            "created_at": null,
                            "updated_at": null
                        }
                    ],
                    "log_type": {
                        "id": 2,
                        "type": "syntax"
                    }
                },
                {
                    "id": 87,
                    "title": "PHPCPD",
                    "status": "1",
                    "project_id": 24,
                    "log_type_id": 1,
                    "created_at": "2018-01-30 09:09:15",
                    "updated_at": "2018-01-30 09:09:15",
                    "logs_lines": [
                        {
                            "id": 1349,
                            "content": "phploc 4.0.1 by Sebastian Bergmann.",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1350,
                            "content": "Directories                                          1",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1351,
                            "content": "Files                                               11",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1352,
                            "content": "Size",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1353,
                            "content": "  Lines of Code (LOC)                              537",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1354,
                            "content": "  Comment Lines of Code (CLOC)                      12 (2.23%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1355,
                            "content": "  Non-Comment Lines of Code (NCLOC)                525 (97.77%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1356,
                            "content": "  Logical Lines of Code (LLOC)                     149 (27.75%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1357,
                            "content": "    Classes                                          0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1358,
                            "content": "      Average Class Length                           0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1359,
                            "content": "        Minimum Class Length                         0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1360,
                            "content": "        Maximum Class Length                         0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1361,
                            "content": "      Average Method Length                          0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1362,
                            "content": "        Minimum Method Length                        0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1363,
                            "content": "        Maximum Method Length                        0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1364,
                            "content": "    Functions                                       50 (33.56%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1365,
                            "content": "      Average Function Length                        5",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1366,
                            "content": "    Not in classes or functions                     99 (66.44%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1367,
                            "content": "Cyclomatic Complexity",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1368,
                            "content": "  Average Complexity per LLOC                     0.48",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1369,
                            "content": "  Average Complexity per Class                    0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1370,
                            "content": "    Minimum Class Complexity                      0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1371,
                            "content": "    Maximum Class Complexity                      0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1372,
                            "content": "  Average Complexity per Method                   0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1373,
                            "content": "    Minimum Method Complexity                     0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1374,
                            "content": "    Maximum Method Complexity                     0.00",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1375,
                            "content": "Dependencies",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1376,
                            "content": "  Global Accesses                                   45",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1377,
                            "content": "    Global Constants                                23 (51.11%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1378,
                            "content": "    Global Variables                                 0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1379,
                            "content": "    Super-Global Variables                          22 (48.89%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1380,
                            "content": "  Attribute Accesses                                 0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1381,
                            "content": "    Non-Static                                       0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1382,
                            "content": "    Static                                           0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1383,
                            "content": "  Method Calls                                       0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1384,
                            "content": "    Non-Static                                       0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1385,
                            "content": "    Static                                           0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1386,
                            "content": "Structure",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1387,
                            "content": "  Namespaces                                         0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1388,
                            "content": "  Interfaces                                         0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1389,
                            "content": "  Traits                                             0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1390,
                            "content": "  Classes                                            0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1391,
                            "content": "    Abstract Classes                                 0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1392,
                            "content": "    Concrete Classes                                 0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1393,
                            "content": "  Methods                                            0",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1394,
                            "content": "    Scope",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1395,
                            "content": "      Non-Static Methods                             0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1396,
                            "content": "      Static Methods                                 0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1397,
                            "content": "    Visibility",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1398,
                            "content": "      Public Methods                                 0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1399,
                            "content": "      Non-Public Methods                             0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1400,
                            "content": "  Functions                                         10",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1401,
                            "content": "    Named Functions                                 10 (100.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1402,
                            "content": "    Anonymous Functions                              0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1403,
                            "content": "  Constants                                          9",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1404,
                            "content": "    Global Constants                                 9 (100.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1405,
                            "content": "    Class Constants                                  0 (0.00%)",
                            "log_id": 87,
                            "created_at": null,
                            "updated_at": null
                        }
                    ],
                    "log_type": {
                        "id": 1,
                        "type": "stats"
                    }
                },
                {
                    "id": 88,
                    "title": "PHPCPD",
                    "status": "1",
                    "project_id": 24,
                    "log_type_id": 1,
                    "created_at": "2018-01-30 09:09:19",
                    "updated_at": "2018-01-30 09:09:19",
                    "logs_lines": [
                        {
                            "id": 1406,
                            "content": "phpcpd 3.0.1 by Sebastian Bergmann.",
                            "log_id": 88,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1407,
                            "content": "0.00% duplicated lines out of 537 total lines of code.",
                            "log_id": 88,
                            "created_at": null,
                            "updated_at": null
                        },
                        {
                            "id": 1408,
                            "content": "Time: 11 ms, Memory: 4.00MB",
                            "log_id": 88,
                            "created_at": null,
                            "updated_at": null
                        }
                    ],
                    "log_type": {
                        "id": 1,
                        "type": "stats"
                    }
                }
            ]
        }
    }
  ```