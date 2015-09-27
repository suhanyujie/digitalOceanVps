<include file="__PUBLIC__/header"/>
	<body>
    <js file="__STATIC__/cal/lhgcalendar.min.js"/>
			<form class="hd-form" method="get">
				<input type="hidden" name="m" value="{$hd.get.m}"/>
                <input type="hidden" name="c" value="{$hd.get.c}"/>
                <input type="hidden" name="a" value="{$hd.get.a}"/>
				<input type="hidden" name="mid" value="{$hd.get.mid}"/>
				<input type="hidden" name="cid" value="{$hd.get.cid}"/>
				<input type="hidden" name="state" value="{$hd.get.state}"/>
				<div class="search">
					添加时间：
					<input id="begin_time" placeholder="开始时间" readonly="readonly" class="hd-w80" type="text" value="{$hd.get.search_begin_time}" name="search_begin_time">
					<script>
						$('#begin_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					-
					<input id="end_time" placeholder="结束时间" readonly="readonly" class="hd-w80" type="text" value="{$hd.get.search_end_time}" name="search_end_time">
					<script>
						$('#end_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					&nbsp;&nbsp;&nbsp;
					<select name="flag" class="hd-w100">
						<option selected="" value="">全部</option>
						<list from="$flag" name="$f">
							<option value="{$f}" <if value="$hd.get.flag eq $f">selected=''</if>>{$f}</option>
						</list>
					</select>
					&nbsp;&nbsp;&nbsp;
					<select name="search_type" class="hd-w100">
						<option value="1" <if value="$hd.get.search_type eq 1">selected=''</if>>标题</option>
						<option value="2" <if value="$hd.get.search_type eq 2">selected=''</if>>简介</option>
						<option value="3" <if value="$hd.get.search_type eq 3">selected=''</if>>用户名</option>
						<option value="4" <if value="$hd.get.search_type eq 4">selected=''</if>>用户uid</option>
					</select>&nbsp;&nbsp;&nbsp;
					关键字：
					<input class="hd-w200" type="text" placeholder="请输入关键字..." value="{$hd.get.search_keyword}" name="search_keyword">
					<button class="hd-btn hd-btn-xm" type="submit">
						搜索
					</button>
				</div>
			</form>
			<div class="hd-menu-list">
				<ul>
					<li <if value="$hd.get.content_status eq 1">class="active"</if>>
						<a href="{|U:'show',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'])}">
							内容列表
						</a>
					</li>
					<li <if value="$hd.get.content_status eq 0">class="active"</if> >
						<a href="{|U:'show',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'],'content_status'=>0)}">
							未审核
						</a>
					</li>
					<li>
						<a href="javascript:;" onclick="window.open('{|U:'add',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'])}')">
							添加内容
						</a>
					</li>
				</ul>
			</div>
    <form onsubmit="return false" id="contentList">
			<table class="hd-table hd-table-list hd-form">
				<thead>
					<tr>
						<td class="hd-w30">
						    <input type="checkbox" id="selectAllContent"/>
						</td>
						<td class="hd-w30">aid</td>
						<td class="hd-w30">cid</td>
						<td class="hd-w30">排序</td>
						<td>标题</td>
						<td class="hd-w50">状态</td>
						<td class="hd-w100">作者</td>
						<td class="hd-w80">修改时间</td>
						<td class="hd-w120">操作</td>
					</tr>
				</thead>
				<list from="$data" name="$c">
					<tr>
						<td>
						<input type="checkbox" name="aid[]" value="{$c.aid}"/>
						</td>
						<td>{$c.aid}</td>
						<td>{$c.cid}</td>
						<td>
						<input type="text" class="hd-w30" value="{$c.arc_sort}" name="arc_order[{$c.aid}]"/>
						</td>
						<td>
						<a href="{|U:'Index/Content/index',array('mid'=>$c['mid'],'cid'=>$c['cid'],'aid'=>$c['aid'])}" target="_blank">
							{$c.title|mb_substr:0,50,'utf-8'}
						</a>
						<if value="$c.flag">
							<span style="color:#FF0000"> [{$c.flag}]</span>
						</if></td>
						<td>
						<if value="$c.content_status eq 1">
							发表
						</if>
                            <if value="$c.content_status eq 0">
							待审查
						</if>
                            <if value="$c.content_status eq 2">
                                自动
                            </if>
                        </td>
						<td>{$c.username}</td>
						<td>{$c.updatetime|date:"Y-m-d",@@}</td>
						<td>
						<a href="{|U:'Index/Content/index',array('mid'=>$c['mid'],'cid'=>$c['cid'],'aid'=>$c['aid'])}" target="_blank">
							访问
						</a>
                            <span class="line">|</span>
						<a href="javascript:;" onclick="window.open('{|U:edit,array('cid'=>$_GET['cid'],'mid'=>$_GET['mid'],'aid'=>$c['aid'])}')">
                            编辑
						</a>
                            <span class="line">|</span>
                            <a href="javascript:del({$c.mid},{$c.cid},{$c.aid})">
							删除
						</a>
						</td>
					</tr>
				</list>
			</table>
			<div class="hd-page">
				{$page}
			</div>
            <input type="button" class="hd-btn hd-btn-xm" value="全选" onclick="select_all('.table2')"/>
            <input type="button" class="hd-btn hd-btn-xm" value="反选" onclick="reverse_select('.table2')"/>
            <input type="button" class="hd-btn hd-btn-xm" onclick="order({$hd.get.mid},{$hd.get.cid})" value="更改排序"/>
            <input type="button" class="hd-btn hd-btn-xm" onclick="batchDel({$hd.get.mid},{$hd.get.cid})" value="批量删除"/>
            <if value="$hd.get.content_status eq 0">
                <input type="button" class="hd-btn hd-btn-xm" onclick="audit({$hd.get.mid},{$hd.get.cid},1)" value="审核"/>
            </if>
            <if value="$hd.get.content_status eq 1">
                <input type="button" class="hd-btn hd-btn-xm" onclick="audit({$hd.get.mid},{$hd.get.cid},0)" value="取消审核"/>
            </if>
                <input type="button" class="hd-btn hd-btn-xm" onclick="move({$hd.get.mid},{$hd.get.cid})" value="批量移动"/>
    </form>
        <script>
            //全选
            $("input#selectAllContent").click(function () {
                $("[type='checkbox']").attr("checked", $(this).attr("checked") == "checked");
            })
            //全选文章
            function select_all() {
                $("[type='checkbox']").attr("checked", "checked");
            }
            //反选文章
            function reverse_select() {
                $("[type='checkbox']").attr("checked", function () {
                    return !$(this).attr("checked") == 1;
                });
            }
            //更新排序
            function order(mid,cid) {
                if ($("input[type='text']").length == 0) {
                    alert('没有文章用来排序！');
                    return false;
                }
                var data = $("input[type='text']").serialize();
                hd_ajax(CONTROLLER + "&a=order&mid="+mid+"&cid=" + cid, data,'__URL__');
            }
            /**
             * 删除单一文章
             * @param mid
             * @param cid
             * @param aid
             */
            function del(mid,cid,aid) {
                hd_modal({
                    width: 400,//宽度
                    height: 200,//高度
                    title: '提示',//标题
                    content: '确定删除吗',//提示信息
                    button: true,//显示按钮
                    button_success: "确定",//确定按钮文字
                    button_cancel: "关闭",//关闭按钮文字
                    timeout: 0,//自动关闭时间 0：不自动关闭
                    shade: true,//背景遮罩
                    shadeOpacity: 0.1,//背景透明度
                    success: function () {//点击确定后的事件
                        hd_ajax('{|U:"del"}', {mid:mid,cid:cid,aid: aid}, '__URL__');
                    },
                    cancel: function () {//点击关闭后的事件

                    }
                });
            }
            /**
             * 批量删除文章
             */
            function batchDel(mid,cid){
                var aid=$("input[name*=aid]:checked").serialize();
                hd_modal({
                    width: 400,//宽度
                    height: 200,//高度
                    title: '提示',//标题
                    content: '确定删除吗',//提示信息
                    button: true,//显示按钮
                    button_success: "确定",//确定按钮文字
                    button_cancel: "关闭",//关闭按钮文字
                    timeout: 0,//自动关闭时间 0：不自动关闭
                    shade: true,//背景遮罩
                    shadeOpacity: 0.1,//背景透明度
                    success: function () {//点击确定后的事件
                        hd_ajax('{|U:"batchDel",array("mid"=>$_GET['mid'],"cid"=>$_GET["cid"])}', aid, '__URL__');
                    }
                });
            }
            /**
             * 设置状态
             */
            function audit(mid,cid, status) {
                var url = CONTROLLER + "&a=audit" + "&status=" + status + "&mid="+mid+"&cid=" + cid;
                var aid=$("input[name*=aid]:checked").serialize();
                if (aid) {
                    hd_ajax(url, aid, '__URL__',1);
                } else {
                    hd_alert({
                        message: '请选择文章',//显示内容
                        timeout: 2
                    })
                }
            }
            /**
             * 移动文章
             * @param mid 模型mid
             * @param cid 当前栏目
             */
            function move(mid,cid) {
                var aid = '';
                $("input[name*=aid]:checked").each(function (i) {
                    aid += $(this).val() + "|";
                })
                aid = aid.slice(0, -1);
                if (aid) {
                    hd_modal({
                        width: 600,//宽度
                        height: 460,//高度
                        title: '文章移动',//标题
                        content: '<iframe style="width: 100%;height: 390px" src="' + CONTROLLER + '&a=move&mid='+mid+'&cid=' + cid + '&aid=' + aid + '" frameborder="0"></iframe>',//提示信息
                        button: false,//显示按钮
                        button_success: "确定",//确定按钮文字
                        button_cancel: "关闭",//关闭按钮文字
                        timeout: 0,//自动关闭时间 0：不自动关闭
                        shade: true,//背景遮罩
                        shadeOpacity: 0.2//背景透明度
                    });
                } else {
                    hd_alert({
                        message: '请选择文章',//显示内容
                        timeout: 3,//显示时间
                    })
                }
            }
        </script>
	</body>
</html>