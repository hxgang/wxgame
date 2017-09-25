<extend name="Common:index"/>
<block name="center">
    <div class="list-div" id="listDiv">
        <input type="button" class="button ajax-post" url="{:U('changeStatus')}" value="删除选中"/>
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th width="50px">序号<input type="checkbox"  class="all"/></th>
                <?php foreach($fields as $field):
              if($field['key']=='PRI'){
                    continue;
              }
               $comment = strpos($field['comment'],'@')===false?$field['comment']:strstr($field['comment'],'@',true);//将简介中前面的部分截取出来
             ?>
                <th><?php echo $comment?></th>
                <?php endForeach;?>
                <th>操作</th>
            </tr>
            <volist name="rows" id="row">
                <tr>
                    <td align="center"><input type="checkbox" name="id[]" class="id" value="{$row.id}"/></td>
                    <?php foreach($fields as $field){
                    if($field['key']=='PRI'){
                            continue;
                    }

                    if($field['field']=='status'){
                       echo '<td align="center"><a class="ajax-get" href="{:U(\'changeStatus\',array(\'id\'=>$row[\'id\'],\'status\'=>1-$row[\'status\']))}"><img src="__IMG__/{$row.status}.gif" alt=""/></a></td>';
                    echo "\r\n";
                    }else{
                       echo "<td align='center'>{\$row.{$field['field']}}</td>\r\n";
                    }
                    } ?>
                    <td align="center">
                        <a href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
                        <a class="ajax-get" href="{:U('changeStatus',array('id'=>$row['id']))}" title="移除">移除</a>
                    </td>
                </tr>
            </volist>
        </table>
        <div class="page">
            {$pageHtml}
        </div>
    </div>
</block>