$(document).ready(function(){

	function showCoords(c)
  	{
      	    // variables can be accessed here as
      	    // c.x, c.y, c.x2, c.y2, c.w, c.h

            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
  	};

	jQuery(function($) {
	    $('#cropbox').Jcrop({
	        onSelect: showCoords,
	    });
	});

        function checkCoords(){
            if (parseInt(jQuery('#w').val())>0) return true;
            alert('Please select a crop region then press submit....');
            return false;
        };

	var array = [];
	$('#insertar').click(function(){
    	    var ul = document.getElementById("list");
	    var texto = document.getElementById("texto").value;
	    if(texto.length > 0){
       	        var li = document.createElement("li");
	        li.id = "text";
	        li.innerHTML = "<input type='hidden' name='texto[]' value="+texto+"> </input>"+ texto;
    	        ul.appendChild(li);
	        array.push(li);
	    }
	}); 

	$('#netejar').click(function(){
	        var element = document.getElementById("list").getElementsByTagName("li");
		for(var i=element.length-1; i>=0; i--) {
		    eliminar(element[i]);
		}
		array = [];
	});

        function eliminar(elemento) {
            var id=elemento.getAttribute("id");
            node=document.getElementById(id);
            node.parentNode.removeChild(node);
        }

	$('#directorio').click(function(){
		$('.ventana').slideDown("slow");
	});

	$('.cerrar').click(function(){
		$('.ventana').slideUp("slow");
	});

});
