<?php
	if (! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Chart {
		protected $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
		}
		
		public function pie ($id, $chart, $width = "100%", $height = "100%") {
			print '<div id="'.$id.'" style="width:'.$width.'; height:'.$height.';"></div>';
			
			$chartData = array();
			
			if (!empty($chart["data"])) {
				foreach ($chart["data"] as $key => $foo) {
					$chartData[$key]["name"] = $foo["nama"];
					$chartData[$key]["y"] = $foo["value"];
				}	
			}
			
			print '<script type="text/javascript">$(document).ready(function() {';
				print "var ".$id." = Highcharts.chart('".$id."', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					title: {
						text: '".$chart["title"]."'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					accessibility: {
						point: {
							valueSuffix: '%'
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: '".$chart["title"]."',
						colorByPoint: true,
						data: ".json_encode($chartData)."
					}]
				});";
			print '});</script>';
		}
		
		
		public function column ($id, $chart, $width = "100%", $height = "100%") {
			
			print '<div id="'.$id.'" style="width:'.$width.'; height:'.$height.';"></div>';
			
			$chartData = array();
			
			if (!empty($chart["data"])) {
				foreach ($chart["data"] as $key => $foo) {
					$chartData[$key]["name"] = $foo["nama"];
					$chartData[$key]["data"] = $foo["value"];
				}	
			}
			
			print '<script type="text/javascript">$(document).ready(function() {';
			print "var ".$id." = Highcharts.chart('".$id."', {
				chart: {
					type: 'column'
				},
				title: {
					text: '".$chart["title"]."'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: ".json_encode($chart["categories"]).",
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},
				tooltip: {
					headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
					pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
						'<td style=\"padding:0\"><b>{point.y:,.0f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: ".json_encode($chartData)."
			});";
			print '});</script>';
		}
		
		
		public function columnDouble ($id, $chart, $width = "100%", $height = "100%") {
			
			print '<div id="'.$id.'" style="width:'.$width.'; height:'.$height.';"></div>';
			
			$chartData = array();
			
			if (!empty($chart["data"])) {
				foreach ($chart["data"] as $key => $foo) {
					$chartData[$key]["name"] = $foo["nama"];
					$chartData[$key]["data"] = $foo["value"];
					$chartData[$key]["stack"] = 'male';
				}	
			}
			
			print '<script type="text/javascript">$(document).ready(function() {';
				print "var ".$id." = Highcharts.chart('".$id."', {

					chart: {
						type: 'column'
					},

					title: {
						text: '".$chart["title"]."'
					},

					xAxis: {
						categories: ".json_encode($chart["categories"])."
					},

					yAxis: {
						allowDecimals: false,
						min: 0,
						title: {
							text: ''
						}
					},

					tooltip: {
						formatter: function () {
							return '<b>' + this.x + '</b><br/>' +
								this.series.name + ': Rp. ' + SPJ.formatNumber(this.y) + '<br/>' +
								'Total: Rp. ' + SPJ.formatNumber(this.point.stackTotal);
						}
					},

					plotOptions: {
						column: {
							stacking: 'normal'
						}
					},

					series: ".json_encode($chartData)."
				});";
			
			print '});</script>';
		}
		
		public function lineDate ($id, $chart, $width = "100%", $height = "100%") {
			print '<div id="'.$id.'" style="width:'.$width.'; height:'.$height.';"></div>';
			
			print '<script type="text/javascript">$(document).ready(function() {';
			print "
				Highcharts.chart('".$id."', {
				  title: {
					text: '".$chart["title"]."'
				  },
				  yAxis: {
						title: {
							text: '".$chart["title_y"]."'
						}
					},
				  xAxis: {
					type: 'category',
				  },
				  series: ".json_encode($chart["data"])."
				});
			";
			
			print '});</script>';
		}
	}
?>