# Note

* file ```backend/main-local.php```
```
<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nMLsaeY2CJgTbWWFWMp66bKey1iz3the',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // HERE
            'enhanced-gii-crud' => [
                'templates'=>[ 
                    'default' => '@vendor/mootensai/yii2-enhanced-gii/crud/default',
                    'enhanged' => '@backend/generators/custom/default',
                ]
            ]
        ],
    ];
}

return $config;

```


## TODOs List

- [ ] Depend dropdown at absensi.
- [ ] Upload image at Siswa, Pegawai, and Wali Murid
- [ ] Detail Point [ Update Otomatis ]
- [ ] Akumulasi Point [ Action Reset Per semester ]
- [ ] Surat Peringatan
- [ ] Advanced Search
    - [ ] Date Search Error 
    - [ ] Kelas [ kelas ] search
    - [ ] Pelanggaran [ Next... ]
- [ ] Jurusan View
- [ ] Delete Tanggal Efektif [ maybe ]
- [ ] Filters
    - [ ] Absensi [ Tanggal Efektif ]
    - 
- [ ] Roles
- [ ] APIs Android
- [ ] Pair Unique at Prestasi, Pelanggaran, Absensi , Etc
- [x] Model label
- [ ] CRUD 
    - [ ] Akumulasi Point
    - [ ] Detail Point (R)
    - [ ] Sanksi
    - [ ] SP
    - [ ] User
- [ ] Etc