<include file="__PUBLIC__/header"/>
<body>
<css file="__CONTROLLER_VIEW__/css/css.css"/>
<js file="__CONTROLLER_VIEW__/js/js.js"/>
<div id="top-menu">
	<div class="t-l-menu">
		<list from="$node" name="$m">
			<a href="javascript:"
			   onclick="topMenu(this,{$m.nid})">{$m.title}</a>
		</list>
	</div>
	<div class="t-r-menu">
		{$hd.session.user.rname}: {$hd.session.user.username} <a href="{|U:'Login/out'}" target="_self">[退出]</a>
		<span>|</span>
		<a href="{|U:'Cache/index'}" target="frame">更新全站缓存</a>
		<span>|</span>
		<a href="__ROOT__/index.php" target="_blank">前台首页</a>
		<span>|</span>
		<a href="{|U:'Member/Index/index'}" target="_blank">会员中心</a>
	</div>
</div>
<!--内容区Start-->
<div class="main">
	<!--左侧菜单Start-->
	<div id="leftMenu">
		<list from="$node" name="$n">
			<div id="{$n.nid}" class="leftMenuBlock">
				<list from="$n._data" name="$m">
					<dl>
						<dt>{$m.title}</dt>
						<list from="$m._data" name="$k">
							<dd>
								<a href="javascript:;" target="frame"
								   onclick="runAction(this,'{$k.url}',{$k.nid})">{$k.title}</a>
							</dd>
						</list>
					</dl>
				</list>
			</div>
		</list>
	</div>
	<!--左侧菜单End-->
	<!--右侧区域Start-->
	<div id="content">
		<!--快速导航Start-->
		<div id="historyMenu">
			<div id="leftBtn">向左按钮</div>
			<div id="historyMenuBox">
				<div id="historyMenuList">
					<ul>

					</ul>
				</div>
			</div>
			<div id="rightBtn">向右按钮</div>
		</div>
		<!--快速导航End-->
		<div class="show">
			<iframe src="" name="frame" id="frame" frameborder="0"></iframe>
		</div>
	</div>
	<!--右侧区域End-->
</div>
<!--内容区End-->
<!--底部快速导航Start-->
<div id="quickMenu">
	<div class="set">
		<a href="{|U:'FavoriteMenu/set'}" target="frame">设置</a>
	</div>
	<div class="line"></div>

	<div class="menu-list">
		<list from="$quickMenu" name="$q">
			<a href="{$q.url}" target="frame">{$q.title}</a>
		</list>
	</div>
</div>
<!--底部快速导航End-->
</body>
</html>