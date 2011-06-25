<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>黑暗象棋</title>
<style type="text/css">
.red {
	color: #F00;
}

.blue {
	color: #00F;
}

.black {
	color: #000;
}

</style>
</head>

<body>

<?php


// 紅方
           $c->name[1]  = '帥';
           $c->name[2]  = '仕'; 
           $c->name[3]  = '仕';
		   $c->name[4]  = '相';
		   $c->name[5]  = '相';
		   $c->name[6]  = '俥';
		   $c->name[7]  = '俥';
           $c->name[8]  = '傌'; 
           $c->name[9]  = '傌';
		   $c->name[10] = '炮';
		   $c->name[11] = '炮';
		   $c->name[12] = '兵';
		   $c->name[13] = '兵';
		   $c->name[14] = '兵';
		   $c->name[15] = '兵';
		   $c->name[16] = '兵';		   
// 黑方開始
		   $c->name[17] = '將';  
           $c->name[18] = '士'; 
           $c->name[19] = '士';
		   $c->name[20] = '象';
		   $c->name[21] = '象';
		   $c->name[22] = '車';
		   $c->name[23] = '車';
           $c->name[24] = '馬'; 
           $c->name[25] = '馬';
		   $c->name[26] = '包';
		   $c->name[27] = '包';
		   $c->name[28] = '卒';
		   $c->name[29] = '卒';
		   $c->name[30] = '卒';
		   $c->name[31] = '卒';
		   $c->name[32] = '卒';	   

// $c->position[1]='位置';
// $c->open[1]='0'; 0=蓋牌,1=翻牌
// 亂數洗排產生牌,產生 1~32的棋盤位置
for($i=1;$i<=32;$i++){		
		// 取得棋子號碼
		$chess_no=rand(1,32);
		//echo $i.'='.$chess_no;
		

		for($j=1;$j<=$i;$j++){		
			// 比對是否已出現過此棋子號碼
			if($chess_no == $c->position[$j]) {
				//echo ",$j~$i".'此整數已出現過,重做一次!!';
				$i=$i-1;
				break;
			}
		}
		// 取棋子號碼放入棋盤所在位置
		$c->position[$i]=$chess_no;
		// 洗完牌預設蓋牌
		$c->open[$i]='0';
		//echo '<br>';
	}	

//時間及目前變數，可以存SQL
echo date("YmdHis").'<br>'; 
print_r($c);
?>

<p>黑暗象棋</p>
<table width="400" border="1">
  <tr>
    <td width="20" height="15">&nbsp;</td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
  </tr>
<?php  
  for($r=0;$r<=3;$r++){
	  
  echo '<tr>
    <td width="20" height="50">A</td>';

	// 顯示第1列的棋子
	for($t=(1+$r*8);$t<=(8+$r*8);$t++) {
	echo '<td>';	
		//echo $c->open[$t];
		// 判斷式否為蓋牌狀態
		if($c->open[$t] == 0) {	
			echo '<span class="blue">'.'O'.'</span>'; 
		}else{
			if($c->position[$t] <= 16) {
				echo '<span class="red">'.$c->name[$c->position[$t]].'</span>'; 
			}else{
				echo '<span class="black">'.$c->name[$c->position[$t]].'</span>'; 
			}
		}
	echo '</td>';
	}

  echo '</tr>';
  }
?>    

</table>


<p>標準暗棋規則</p>
<blockquote>
  <ul>
    <li>對奕一開始時，所有棋子都是背面並擺滿棋盤</li>
    <li>先手選一棋子翻面，翻到的陣營就是先手的陣營，對手則是另一邊的陣營</li>
    <li>每一回合，棋手可以做一次翻子、移子、吃子。做完後換手</li>
    <li>正面的棋子一次可以移動一格</li>
    <li>棋子可以吃鄰近對手的棋子 (正面)。吃子的規則如下述：
      <ul>
        <li>帥：將士象車馬包</li>
        <li>仕：士象車馬包卒</li>
        <li>相：象車馬包卒</li>
        <li>俥：車馬包卒</li>
        <li>傌：馬包卒</li>
        <li>兵：卒將</li>
        <li>炮：以跳格的方式可吃所有對手的子，跳吃中間的格子只能有一個棋子</li>
      </ul>
    </li>
    <li>黑子陣營吃子規則同上述紅子陣營</li>
    <li>將對手陣營的棋子吃完者，獲得勝利</li>
    <li>雙方陣營連續 60 次移動棋子，強制合局結束對奕</li>
    <li>不可暗吃、不可連吃、車不可直衝</li>
  </ul>
</blockquote>
<p><br />
</p>
<p>回合時間限制</p>
<p>遊戲可以設定每一回合的時間長度，有 不限、一分鐘與二分鐘 三種限制可供遊戲室</p>
<p>室長選擇。若超過回合的時間限制，則該局直接判輸。高手對決可以選最嚴格的一分鐘</p>
<p>限制。希望好好享受下棋樂趣的，可以選二分鐘限制。不限時間的適合新手或是喜歡</p>
<p>慢慢聊天的玩家。</p>
<p><br />
</p>
<p>勝率的計算</p>
<ul>
  <li>勝率一開始每個人都是負值，每贏一場勝率就會不斷的提升，你必須贏得超過二十場後，才會有正的勝率值，而這時的勝率才開始有意義。勝率最高的值是 100 (即百分之百)</li>
  <li>註一：太快分出勝負的局視為無效，不計勝率。</li>
  <li>註二：勝率排行榜裡，只有歷史紀錄的勝率才是正確的。'本週' 和 '今日' 裡顯示的勝率排行僅供參考。</li>
</ul>
<br />
<p>&nbsp;</p>
</body>
</html>