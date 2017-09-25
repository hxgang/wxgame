'use strict';
(function($){
    //红包初始化
    var redEnvelope_defaults = {
        imgSize_width:70,//红包的宽度 px
        _class:'envelope',//红包的样式
    };
    var $envelopeObj = null;
    var Init;
    Init =(function(){
        function Init(element,options){
            this.$settings = $.extend({}, $.fn.redEnvelope.defaults, options);
            this.$element = $(element);
            this.init();
        }        
        //游戏初始化
        Init.prototype.init = function(){
            if(this.$settings != undefined || this.$settings != null ){
                for(var option in this.$settings){
                    redEnvelope_defaults[option] = this.$settings[option];
                }
            }
            $envelopeObj = this.$element;
            gameInit();
        }
        
        Init.prototype.stop = function(){
            stopGame();
        }
        return Init;
    })();
    
    $.fn.redEnvelope = function(options,$arg){
        var retrunValue = null;
        this.each(function(){
            var $me = $(this),
            instance = $me.data('redEnvelope');
            if(!instance){
                $me.data('redEnvelope',new Init(this, options));
            }
            if ($.type(options) === 'string') {
                retrunValue = instance[options]($arg);
            }
            if(retrunValue === null){
                return this;
            }else{
                return retrunValue;
            }
        });
    }
    //游戏初始化属性
    $.fn.redEnvelope.defaults = {
        
    };
    var envInterval =null;
    function gameInit(){
        //绾㈠寘鍒濆鍖�
        envInterval = setInterval(InitEnv,500); 
    }
    function InitEnv (){
        var imgEnv = document.createElement('img');
        imgEnv.src = '/Public/VOne/images/fd'+Math.floor(Math.random() * 6)+'.png';
        imgEnv.style.width = redEnvelope_defaults.imgSize_width+'px';
        imgEnv.setAttribute('class',redEnvelope_defaults._class);
        imgEnv.addEventListener('touchend',redEnvelope_defaults.clickFun);
        evnPosition(imgEnv,$envelopeObj);
    }
    function evnPosition (img){
        var containerWidth = $envelopeObj.width();
        var containerHeight = window.screen.height;
        $envelopeObj.prepend(img);
        //绾㈠寘鍒濆鐨勪綅缃�
        var startTop = 10+"%";
        var moveTop = 80+ "%";
        var startLeft = 0.5*containerWidth;//parseInt(Math.random()*(150-100)+100)
        //绉诲姩鐨勪綅缃�
        var moveLeft = parseInt(Math.random()*containerWidth+(-(containerWidth/2)));
        var time=parseInt(Math.random() * 1400+1800);
        evnAnimation({'startLeft':startLeft, 'startTop':startTop, 'moveLeft':moveLeft,'moveTop':moveTop},time); 
    }
    /*娣诲姞鍏冪礌鍒颁富鍐呭涓�*/
    function evnAnimation (posObject,time){
        $envelopeObj.children('img:first').css({'left':posObject.startLeft,'top':posObject.startTop});
        $envelopeObj.children('img:first').animate(
            {
                'left':posObject.startLeft-posObject.moveLeft,
                'top':posObject.moveTop
            },
            time,
            'linear',
            function(){
                $(this).remove();
            }
        );
    
    }
    function stopGame(){
        clearInterval(envInterval);
    }
})($);