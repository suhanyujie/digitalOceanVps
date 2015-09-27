<dl>
    <dt>文章管理</dt>
    <?php foreach(S('model') as $m):?>
        <?php if($m['enable']==0 ||$m['contribute']==0)continue;?>
    <dd><a href="{|U:'Content/content',array('mid'=>$m['mid'])}" <if value="$hd.get.mid eq $m.mid">class="cur"</if>>{$m.model_name}</a></dd>
    <?php endforeach;?>
<!--    <dd><a href="{|U:'Content/add'}" <if value="ACTION eq 'add'">class="cur"</if>>发表文章</a></dd>-->
<!--    <dd><a href="{|U:'Content/collect'}" <if value="ACTION eq 'collect'">class="cur"</if>>我的收藏</a></dd>-->
</dl>
<dl>
    <dt>帐号管理</dt>
    <dd><a href="{|U:'Account/personal'}" <if value="ACTION eq 'personal'">class="cur"</if>>个人资料</a></dd>
    <dd><a href="{|U:'Account/setPassword'}" <if value="ACTION eq 'setPassword'">class="cur"</if>>修改密码</a></dd>
    <dd><a href="{|U:'Account/setIcon'}" <if value="ACTION eq 'setIcon'">class="cur"</if>>修改头像</a></dd>
    <dd><a href="{|U:'Login/out'}">退出登录</a></dd>
</dl>