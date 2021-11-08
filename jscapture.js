/* global screen, navigator, setTimeout, URL, Whammy, document */

var JSCapture = JSCapture || (function () {

  'use strict';
  function capture(number) {
   const a = navigator.mediaDevices.getDisplayMedia;
  const takeScreenshot = async function() {
    const stream = await navigator.mediaDevices.getDisplayMedia({

      video : {mediaSource : 'screen'}
    });
    const track = stream.getVideoTracks()[0];

    const image = new ImageCapture(track);

    const bitmap = await image.grabFrame();

    track.stop;

    var newcanvas = '<canvas id ="canvas_'+ number +'" ></canvas><div id = "time'+ number +'"></div>';
            $("#container").append(newcanvas);
            

    const canvas = document.getElementById('canvas_'+number);

    canvas.width = bitmap.width;
    canvas.height = bitmap.height;

    const context = canvas.getContext('2d');


    context.drawImage(bitmap,0,0,790,bitmap.height/2);

    const img = canvas.toDataURL();
    var date = new Date();
    $("#time"+ number).text(date);

    const res = await fetch(img);
    const buff = await res.arrayBuffer();

    const file = [

    new File([buff], 'photo_${new Date()}.jpg',{
      type: 'image/jpeg'
    } )
    ];

    var newimg = '<img id ="img_"+number src=""></img>';
            $("#TimeTrackerBtn").append(newimg);
            $("#img_"+number).attr("src", file);
return file;
}
   takeScreenshot();


  }

  

  return {
    capture: capture
  };
}());