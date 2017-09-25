/**
 * Created by zhangshiping on 15-8-6.
 */
var interfaces = [
/*
    {type:'影厅使用类',
        interface:[{
            name:'影片列表查询',
            url:'?class=HallUse&method=getVideoList',
            description:'',
            method:'post',
            params:[
                {name:'keywords',info:'关键字收索','type':'字符串(影片名或影片首字母)',example:'阿凡达',required:false},
                {name:'fields',info:'输出字段','type':'字符串(用","分割)',example:'id,file_name',required:false},
                //{name:'is_new',info:'新片速递','type':'数字(1或0或null)',example:'1',required:false},
                //{name:'is_hot',info:'热播推荐','type':'数字(1或0或null)',example:'1',required:false},
                //{name:'is_score',info:'高分经典','type':'数字(1或0或null)',example:'1',required:false},
                {name:'film_sort',info:'影片排序','type':'1:新片速递 2:热播推荐 3:高分经典 4:影片上映时间',example:'1',required:false},
                {name:'film_source',info:'电影来源','type':'-1:服务端把该参数清空 0:1905电影网 1:派拉蒙影业',example:'0',required:false},
                {name:'video_type',info:'类型','type':'电影类型id(17:恐怖)',example:'17',required:false},
                {name:'video_area',info:'地区','type':'字符串(地区名称)',example:'日本',required:false},
                {name:'video_year',info:'年份','type':'字符串(2014-06)',example:'2014-06',required:false},
                {name:'play_type',info:'是否3D','type':'数字(1:2D, 2:3D)',example:'1',required:false},
                {name:'down_status',info:'下载状态','type':'混合(0：未下载，1：下载中；2：已下载；all: 所有)',example:'2',required:false},
                {name:'v_channels',info:'音轨数','type':'数字(1：单声道；2：双声道；6: 5.1声道)',example:'',required:false},
                {name:'page_size',info:'每页数据大小','type':'数字(15)',example:'15',required:false},
                {name:'page',info:'页数','type':'数字(1)',example:'1',required:false},
                {name:'fields',info:'输出字段','type':'字符串(用","分割)',example:'id,file_name',required:false}
            ],
            result_info:{
                "count":'筛选结果数据总条数',
                "data_list":'数据列表',
                "data_list-0-id":'id',
                "data_list-0-uid":'用户ID'
            }
        },{
            name:'影片详情接口',
            url:'?class=HallUse&method=getVideoInfo',
            description:'',
            method:'post',
            params:[
                {name:'video_id',info:'影片id','type':'数字',example:'233',required:true},
                {name:'is_cloud_video',info:'调取本地下载的本地影片或1905云端影片','type':'数字 0:本地影片 1:1905云端影片 (为兼容以前版本，该值不传入默认=1)',example:'1',required:true},
                {name:'fields',info:'输出字段','type':'字符串(用","分割)',example:'id,file_name',required:false}
            ]
        },{
            name:'影片查询条件字典',
            url:'?class=HallUse&method=getFilmDictionary',
            description:'',
            method:'post',
            params:[],
            result_info:{}
        },{
            name:'遥控器绑定',
            url:'?class=HallUse&method=bindPad',
            description:'返回值:msgCode 0-成功 1-失败 4-影厅不存在 7-影厅停用',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'9',required:true},
                {name:'sid',info:'设备的sid，用于标识app内绑定，可以等于uuid','type':'字符串',example:'88529FA4-BC47-4A4A-BE56-E9C2AA374E89',required:true},
                {name:'version',info:'版本','type':'字符串',example:'1.0',required:true},
                {name:'name',info:'名称','type':'字符串',example:'iPad',required:true},
                {name:'device',info:'设备型号','type':'字符串',example:'',required:true},
                {name:'sn',info:'订单号,手机app必传','type':'字符串',example:'',required:true},
                {name:'uuid',info:'通用唯一识别码','type':'字符串',example:'',required:true},
                {name:'verify',info:'验证码(分支版本！1.5版本无此功能，获取验证码：http://e.ftxjoy.com/mictic_pad_login_account_get.php)','type':'字符串',example:'12812578',required:false}
            ]
        },{
            name:'续订影厅时长',
            url:'?class=HallUse&method=addHallTime',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true},
                {name:'order_info',info:'订单信息','type':'数组json_encode后的字符串(goods_id:卖品id, num:数量)',example:'[{"goods_id":1,"num":5},{"goods_id":2,"num":6}]',required:true},
                {name:'add_second',info:'续订时长','type':'数字(时长是秒)',example:'3600',required:true}
            ],
            result_info:{}
        },{
            name:'呼叫前台',
            url:'?class=HallUse&method=callService',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true},
                {name:'type',info:'呼叫类型','type':'数字',example:'1',required:true}
            ],
            result_info:{}
        },{
            name:'点播影片',
            url:'?class=HallUse&method=playMovie',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true},
                {name:'movie_id',info:'影片id','type':'数字',example:'204',required:true},
                {name:'is_cloud_video',info:'调取本地下载的本地影片或1905云端影片','type':'数字 0:本地影片 1:1905云端影片 (为兼容以前版本，该值不传入默认=1)',example:'1',required:true},
            ],
            result_info:{}
        },{
            name:'获取盒子信息',
            url:'?class=HallUse&method=getLogicBoxConfig',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true}
            ],
            result_info:{}
        },{
            name:'获取遥控器配置',
            url:'?class=HallUse&method=getPadConfig',
            description:'',
            params:[
                {name:'hallNo',info:'房间号','type':'数字(影厅开始时间:hallStartTime, 影厅结束时间:hallEndTime, 提示倒计时开始秒数:countDown, 影厅模式:useModel,1:包场 2:包时)',example:'0051',required:true},
                {name:'getHallUseInfo',info:'获取影厅使用信息','type':'选填',example:'1',required:false},
                {name:'getVideoInfo',info:'获取影片信息','type':'选填',example:'1',required:false},
                {name:'getCinemaInfo',info:'获取影院信息','type':'选填',example:'1',required:false}
            ],
            result_info:{}
        },{
            name:'盒子操作接口',
            url:'?class=HallUse&method=boxControl',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true},
                {name:'mediaControl',info:'播放控制','type':'[{"PLAY":""}] / [{"PAUSE":""}] / [{"STOP":""}] / [{"SETTO":"300"}]',example:'[{"SETTO":"300"}]',required:false},
                {name:'soundControl',info:'声音控制(1-100)','type':'[{"SET":"50"}]',example:'[{"SET":"50"}]',required:false}
            ],
            result_info:{}
        },{
            name:'卖品查询条件字典',
            url:'?class=HallUse&method=getGoodsDictionary',
            description:'',
            method:'post',
            params:[
                
            ],
            result_info:{}
        },{
            name:'卖品列表查询',
            url:'?class=HallUse&method=getGoodsList',
            description:'',
            method:'post',
            params:[
                {name:'category_id',info:'分类id','type':'数字(1或0或null)',example:'1',required:false},
                {name:'goods_sort',info:'卖品排序','type':'json一维数组，key:id, value:0(desc)/1(asc)',example:'[{"1":"0"}]',required:false},
                {name:'search',info:'关键字收索','type':'字符串',example:'可乐',required:false},
                {name:'page_size',info:'每页数据大小','type':'数字(15)',example:'15',required:false},
                {name:'page',info:'页数','type':'数字(1)',example:'1',required:false}
            ],
            result_info:{}
        },{
            name:'提交卖品订单',
            url:'?class=HallUse&method=creatGoodsOrder',
            description:'',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'数字',example:'0051',required:true},
                {name:'order_info',info:'订单信息','type':'数组json_encode后的字符串(goods_id:卖品id, num:数量)',example:'[{"goods_id":1,"num":5},{"goods_id":2,"num":6}]',required:true}
            ]
        },{
            name:'包时续订价格查询',
            url:'?class=HallUse&method=delayPrice',
            description:'返回值:msgCode 0-成功 3-参数错误  7-影厅停用 data 数据列表',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'字符串',example:'401',required:true}
            ],
            result_info:{}
        },{
            name:'消费记录查询(畅饮模式)',
            url:'?class=HallUse&method=consumeInfo',
            description:'返回值:msgCode 0-成功 3-参数错误',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'字符串',example:'004',required:true}
            ],
            result_info:{}
        },{
            name:'获取影厅二维码',
            url:'?class=HallUse&method=creatQr',
            description:'返回值:msgCode 0-成功 3-参数错误',
            method:'post',
            params:[
                {name:'hallNo',info:'房间号','type':'字符串',example:'001',required:true},
                {name:'viewQr',info:'预览二维码','type':'字符串',example:'1',required:false}
            ],
            result_info:{}
        },{
            name:'影片分类',
            url:'?class=XsVideo&method=getVideoClass',
            description:'查询影片分类',
            method:'get',
            params:[
            ],
            result_info:{}
        },{
            name:'盒子登录',
            url:'?class=Common&method=videoBoxLogin',
            description:'盒子登录',
            method:'get',
            params:[
                {name:'mac',info:'mac地址','type':'字符串',example:'',required:true},
                {name:'roomId',info:'房间号','type':'字符串',example:'',required:true},
                {name:'versioncode',info:'版本号','type':'字符串',example:'1',required:true}
            ],
            result_info:{}
        },
        ]
    },
*/ 
    {
        type: '酒店渠道通用',
        interface: [
            {
                name: '绑定房间',
                url: '?class=XsRoom&method=bund',
                description: '根据房间号绑定房间信息',
                method: 'get',
                params: [
                    {name: 'no', info: '房间号', 'type': '字符串', example: '', required: true},
                    {name: 'name', info: '设备名称', 'type': '字符串', example: '', required: true},
                    {name: 'mac', info: 'mac地址', 'type': '字符串', example: '', required: true},
                    {name: 'version', info: '版本号', 'type': '字符串', example: '', required: true},
                ],
                result_info: {}
            },{
                name: '===================================',
                url: '',
                description: '我是分割线',
                method: 'get', 
                params: [],
                result_info: {}
            },
            {
                name: '请求播放接口',
                url: '?class=XsCommon&method=playVideo',
                description: '播放接口',
                method: 'get',
                params: [
                    {name: 'roomId', info: '房间号', 'type': '字符串', example: '', required: true},
					{name: 'video_id', info: '电影id', 'type': '字符串', example: '', required: true},
                ],
                result_info: {}
            },{
                name: '查询播放数据接口',
                url: '?class=Order&method=getOrderData',
                description: '播放接口',
                method: 'get',
                params: [
                    {name: 'order_id', info: '订单ID', 'type': '数字', example: '', required: true},
                    {name: 'video_name', info: '影片名称', 'type': '字符串', example: '', required: true},
                    {name: 'play_time', info: '播放时长', 'type': '数字', example: '', required: true},
                    {name: 'time', info: '播放时长标识', 'type': '数字', example: '', required: true},
                    {name: 'is_end', info: '0开始播，1结束播放', 'type': '数字', example: '', required: true},
                ],
                result_info: {}
            },{
                name: '购买接口',
                url: '?class=XsOrder&method=create',
                description: '购买以及付款接口',
                method: 'get',
                params: [
                    {name: 'roomId', info: '房间号', 'type': '字符串', example: '', required: true},
                    {name: 'video_id', info: '电影id', 'type': '字符串', example: '', required: true},
                    {name: 'play_type', info: '购买类型 1单片 2时段', 'type': '字符串', example: '1', required: true},
                    {name: 'api_select', info: '指定接口', 'type': '字符串', example: 'xxxx-x.x.x', required: false},
                ],
                result_info: {}
            },{
                name: '订单查询（v1.3',
                url: '?class=XsOrder&method=query',
                description: '购买以及付款接口',
                method: 'get',
                params: [
                    {name: 'orderSn', info: '订单号', 'type': '字符串', example: '', required: true},
                    {name: 'roomNumb', info: '房间号', 'type': '字符串', example: '', required: false},
                    {name: 'videoId', info: '影片ID', 'type': '字符串', example: '', required: false},
                ],
                result_info: {}
            },{
                name: '发票设置接口',
                url: '?class=XsOrder&method=setInvoice',
                description: '发票设置接口',
                method: 'get',
                params: [
                    {name: 'orderSn', info: '订单号', 'type': '字符串', example: '', required: true},
                    {name: 'invoice', info: '是否需要发票', 'type': '字符串或整型 1要 0不要', example: '', required: true},
                ],
                result_info: {}
            },{
                name: '任务查询',
                url: '?class=XsCommon&method=videoBoxPollingV2',
                description: '当前任务查询接口',
                method: 'get',
                params: [
                    {name: 'roomId', info: '房间号', 'type': '字符串', example: '', required: true},
                ],
                result_info: {}
            },{
                name: '获取单个影片详情信息 ( v1.3',
                url: '?class=XsVideo&method=getDetail',
                description: 'dev_1.3 版本',
                method: 'get', 
                params: [
                    {name:'hall_no',info:'房间号','type':'字符串',example:'',required:true},
                    {name:'video_id',info:'影片id','type':'字符串',example:'',required:true},
                ],
                result_info: {}
            },{
                name: '===================================',
                url: '',
                description: '我是分割线',
                method: 'get', 
                params: [],
                result_info: {}
            },
            {
                name:'影片列表查询(新2.0)',
                url:'?class=XsVideo&method=getVideoListNew',
                description:'',
                method:'post',
                params:[
                    {name:'keywords',info:'关键字搜索','type':'字符串(影片名或影片首字母)',example:'',required:false},
                    {name:'video_type',info:'类型','type':'电影类型id,例如（17:恐怖，全部：-1）',example:'',required:false},
                    {name:'video_area',info:'国家','type':'字符串(国家名称，例如：中国,-1:全部,-2:更多)',example:'',required:false},
                    {name:'video_year',info:'年份','type':'字符串(2016,-1:全部，-2:更多)',example:'',required:false},
                    {name:'video_copyright',info:'专区','type':'专区ID',example:'',required:false},
                    {name:'page_size',info:'每页数据大小','type':'数字(12)',example:'12',required:false},
                    {name:'page',info:'当前页数','type':'数字(1)',example:'1',required:false},

                ],
                result_info:{}
            },
            {
                name: '获得专题',
                url: '?class=XsHotel&method=getHotelTheme',
                description: '获得专题',
                method: 'get',
                params: [],
                result_info: {}
            },{
                name: '获得专题中的影片详情',
                url: '?class=XsHotel&method=getVideoInfo',
                description: '获得专题中的影片详情',
                method: 'get',
                params: [
                    {name: 'theme_id', info: '专题id', 'type': 'int', example: '1', required: true}
                ],
                result_info: {}
            },
            {
                name: '热播影片',
                url: '?class=XsVideo&method=getHot',
                description: '',
                method: 'get',
                params: [],
                result_info: {}
            },{
                name: '智能推荐影片',
                url: '?class=XsVideo&method=getRecommend',
                description: '',
                method: 'get',
                params: [],
                result_info: {}
            },
            {
                name: '分类影片板块的搜索条件',
                url: '?class=XsVideo&method=getSearchParams',
                description: '',
                method: 'get',
                params: [],
                result_info: {}
            },
            {
                name: '广告',
                url: '?class=XsHotel&method=getAdver',
                description: '',
                method: 'get',
                params: [],
                result_info: {}
            }, 
             {
                name: '根据影片id得到详情信息',
                url: '?class=XsVideo&method=getVideoByVideoId',
                description: '',
                method: 'post',
                params: [
                  {name: 'video_id', info: '影片id', 'type': 'int', example: '1', required: true}
                ],
                result_info: {}
            },
            {
                name: '华数专区',
                url: '?class=XsVideo&method=getSourceList',
                description: '',
                method: 'post',
                params: [
					{name:'keywords',info:'关键字搜索','type':'字符串(影片名或影片首字母)',example:'',required:false},
                    {name:'video_type',info:'类型','type':'电影类型id,例如（17:恐怖，全部：-1）',example:'',required:false},
                    {name:'video_area',info:'国家','type':'字符串(国家名称，例如：中国,-1:全部,-2:更多)',example:'',required:false},
                    {name:'video_year',info:'年份','type':'字符串(2016,-1:全部，-2:更多)',example:'',required:false},
                    {name:'page_size',info:'每页数据大小','type':'数字(12)',example:'12',required:false},
                    {name:'page',info:'当前页数','type':'数字(1)',example:'1',required:false},
                ],
                result_info: {}
            },
            {
                name: '获得专区',
                url: '?class=XsVideo&method=getCopyright',
                description: '获得专区',
                method: 'get',
                params: [],
                result_info: {}
            },

        ]
    },
     {
        type: '小帅渠道独有',
        interface: [
            {
                name: '获取APP首页数据',
                url: '?class=XsVideo&method=getData',
                description: '获取APP首页数据',
                method: 'get',
                params: [
                ],
                result_info: {}
            },
            {
                name:'影片列表查询',
                url:'?class=XsHallUse&method=getVideoList',
                description:'',
                method:'post',
                params:[
                    {name:'keywords',info:'关键字收索','type':'字符串(影片名或影片首字母)',example:'',required:false},
                    {name:'fields',info:'输出字段','type':'字符串(用","分割)',example:'',required:false},
                    //{name:'is_new',info:'新片速递','type':'数字(1或0或null)',example:'1',required:false},
                    //{name:'is_hot',info:'热播推荐','type':'数字(1或0或null)',example:'1',required:false},
                    //{name:'is_score',info:'高分经典','type':'数字(1或0或null)',example:'1',required:false},
                    {name:'film_sort',info:'影片排序','type':'1:新片速递 2:热播推荐 3:高分经典 4:影片上映时间',example:'',required:false},
                    {name:'film_source',info:'电影来源','type':'-1:服务端把该参数清空 0:1905电影网 1:派拉蒙影业',example:'',required:false},
                    {name:'video_type',info:'类型','type':'电影类型id(17:恐怖)',example:'',required:false},
                    {name:'video_area',info:'地区','type':'字符串(地区名称)',example:'',required:false},
                    {name:'video_year',info:'年份','type':'字符串(2014-06)',example:'',required:false},
                    {name:'play_type',info:'是否3D','type':'数字(1:2D, 2:3D)',example:'',required:false},
                    {name:'down_status',info:'下载状态','type':'混合(0：未下载，1：下载中；2：已下载；all: 所有)',example:'',required:false},
                    {name:'v_channels',info:'音轨数','type':'数字(1：单声道；2：双声道；6: 5.1声道)',example:'',required:false},
                    {name:'page_size',info:'每页数据大小','type':'数字(15)',example:'15',required:false},
                    {name:'page',info:'页数','type':'数字(1)',example:'1',required:false},
                    {name:'fields',info:'输出字段','type':'字符串(用","分割)',example:'',required:false}
                ],
                result_info:{
                    "count":'筛选结果数据总条数',
                    "data_list":'数据列表',
                    "data_list-0-id":'id',
                    "data_list-0-uid":'用户ID'
                }
            },
            {
                name: 'Top12',
                url: '?class=XsVideo&method=getTop12',
                description: '',
                method: 'post',
                params: [ 
                  
                ],
                result_info: {}
            },
             {
                name: '小帅店长推荐',
                url: '?class=XsHotel&method=getSystemTheme', 
                description: '',
                method: 'post',
                params: [
                  
                ],
                result_info: {}
            },{
                name: '小帅店长推荐封面图',
                url: '?class=XsHotel&method=getSystemThemePic', 
                description: '',
                method: 'post',
                params: [
                  
                ],
                result_info: {}
            },
        ]
    },
    {
        type: '携旅渠道独有',
        interface: [
           {
                name: 'lanch片花',
                url: '?class=XsLanch&method=getLanchVideo',
                description: '',
                method: 'post',
                params: [],
                result_info: {}
            },
            {
                name: 'lanch海报',
                url: '?class=XsLanch&method=getLanchPic',
                description: '',
                method: 'post',
                params: [],
                result_info: {}
            },
        ]
    },

    // {
    //     type:'影片合集类',
    //     interface:[{
    //         name:'获取影片合集',
    //         url:'?class=Video&method=getFilmCollection',
    //         description:'',
    //         method:'post',
    //         params:[ ],
    //         result_info:{}
    //     },
    //     {
    //         name:'获取影片合集内影片的详情',
    //         url:'?class=Video&method=getFilmCollectionDetail',
    //         description:'',
    //         method:'post',
    //         params:[
    //             {name:'id',info:'影片合集 id','type':'数字',example:'1',required:true},
    //             {name:'page_size',info:'每页数据大小','type':'数字(15)',example:'15',required:false},
    //             {name:'page',info:'页数','type':'数字(1)',example:'0',required:false}
    //         ],
    //         result_info:{}}
    //     ]
    // },
    {
        type:'安美渠道独有',
        interface:[{
            name:'请求挂账',
            url:'?class=Amtt&method=setOnAccount',
            description:'status=1时挂账成功',
            method:'post',
            params:[
                {name:'pay_method',info:'购买方式','type':'整形',example:'8',required:true},
                {name:'order_sn',info:'订单号','type':'字符串',example:'170303168231',required:true},
            ],
            result_info:{}
        }]
    },
    {
        type:'apk相关',
        interface:[
        {
            name:'酒店apk升级',
            url:'?class=AppAuto&method=appAuto',
            description:'',
            method:'get',
            params:[
                {name:'appId',info:'apk标识码','type':'字符串',example:'202',required:true},
                {name:'versionCode',info:'apk当前版本','type':'字符串',example:'1',required:true},
            ]
        },{
                name: '获取apk日志数据',
                url: '?class=XsCommon&method=logData',
                description: '',
                method: 'get',
                params: [
                  {name: 'module', info: '模块名称', 'type': '字符串', example: '主题推荐', required: true},
                  {name: 'result', info: '结果说明', 'type': '字符串', example: '海报错误', required: true},
                  {name: 'result_status', info: '结果数字', 'type': 'int', example: '1', required: true},
                  {name: 'content', info: '自定义透明参数', 'type': '字符串', example: '', required: false},
                ],
                result_info: {}
        },{
            name:'apk升级配置文件修改',
            url:'?class=AppAuto&method=updateCfg',
            description:'升级测试，线上勿用！！！',
            method:'get',
            params:[
                {name:'versionCode',info:'apk版本','type':'字符串',example:'1',required:false},
                {name:'requestInterval',info:'apk请求间隔','type':'字符串',example:'1',required:false},
                {name:'versionName',info:'','type':'字符串',example:'',required:false},
                {name:'info',info:'','type':'字符串',example:'',required:false},
                {name:'token',info:'','type':'字符串',example:'JIOF453Jioji3jOJFdojasf',required:true},
            ]
        },
        ]
    },{
        type:'附加接口',
        interface:[
        {
                name: '查看缓存中的数据',
                url: '?class=Monitor&method=getCache',
                description: '查看缓存中的数据',
                method: 'get',
                params: [],
                result_info: {}
        },{
                name: '累计断网时间',
                url: '?class=XsHotel&method=getNetTime',
                description: '',
                method: 'get',
                params: [],
                result_info: {}
        },{
                name: '酒店帐号状态获取',
                url: '?class=XsHotel&method=getHotelStatus',
                description: '根据当前主机号获取酒店帐号状态是否被停用',
                method: 'get',
                params: [
      
                ],
                result_info: {}
            },
        ]
    },
 
];