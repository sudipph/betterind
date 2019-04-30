 jQuery(document).ready(function(){

 	jQuery("#owl-demo2").owlCarousel({
     items : 2,
    /*margin:10,*/
    loop:true,
    autoWidth:true,
    lazyLoad : true,
    navigation : false,
    responsive: false
  }); 
  jQuery("#touchFlow").touchFlow({
    axis: "x",
		snap: true,
		scrollbar: false,
		initComplete: function(e) {
      //$("#throw_nav_debug").append('touchFlow init !!<br>');
      console.log('uu');
		},
		stopped: function(e) {
      //$("#throw_nav_debug").append('touchFlow stopped. posX : ' + e.posX + ' !!<br>');
      console.log('yy');
		},
		resizeend: function(e) {
      //$("#throw_nav_debug").append('Window resizeend. listW : ' + this.listw + ' !!<br>');
      console.log('oo');
		}
	});
});