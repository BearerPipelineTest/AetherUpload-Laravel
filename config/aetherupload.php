<?php

return [

    # 【分布式设置】：如启用分布式部署，此类配置项必须在应用服务器与储存服务器都进行配置。 #
    # 【一般设置】：只需在储存服务器配置。 #

    /*
    |--------------------------------------------------------------------------
    | 分布式部署
    |--------------------------------------------------------------------------
    |
    | 【分布式设置】使应用服务与储存服务分离，启用后资源上传请求将会由储存服务器处理。
    |
    */

    'distributed_deployment' => [

        'enable' => false, # 是否启用

        'role' => 'web', # 服务器角色，支持选项: 'web', 'storage'

        'web' => [ # 角色为应用服务器
            'storage_host' => '', # 储存服务器的host，如'http://storage.example.com'
        ],

        'storage' => [ # 角色为储存服务器
            'middleware_cors' => '', # 跨域中间件AetherUploadCORS类在Kernel.php中注册的名称
            'allow_origin'    => [], # 跨域中间件允许的应用服务器来源host，如['http://www.example.com']
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | 上传根目录名
    |--------------------------------------------------------------------------
    |
    | 【一般设置】位于 storage/app/ 下，修改默认值后需执行artisan命令aetherupload:groups生成对应目录。
    |
    | 注意：确定后请勿再更改！
    |
    */

    'root_dir' => 'aetherupload',

    /*
    |--------------------------------------------------------------------------
    | 上传分块大小（B）
    |--------------------------------------------------------------------------
    |
    | 【一般设置】建议1MB～4MB之间，较小值占用内存少、效率低，较大值占用内存多、效率高，需要小于web服务器和php.ini中的上传限值。
    |
    */

    'chunk_size' => 1000000,

    /*
    |--------------------------------------------------------------------------
    | 子目录生成规则
    |--------------------------------------------------------------------------
    |
    | 【一般设置】分为按年份、按月份、按日期、常量subdir。
    |
    | 支持选项: 'year', 'month', 'date', 'const'
    |
    */

    'resource_subdir_rule' => 'month',

    /*
    |--------------------------------------------------------------------------
    | 头文件储存方式
    |--------------------------------------------------------------------------
    |
    | 【一般设置】头文件储存disk的配置名称，如果为"redis"，需在config/filesystems.php中添加以下配置。
    | 'disks' => [
    |     ...
    |     'redis' => [
    |        'driver' => 'redis',
    |        'disable_asserts'=>true,
    |     ],
    |     ...
    | ]
    |
    | 支持选项: 'local', 'redis'
    |
    */

    'header_storage_disk' => 'local',

    /*
    |--------------------------------------------------------------------------
    | 资源文件后缀名黑名单
    |--------------------------------------------------------------------------
    |
    | 【一般设置】被禁止资源文件的后缀名集合，凡是匹配成功的资源文件均会被阻止上传，可在一定程度上防范恶意文件上传。
    |
    */

    'forbidden_extensions' => ['php', 'part', 'html', 'shtml', 'htm', 'shtm', 'xhtml', 'xml', 'js', 'jsp', 'asp', 'java', 'py', 'sh', 'bat', 'exe', 'dll', 'cgi', 'htaccess', 'reg', 'aspx', 'vbs'],

    /*
    |--------------------------------------------------------------------------
    | 资源分组
    |--------------------------------------------------------------------------
    |
    | 【一般设置】可设置多个不同分组，各自拥有独立配置。新增分组并配置后，需执行artisan命令aetherupload:groups创建对应目录。
    |
    */

    'groups' => [

        'file' => [ # 分组名
            'group_dir'                    => 'file', # 分组目录名
            'resource_maxsize'             => 0, # 被允许的资源文件最大值(B)，0为不限制，32位系统最大值为2147483647
            'resource_extensions'          => [], # 被允许的资源文件扩展名(白名单)，空为不限制
            'middleware_preprocess'        => [], # 上传预处理时的路由中间件
            'middleware_save_chunk'        => [], # 上传文件分块时的路由中间件
            'middleware_display'           => [], # 文件展示时的路由中间件
            'middleware_download'          => [], # 文件下载时的路由中间件
            'event_before_upload_complete' => '', # 上传完成前触发的事件(完整临时文件)，PartialResource类的实例被注入
            'event_upload_complete'        => '', # 上传完成后触发的事件(完整资源文件)，Resource类的实例被注入
        ],

    ],
];