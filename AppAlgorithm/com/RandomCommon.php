<?php



	namespace AppAlgorithm\com;

	class RandomCommon {

		 /**
		  * 公平大王
		  */
		public static function king($n,$m) {
			
			$monkeys = range(1,$n);								//创建1到n数组
			$i = 0;
			while(count($monkeys) > 1) {						//循环条件为猴子数量大于1

				if(($i + 1) % $m == 0) {						//$i为数组下标;$i+1为猴子标号
					unset($monkeys[$i]);						//余数等于0表示正好第M个，删除，用unset删除保持下标关系
				}else {
					array_push($monkeys,$monkeys[$i]);			//如果余数不等于0，则把数组下标为$i的放最后，形成一个圆形结构	
					unset($monkeys[$i]);
				}
				$i++;											//$i 循环+1，不断把猴子删除，或 push 到数组
				print_R($monkeys);
			}
			return current($monkeys);							//猴子数量等于1时输出猴子标号，得出猴王

		}


	}



?>