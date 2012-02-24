<?php
define('WIDTH', 30);
define('HEIGHT', 30);
define('DEPTH', 20);
define('BORDER', 1);
define('X_MAX',15);
define('Y_MAX',15);
define('WIDTH_MAX', (WIDTH)*X_MAX);
define('HEIGHT_MAX', (HEIGHT)*Y_MAX);
/*
function depth_div($depth,$max){
	return "<div id=\"depth_$depth\">".depth_div($depth+1,$max)."</div>";
}*/
?>

<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style>
.c0{
	background:none !important;
}
div, .c1{
	background-color: #5DC8CD;
}
span, .c2{
	background-color: #67E46F;
}
table, .c3{
	background-color: #FF0700;
}
ul, .c4{
	background-color: #4671D5;
}
li, .c5{
	background-color: #6C8CD5;
}
p, .c6{
	background-color: #808080;
}
a, .c7{
	background-color: #123EAB;
}
img, .c8{
	background-color: #FFB473;
}
iframe, .c9{
	background-color: #85004B;
}
h1, .c10{
	background-color: #606060;
}
.color-box,.building-block{
	margin: 0;
	padding: 0;
	border: 0;
	width:<?php echo WIDTH; ?>px;
	height:<?php echo HEIGHT; ?>px;
	display: block;
}
.color-box{
	float:left;
}
.building-block{
	position: absolute;
}

.color-box-current{
	margin: 0;
	padding: 0;
	border: 0;
	width:<?php echo WIDTH*2; ?>px;
	height:<?php echo HEIGHT*2; ?>px;
	display: block;
}
.click_container{
	width:<?php echo WIDTH_MAX; ?>px;
	height:<?php echo HEIGHT_MAX; ?>px;

	background: none;
	border: 1px #ccc solid;
	position:relative;
	z-index:9999;
}
.red{
	background: red;
}
.container, .container tr, .container tr td{
	margin:0 auto;
	margin-top:250px;
	background: none;
}
.title{
	background:none;
	text-align: center;
}

.pagination a:first-child {
    border-left-width: 1px;
    border-radius: 3px 0 0 3px;
}

.pagination a:last-child {
    border-radius: 0 3px 3px 0;
}

.pagination a,.pagination span {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #DDDDDD;
    border-style: solid;
    border-width: 1px 1px 1px 0;
    float: left;
    line-height: 34px;
    padding: 0 12px;
    text-decoration: none;
    background: none !important;
}
body {
  margin: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  line-height: 18px;
  color: #333333;
  background-color: #ffffff;
}
a {
    color: #0088CC;
    text-decoration: none;
}
a:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
a:hover, a:active {
  outline: 0;
}
.clear{
	clear:both;
}
</style>


</head>
<body>

<table class="container">
	<tr>
		<td colspan="3">
			<h1 class="title">
				TILTCRAFT
			</h1>
		</td>
	</tr>
	<tr>
		<td width="<?php echo WIDTH*5;?>" style="padding-right:30px">
			<h3>COLOR</h3>
			<div class="color-box-current" id="current-color" data-color="c1"></div>
			<br>
			<?php
			for($i=1;$i<=10;$i++){
				echo "<div class=\"color-box c$i\" data-color=\"c$i\"></div>";
			}?>
			<div class="clear"></div>
			<h3>LEVEL</h3>
			<div class="pagination">
			<a href="#" id="prev_depth">«</a><span id="current_depth">1</span><a href="#" id="next_depth">»</a>
			</div>
		</td>
		<td width="<?php echo WIDTH_MAX;?>">
		<div id="depth_0" class="c0">
					<div id="depth_1" class="c0">
						
					</div>
				</div>
			<div class="click_container">
				
				<?php if(true){?>
				<?php
					for($i=0;$i<X_MAX;$i++){
						
						
						for($j=0;$j<Y_MAX;$j++){
							$width = WIDTH;
							$height = HEIGHT;
							$style = 'float:left;background:none;';

							
							if($j<(Y_MAX-1)){
								$width -= BORDER;
								$style.='border-right:'.BORDER.'px solid #ccc;';
							}
							if($i<(X_MAX-1)){
								$height -= BORDER;
								$style.='border-bottom:'.BORDER.'px solid #ccc;';
							}
							$style.="width:{$width}px;height:{$height}px;";
							echo "<div id=\"grid_{$j}_{$i}\" style=\"$style\" class=\"click_box\" data-x=\"$j\" data-y=\"$i\">\n\t\n</div>\n";
							
						}
						echo "<!-- new line -->\n";
					}
				?>
				<?php }?>
			</div>
			
		</td>
	</tr>
</table>




<script>
var WIDTH = <?php echo WIDTH;?>;
var HEIGHT = <?php echo HEIGHT;?>;
var depth_now = 1;
var max_depth = 1;

$(function(){
	$("#prev_depth").click(function(){
		if(depth_now>1)depth_now--;
		$("#current_depth").html(depth_now);
	});

	$("#next_depth").click(function(){
		if(depth_now==max_depth){
			$("#depth_"+max_depth).append('<div id="depth_'+(max_depth+1)+'" class="c0"></div>');
			max_depth++;
		}
		depth_now++;
		$("#current_depth").html(depth_now);
	});

	$(".color-box").click(function(){
		$("#current-color").attr('class',"color-box-current "+$(this).attr('data-color'));
		$("#current-color").attr('data-color',$(this).attr('data-color'));
	});

	$(".click_box").click(function(){
		x = $(this).attr('data-x');
		y = $(this).attr('data-y');
		$("#depth_"+depth_now).append('<div class="building-block '+$("#current-color").attr('data-color')+'" style="margin-top:'+HEIGHT*y+'px;margin-left:'+WIDTH*x+'px;z-index:'+depth_now+'"></div>');
		//console.log("#grid_"+$(this).attr('data-x')+'_'+$(this).attr('data-y'));
		//console.log($("#current-color").attr('data-color'));
		//$("#grid_"+$(this).attr('data-x')+'_'+$(this).attr('data-y')).attr('class',"click_box "+$("#current-color").attr('data-color'));
	});
});
</script>


</body>
</html>