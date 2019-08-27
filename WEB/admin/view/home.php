<!-- //header-ends -->
				<div class="outter-wp">
					<!--custom-widgets-->
					<div class="custom-widgets">
						<div class="row-one">
							<div class="col-md-3 widget">
								<div class="stats-left ">
									<h5>Today</h5>
									<h4> Users</h4>
								</div>
								<div class="stats-right">
									<label>90</label>
								</div>
								<div class="clearfix"> </div>	
							</div>
							<div class="col-md-3 widget states-mdl">
								<div class="stats-left">
									<h5>Today</h5>
									<h4>Visitors</h4>
								</div>
								<div class="stats-right">
									<label> 85</label>
								</div>
								<div class="clearfix"> </div>	
							</div>
							<div class="col-md-3 widget states-thrd">
								<div class="stats-left">
									<h5>Today</h5>
									<h4>Tasks</h4>
								</div>
								<div class="stats-right">
									<label>51</label>
								</div>
								<div class="clearfix"> </div>	
							</div>
							<div class="col-md-3 widget states-last">
								<div class="stats-left">
									<h5>Today</h5>
									<h4>Alerts</h4>
								</div>
								<div class="stats-right">
									<label>30</label>
								</div>
								<div class="clearfix"> </div>	
							</div>
							<div class="clearfix"> </div>	
						</div>
					</div>
					<!--//custom-widgets-->


					<!--/charts-->
					<div class="charts">
						<div class="chrt-inner">

							<!--/float-charts-->
							<!-- <div class="pie row">
								<div class="col-md-6 chrt-two">
									<h3 class="sub-tittle">Reversed Value Axis Chart</h3>
									<div id="chartdiv2"></div>	
									<script>
										var chart = AmCharts.makeChart("chartdiv2", {
											"type": "serial",
											"theme": "patterns",
											"legend": {
												"useGraphSettings": true
											},
											"dataProvider": [{
												"year": 1930,
												"italy": 1,
												"germany": 5,
												"uk": 3
											}, {
												"year": 1934,
												"italy": 1,
												"germany": 2,
												"uk": 6
											}, {
												"year": 1938,
												"italy": 2,
												"germany": 3,
												"uk": 1
											}, {
												"year": 1950,
												"italy": 3,
												"germany": 4,
												"uk": 1
											}, {
												"year": 1954,
												"italy": 5,
												"germany": 1,
												"uk": 2
											}, {
												"year": 1958,
												"italy": 3,
												"germany": 2,
												"uk": 1
											}, {
												"year": 1962,
												"italy": 1,
												"germany": 2,
												"uk": 3
											}, {
												"year": 1966,
												"italy": 2,
												"germany": 1,
												"uk": 5
											}, {
												"year": 1970,
												"italy": 3,
												"germany": 5,
												"uk": 2
											}, {
												"year": 1974,
												"italy": 4,
												"germany": 3,
												"uk": 6
											}, {
												"year": 1978,
												"italy": 1,
												"germany": 2,
												"uk": 4
											}],
											"valueAxes": [{
												"integersOnly": true,
												"maximum": 6,
												"minimum": 1,
												"reversed": true,
												"axisAlpha": 0,
												"dashLength": 5,
												"gridCount": 10,
												"position": "left",
												"title": "Place taken"
											}],
											"startDuration": 0.5,
											"graphs": [{
												"balloonText": "place taken by Italy in [[category]]: [[value]]",
												"bullet": "round",
												"hidden": true,
												"title": "Italy",
												"valueField": "italy",
												"fillAlphas": 0
											}, {
												"balloonText": "place taken by Germany in [[category]]: [[value]]",
												"bullet": "round",
												"title": "Germany",
												"valueField": "germany",
												"fillAlphas": 0
											}, {
												"balloonText": "place taken by UK in [[category]]: [[value]]",
												"bullet": "round",
												"title": "United Kingdom",
												"valueField": "uk",
												"fillAlphas": 0
											}],
											"chartCursor": {
												"cursorAlpha": 0,
												"zoomable": false
											},
											"categoryField": "year",
											"categoryAxis": {
												"gridPosition": "start",
												"axisAlpha": 0,
												"fillAlpha": 0.05,
												"fillColor": "#000000",
												"gridAlpha": 0,
												"position": "top"
											},
											"export": {
												"enabled": true,
												"position": "bottom-right"
											}
										});
									</script>
							
								</div>
								<div class="col-md-6 chrt-two">
									<h3 class="sub-tittle">Bar Chart </h3>
									<div id="chart2"></div>
									<script>
										$(document).ready(function () {
											data = {
												'2010' : 300, 
												'2011' : 200,
												'2012' : 100,
												'2013' : 500,
												'2014' : 400,
												'2015' : 200
											};
							
											$("#chart1").faBoChart({
												time: 500,
												animate: true,
												instantAnimate: true,
												straight: false,
												data: data,
												labelTextColor : "#002561",
											});
											$("#chart2").faBoChart({
												time: 2500,
												animate: true,
												data: data,
												straight: true,
												labelTextColor : "#002561",
											});
										});
									</script>
								</div>
								//weather-charts
								<div class="col-md-6 map-1">
									<h3 class="sub-tittle">Weather </h3>
									<div class="weather">
										<div class="weather-top">
											<div class="weather-top-left">
												<div class="degree">
													<figure class="icons">
														<canvas id="partly-cloudy-day" width="64" height="64">
														</canvas>
													</figure>
													<span>37°</span>
													<div class="clearfix"></div>
												</div>
												<script>
													var icons = new Skycons({"color": "#002561"}),
													list  = [
													"clear-night", "partly-cloudy-day",
													"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
													"fog"
													],
													i;
							
													for(i = list.length; i--; )
														icons.set(list[i], list[i]);
							
													icons.play();
												</script>
												<p>FRIDAY
													<label>13</label>
													<sup>th</sup>
													AUG
												</p>
											</div>
											<div class="weather-top-right">
												<p><i class="fa fa-map-marker"></i>Location</p>
												<label>Lorem ipsum</label>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="weather-bottom">
											<div class="weather-bottom1">
												<div class="weather-head">
													<h4>Cloudy</h4>
													<figure class="icons">
														<canvas id="cloudy" width="40" height="40"></canvas>
													</figure>					
													<script>
														var icons = new Skycons({"color": "#00C6D7"}),
														list  = [
														"clear-night", "cloudy",
														"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
														"fog"
														],
														i;
							
														for(i = list.length; i--; )
															icons.set(list[i], list[i]);
							
														icons.play();
													</script>
													<h6>20°</h6>
													<div class="bottom-head">
														<p>Monday</p>
													</div>
												</div>
											</div>
											<div class="weather-bottom1 ">
												<div class="weather-head">
													<h4>Sunny</h4>
													<figure class="icons">
														<canvas id="clear-day" width="40" height="40">
														</canvas>	
							
													</figure>					
													<script>
														var icons = new Skycons({"color": "#00C6D7"}),
														list  = [
														"clear-night", "clear-day",
														"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
														"fog"
														],
														i;
							
														for(i = list.length; i--; )
															icons.set(list[i], list[i]);
							
														icons.play();
													</script>
													<h6>37°</h6>
													<div class="bottom-head">
														<p>Tuesday</p>
													</div>
												</div>
											</div>
											<div class="weather-bottom1">
												<div class="weather-head">
													<h4>Rainy</h4>
													<figure class="icons">
														<canvas id="sleet" width="40" height="40">
														</canvas>
													</figure>
													<script>
														var icons = new Skycons({"color": "#00C6D7"}),
														list  = [
														"clear-night", "clear-day",
														"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
														"fog"
														],
														i;
							
														for(i = list.length; i--; )
															icons.set(list[i], list[i]);
							
														icons.play();
													</script>
							
													<h6>7°</h6>
													<div class="bottom-head">
														<p>Wednesday</p>
													</div>
												</div>
											</div>
											<div class="weather-bottom1 ">
												<div class="weather-head">
													<h4>Snowy</h4>
													<figure class="icons">
														<canvas id="snow" width="40" height="40">
														</canvas>
													</figure>
													<script>
														var icons = new Skycons({"color": "#00C6D7"}),
														list  = [
														"clear-night", "clear-day",
														"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
														"fog"
														],
														i;
							
														for(i = list.length; i--; )
															icons.set(list[i], list[i]);
							
														icons.play();
													</script>
													<h6>-10°</h6>
													<div class="bottom-head">
														<p>Thursday</p>
													</div>
												</div>
											</div>
											<div class="clearfix"> </div>
										</div>
							
									</div>
								</div>	
							</div> -->
							<!--//charts-->
							<div class="area-charts">
								<ul id="clock">
									<li id="sec"></li>
									<li id="hour"></li>
									<li id="min"></li>
								</ul>
							</div>
							<!--/bottom-grids-->		 
							<div class="bottom-grids">
								<div class="dev-table">    
									<div class="col-md-4 dev-col">
										<div class="dev-widget dev-widget-transparent">
											<h2 class="inner one">Server Usage</h2>
											<p>Today server usage in percentages</p>                                        
											<div class="dev-stat"><span class="counter">68</span>%</div>                           
											<div class="progress progress-bar-xs">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
											</div>                                        
											<p>We Todayly recommend you change your plan to <strong>Pro</strong>. Click here to get more details.</p>

											<a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>
										</div>

									</div>
									<div class="col-md-4 dev-col mid">                                    

										<div class="dev-widget dev-widget-transparent dev-widget-success">
											<h3 class="inner">Today Earnings</h3>
											<p>This is Today earnings per last year</p>                                        
											<div class="dev-stat">$<span class="counter">75,332</span></div>                                                                                
											<div class="progress progress-bar-xs">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 79%;"></div>
											</div>                                        
											<p>We happy to notice you that you become an Elite customer, and you can get some custom sugar.</p>

											<a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>
										</div>

									</div>
									<div class="col-md-4 dev-col">                                    

										<div class="dev-widget dev-widget-transparent dev-widget-danger">
											<h3 class="inner">Your Balance</h3>
											<p>All your earnings for this time</p>
											<div class="dev-stat">$<span class="counter">5,321</span></div>                                                                                
											<div class="progress progress-bar-xs">
												<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
											</div>                                        
											<p>You can withdraw this money in end of each month. Also you can spend it on our marketplace.</p>

											<a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>                                        
										</div>

									</div>
									<div class="clearfix"></div>		

								</div>
							</div>
							<!--//bottom-grids-->

						</div>
						<!--/charts-inner-->
					</div>
					<!--//outer-wp-->
				</div>
				<!--footer section start-->