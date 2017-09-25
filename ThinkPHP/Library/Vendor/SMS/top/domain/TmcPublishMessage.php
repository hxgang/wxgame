<?php

/**
 * tmc消息
 * @author auto create
 */
class TmcPublishMessage
{
	
	/** 
	 * 消息内容的JSON表述，必须按照topic的定义来填充
	 **/
	public $content;
	
	/** 
	 * 消息的扩增属性，用json格式表示
	 **/
	public $json_ex_content;
	
	/** 
	 * 直发消息需要传入目标appkey
	 **/
	public $target_app_key;
	
	/** 
	 * 消息类型
	 **/
	public $topic;	
}
?>