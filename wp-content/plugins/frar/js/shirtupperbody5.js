function ajaxku (u,d) {
	return jQuery.ajax({
		url:u,
		data:d,
		type:'post',
		dataType:'json',
	});
}

window.onload=function(){
	// initialization 
	/*main system*/
	var sizeArr =[
		{label:"S",min:320,max:349,minCM:40,maxCM:41.9},
		{label:"M",min:350,max:378,minCM:42,maxCM:43.9},
		{label:"L",min:380,max:409,minCM:44,maxCM:45.9},
		{label:"XL",min:410,max:439,minCM:46,maxCM:47.9},
	],sizeLabelRT=sizeLabelT='...',
	iCapture=0,
	captureWidth=0,
	iTest=10,
	iPlayLoop=0,
	fullscreenbtn = document.getElementById('fullscreenbtn'),
	dirx='../../latihan/CV/FP/img/img2/'; 

	// core lib
	var detectLib = objectdetect.upperbody;
	var smoother = new Smoother([0.4444444, 0.4444444, 0.444, 0.444], [0, 0, 0, 0]),
		video = document.getElementById('video'),
		shirt = document.getElementById('shirt'),
		detector;
	function sizeInfoPos () {

	}

	/*call function*/
	listProduct();sizeList();
	checkWebcam();

	function loopLog () {
		jQuery('#fpsInfo').html(iPlayLoop);
		iPlayLoop=0;
	}

	function toggleFullScreen(){
		if(video.requestFullScreen){
			video.requestFullScreen();
		} else if(video.webkitRequestFullScreen){
			video.webkitRequestFullScreen();
		} else if(video.mozRequestFullScreen){
			video.mozRequestFullScreen();
		}
	}

	function drawThumbnail () {
		alert('masuk thumbnail');
		var canvas2 = document.createElement('canvas');
		var imgx = new Image();
		imgx.src = 'img/s003.png';           
		imgx.onload = function(){
		     canvas2.drawImage(imgx, 78, 19);
		}
	}

	// calculation  
	function calculation(captWidth) {
		captureWidth+=parseFloat(captWidth);
		if(iCapture<iTest){ // less than 10x
		// 	widthRealTime(parseFloat(captWidth).toFixed());
		// 	sizeRealTime(convertLabel(captWidth));
		}else{ // when 10
			var avgWidth=(parseFloat(captureWidth)/iTest).toFixed();
			sizeTruly(convertLabel(avgWidth));
			widthTruly(avgWidth);
			captureWidth=0;
			iCapture=0;
		}
	}

	// width info
	function widthRealTime (widthRT) {jQuery('#widthInfoRT').html(widthRT);}
	function widthTruly (widthT) {jQuery('#widthInfoT').html(widthT);}

	// size info 
	function sizeRealTime (sizeRT) {jQuery('#sizeInfoRT').html(sizeRT);}
	function sizeTruly (sizeT) {/*console.log(sizeT);*/jQuery('#sizeInfoT').html(sizeT);}

	function sizeList () {
		console.log('masuk size list');
		var li='';
		jQuery.each(sizeArr,function  (id,item) {
			li+='<li>'+item.label+' ('+item.minCM+' s/d '+item.maxCM+' cm)</li>';
		});jQuery('#sizeList').html(li);
	}

	function convertLabel (objWidth) {
		var sl='';
		for (var j =0; j <=sizeArr.length-1; j++) {
			var minWidth= parseFloat(sizeArr[j].min);
			var maxWidth= parseFloat(sizeArr[j].max);
			if(objWidth>=minWidth && objWidth<=maxWidth) sl=sizeArr[j].label;
		}return sl==''?'<small>unknown</small> :(':sl;
	}

	/*useless */
	function labelSize(avgW){
		// console.log('labels  avgW ..='+avgW);
		var objWidth=parseFloat(avgW);
		for (var j =0; j <=sizeArr.length-1; j++) {
			var minWidth= parseFloat(sizeArr[j].min);
			var maxWidth= parseFloat(sizeArr[j].max);
			if(objWidth>=minWidth && objWidth<=maxWidth) labelx=sizeArr[j].label;
		}
		sizeTruly(labelx);
	}

	function calculateRT (captureWidth) {
		widthRealTime();
		sizeRealTime();
	}

	// function selectShirt(src) {
	// 	shirt.src=src+'.png';
	// }

	function listProduct () {
		console.log('masuk list product');
		// ajaxku('../FP/lib/shirt.php','action=view').done(function (dt) {
		ajaxku('../../latihan/CV/FP/lib/shirt.php','action=view').done(function (dt) {
			if(!dt.status) alert('query_failed');
			else{
				var li='';
				jQuery.each(dt.data, function (id,item) {
					li+='<img onclick="shirt.src=\''+dirx+item.name+'.png\'" src="'+dirx+item.name+'.png" style="width: 117px;">';
					// li+='<img onclick="shirt.src=\'img/img2/'+item.name+'.png\'" src="'+dirx+item.name+'.png" style="width: 117px;">';
				});jQuery('#list').html(li);

				var defaultProduct=dirx+dt.data[0].name+'.png';
				shirt.src=defaultProduct;
				shirt.style.display='none';
			}
		});
	}

	function checkWebcam () {
		console.log('masuk checkWebcam');
		try {
			compatibility.getUserMedia({video: true}, function (stream) {
					try {
						video.src = compatibility.URL.createObjectURL(stream);
					} catch (error) {
						video.src = stream;
					}compatibility.requestAnimationFrame(playx);
				}, function (error) {
					alert('WebRTC not available');
				}
			);
		} catch (error) {
			alert(error);
		}
	}
	
	function playx() {
		console.log('masuk play');
		var x = compatibility.requestAnimationFrame(playx); // play video streaming 
		if (video.paused) { // play streaming video
			video.play();
		}

		if (video.readyState === video.HAVE_ENOUGH_DATA && video.videoWidth > 0) {  // jika webcam berhasil mengcapture gambar real time user dan dimuat ke dala video 
          	// Prepare the detector once the video dimensions are known:
          	if (!detector) {
				var width  = ~~(60 * video.videoWidth / video.videoHeight);
				var height = 60;
	      		detector = new objectdetect.detector(width, height, 1.1, detectLib);
	      	}
      		
      		// Perform the actual detection:
			var coords = detector.detect(video, 1); // objectdetect.js line 684
 			if (coords[0]) {
				var coord = coords[0];
				coord     = smoother.smooth(coord);
				// Rescale coordinates from detector to video coordinate space:
					coord[0] *= video.videoWidth / detector.canvas.width;		// x
					coord[1] *= video.videoHeight / detector.canvas.height;		// y
					coord[2] *= video.videoWidth / detector.canvas.width;		// width
					coord[3] *= video.videoHeight / detector.canvas.height;	// height

					// edit 2
						shirt.style.left    = ~~(coord[0] + coord[2] * 1.0/8 + video.offsetLeft) + 'px';
						shirt.style.top     = ~~(coord[1] + coord[3] * 0.8/1.4 + video.offsetTop) + 'px';
						shirt.style.width   = ~~(coord[2] * 6.3/8) + 'px';
						shirt.style.height  = ~~(coord[3] * 8/8) + 'px';
						// shirt.style.height  = ~~(coord[3] * 6.5/8) + 'px';

					shirt.style.position='absolute';
					shirt.style.display='block';

					shirt.style.opacity = 1;
					shirt.style.zIndex =2147483647;

					var l1 = coord[0]; 
					var l2 = coord[2]; 
					var lebar =Math.abs(l2-l1); 
					
					var t1 = coord[1]; 
					var t2 = coord[3]; 
					var tinggi =Math.abs(t2-t1); 
					
				jQuery('#coord0Info').html(coord[0].toFixed(2));
				jQuery('#coord1Info').html(coord[1].toFixed(2));
				
				var w = coord[2].toFixed(2);
				// labelSize(w);
				// captureCollect(w);
				iCapture++;
				calculation(w);
			} else { 
				// var opacity = shirt.style.opacity - 0.2;
				// shirt.style.opacity = opacity > 0 ? opacity : 0;
			}
		}
		iPlayLoop++;
		setInterval(loopLog,1000);
	}
	fullscreenbtn.addEventListener("click",toggleFullScreen,false);
};

