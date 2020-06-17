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

- [ ] Dependent dropdown.
    - [ ] Pelanggaran Filter
    - [ ] Prestasi Filter
    - [ ] Absensi
- [ ] Upload image at Siswa, Pegawai, and Wali Murid
- [ ] Detail Point [ Update Otomatis ]
- [ ] Akumulasi Point [ Action Reset Per semester ]
- [ ] Surat Peringatan
- [x] Advanced Search
    - [x] Date Search Error 
    - [x] Kelas [ kelas ] search
- [ ] Jurusan View
- [ ] Delete Tanggal Efektif [ maybe ]
- [ ] Filters
    - [ ] Absensi [ Tanggal Efektif ]
    - [ ] Pelanggaran [ Add kelas - for depend dropdown, Point - Number ]
    - [ ] Prestasi [ Add Kelas - for depend dropdown]
    - [ ]
- [ ] Roles
- [ ] APIs Android
- [ ] View Show Detail
    - [ ] Agama jumlah siswa [ set to only active student ]
- [ ] Pair Unique at Prestasi, Pelanggaran, Absensi , Etc
- [x] Model label
- [ ] Structure Updated
    - [ ] Add Active Status at Kelas
- [ ] CRUD 
    - [ ] Akumulasi Point
    - [ ] Detail Point (R)
    - [x] Sanksi
    - [ ] SP
    - [ ] User
- [ ] Etc