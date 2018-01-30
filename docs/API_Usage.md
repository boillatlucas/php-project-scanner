# Utilisation de l'API

## Requirements

- Pour pouvoir utiliser l'API, il faut se connecté pour avoir un token, sinon les appels à l'API renverront :
```
{
    "error": "Unauthenticated."
}
```

- Pour les appels à la base de données (sauf pour le login et le register), le retour comprendra, pour les retours failed ;
```
{
    "return_code": "FAILED",
    "error": "..."
}
```
- Sinon, pour les retours avec succès :
```
{
    "return_code": "OK",
    "count_result": 6,
    "return": [
        ...
    ]
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
  
- **[POST]** http://localhost:8888/api/logout _(déconnecte l'utilisateur en cours)_
- /!\ Bien pensez aux headers 'Accept' et 'Authorization'
  ```
  {
      "success": "You are logout"
  }
  ```
  
- **[POST]** http://localhost:8888/api/project _(stocke en liste d'attente un projet github à analyser)_
  - repository : adresse url d'un repository Github -en .git
  - email _(facultatif)_ : email qui recevra l'alerte de l'analyse terminée.
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
  
- **[GET]** http://localhost:8888/api/project/{slug} _(retourne les logs d'un projet)_
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
                        ...
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
  
- **[GET]** http://localhost:8888/api/user-projects/{analyzed?} _(retourne les projets de l'utilisateur connecté, filtre possible : déjà analysés ou non)_
  - analyzed _(facultatif)_ : vide par défaut = tous les projets | 'analyzed' = projets déjà analysés | 'not-analyzed' = projets pas encore analysés 
  ```
    {
        "return_code": "OK",
        "count_result": 2,
        "return": [
            {
                "id": 13,
                "slug": "5b003a7a1965a79996581b10a19fa1fb5a6f2c57c17f6",
                "email": "d.sandron@it-akademy.fr",
                "repository_url": "https://github.com/dimsand/TP_E-Commerce.git",
                "analyzed": null,
                "created_at": "2018-01-29 14:14:47",
                "updated_at": "2018-01-29 14:14:47",
                "user_id": 1
            },
            {
                "id": 14,
                "slug": "5b003a7a1965a79996581b10a19fa1fb5a6f307f759e4",
                "email": "d.sandron@it-akademy.fr",
                "repository_url": "https://github.com/dimsand/TP_E-Commerce.git",
                "analyzed": null,
                "created_at": "2018-01-29 14:32:31",
                "updated_at": "2018-01-29 14:32:31",
                "user_id": 1
            }
        ]
    }
  ```