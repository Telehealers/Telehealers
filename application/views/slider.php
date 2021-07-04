
<head>
	<style>
		
.slider-ui {
	position: relative;
	width: 90%;
	height: 50px;
	margin: 25px;
}
.slider-ui input {
	position: absolute;
	z-index: 10;
	top: 0;
	bottom: 0;
	width: 100%;
	cursor: pointer;
	opacity: 0;
}
.slider-ui .bar {
	position: absolute;
	z-index: 1;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	border-radius: 50px;
	box-shadow: 0 5px 0 rgba(0,0,0,.1);
}
.slider-ui .min,
.slider-ui .max {
	position: absolute;
	z-index: 2;
	top: 50%;
	transform: translateY(-50%);
	font-size: 14px;
	font-weight: 800;
	color: #fff;
}
.slider-ui .min {
	left: 2%;
}
.slider-ui .max {
	right: 2%;
}
.slider-ui .track {
	position: absolute;
	z-index: 3;
	left: 25px;
	right: 25px;
	top: 0;
	bottom: 0;
}
.slider-ui .value {
	position: absolute;
	left: 50%;
	top: 0;
	width: 50px;
	height: 50px;
	display: flex;
	justify-content: center;
	align-items: center;
	font-size: 14px;
	font-weight: 800;
	color: #000;
	background-color: #fff;
	border: 4px solid #000;
	border-radius: 100%;
	box-sizing: border-box;
	transform: translateX(-50%);
	-webkit-transition:: top .3s ease-in-out
}
.slider-ui .value.up {
	top: -110%;
	color: #000;
}
.slider-ui.color1 .bar {
	background-color: #00b894;
}
.slider-ui.color1 .value {
	border-color: #00b894;
}
.slider-ui.color2 .bar {

}
.slider-ui.color2 .value {
	border-color: #00cec9;
}
.slider-ui.color3 .bar {
	background-color: #0984e3;
}
.slider-ui.color3 .value {
	border-color: #0984e3;
}


.youtube-link {
	position: fixed;
	left: 20px;
	bottom: 20px;
	color: #000;
	text-decoration: none;
	font-size: 12px;
}
	</style>
</head>
<body>




<div class="container">

	<div class="slider-ui color2">
		   <input class="range" id="slider" type="range" min="0" max="96" value="23">

		<div class="bar">
			<span class="min"></span>
			<span class="max"></span>
		</div>
		<div class="track">
			<div class="value"></div>
		</div>
	</div>

	
</div>

<script>
	
</script>


